<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Controller autentikasi petugas (hidden login).
 * Diakses lewat URL rahasia /portal-petugas.
 */
class AuthController extends Controller
{
    // tampilkn form login
    public function form(): View
    {
        return view('panel.auth.login');
    }

    // proses login dgn rate limiting & pesan error generik
    public function masuk(Request $request): RedirectResponse
    {
        $kredensial = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [], [
            'email' => 'email',
            'password' => 'kata sandi',
        ]);

        $kunciThrottle = Str::lower($kredensial['email']) . '|' . $request->ip();

        // batasi 5 percobaan / menit
        if (RateLimiter::tooManyAttempts($kunciThrottle, 5)) {
            $detik = RateLimiter::availableIn($kunciThrottle);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan. Coba lagi dalam {$detik} detik.",
            ]);
        }

        // coba autentikasi (tanpa remember)
        if (! Auth::attempt($kredensial)) {
            RateLimiter::hit($kunciThrottle, 60);
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi salah.',
            ]);
        }

        // tolak akun nonaktif
        if (! Auth::user()->aktif) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun Anda tidak aktif. Hubungi administrator.',
            ]);
        }

        RateLimiter::clear($kunciThrottle);
        $request->session()->regenerate();

        return redirect()->intended(route('panel.dashboard'));
    }

    // logout
    public function keluar(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('panel.login');
    }
}

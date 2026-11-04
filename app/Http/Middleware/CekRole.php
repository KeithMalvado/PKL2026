<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware pembatas akses berdasarkn role petugas.
 * Pemakaian di route: ->middleware('role:admin,kabid')
 */
class CekRole
{
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        $pgn = $request->user();

        // belum login / akun nonaktif -> tolak
        if (! $pgn || ! $pgn->aktif) {
            abort(403, 'Akses ditolak.');
        }

        // role tdk termasuk yg diizinkn -> tolak
        if (! empty($role) && ! in_array($pgn->role, $role, true)) {
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}

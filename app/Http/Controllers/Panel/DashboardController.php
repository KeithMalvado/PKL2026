<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Pgdn;
use Illuminate\View\View;

/**
 * Controller dashboard panel petugas.
 * Menampilkn ringkasan statistik sesuai konteks.
 */
class DashboardController extends Controller
{
    public function index(): View
    {
        // ringkasan jumlah pengaduan per status
        $statPgdn = [
            'total' => Pgdn::count(),
            'baru' => Pgdn::where('sts', 'baru')->count(),
            'proses' => Pgdn::whereIn('sts', ['verif', 'dsps', 'proses'])->count(),
            'selesai' => Pgdn::where('sts', 'selesai')->count(),
        ];

        // pengaduan terbaru
        $pgdnTerbaru = Pgdn::with('bdg')->latest()->take(5)->get();

        // forum menunggu moderasi
        $forumTunggu = Forum::where('sts', 'tunggu')->count();

        return view('panel.dashboard', compact('statPgdn', 'pgdnTerbaru', 'forumTunggu'));
    }
}

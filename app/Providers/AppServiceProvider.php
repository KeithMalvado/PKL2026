<?php

namespace App\Providers;

use App\Models\Forum;
use App\Models\Pgdn;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('panel.layout', function ($view) {
            $pgn = auth()->user();
            $notif = [];

            if ($pgn && $pgn->isAdmin()) {
                $forumTunggu = Forum::where('sts', 'tunggu')->count();
                if ($forumTunggu > 0) {
                    $notif[] = [
                        'judul' => "{$forumTunggu} pertanyaan baru menunggu moderasi",
                        'ket' => 'Buka menu Forum Konsultasi untuk menjawab.',
                        'url' => route('panel.forum.index'),
                        'warna' => 'amber',
                    ];
                }

                $pgdnBaru = Pgdn::where('sts', 'baru')->count();
                if ($pgdnBaru > 0) {
                    $notif[] = [
                        'judul' => "{$pgdnBaru} pengaduan baru masuk",
                        'ket' => 'Belum diverifikasi.',
                        'url' => route('panel.pengaduan.index', ['sts' => 'baru']),
                        'warna' => 'sky',
                    ];
                }
            }

            if ($pgn && ($pgn->isAdmin() || $pgn->isKadis())) {
                $slaLewat = Pgdn::whereNotIn('sts', ['selesai', 'tolak'])
                    ->whereNotNull('batas_sla')
                    ->where('batas_sla', '<', now())
                    ->count();
                if ($slaLewat > 0) {
                    $notif[] = [
                        'judul' => "{$slaLewat} pengaduan melewati batas SLA",
                        'ket' => 'Perlu tindak lanjut segera.',
                        'url' => route('panel.pengaduan.monitor-sla'),
                        'warna' => 'red',
                    ];
                }
            }

            $view->with('notif', $notif);
        });
    }
}

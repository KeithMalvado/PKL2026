<?php

/**
 * Konfigurasi menu sidebar panel petugas.
 * Tiap item punya 'role' = daftar role yg boleh melihat (kosong = semua role login).
 *
 * route : nama route tujuan
 * aktif : pola route utk menandai menu aktif (boleh wildcard *)
 */

return [
    [
        'judul' => 'Dashboard',
        'route' => 'panel.dashboard',
        'aktif' => 'panel.dashboard',
        'ikon' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.5a.75.75 0 00.75.75h4.5a.75.75 0 00.75-.75V15a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v5.25c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75V9.75M8.25 21h8.25',
        'role' => [],
    ],
    [
        'judul' => 'Pengaduan',
        'route' => 'panel.pengaduan.index',
        'aktif' => 'panel.pengaduan.index',
        'ikon' => 'M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z',
        'role' => ['admin', 'kabid', 'teknis'],
    ],
    [
        'judul' => 'Monitoring SLA',
        'route' => 'panel.pengaduan.monitor-sla',
        'aktif' => 'panel.pengaduan.monitor-sla',
        'ikon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z',
        'role' => ['admin', 'kadis'],
    ],
    [
        'judul' => 'Profil Saya',
        'route' => 'panel.profil',
        'aktif' => 'panel.profil',
        'ikon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',
        'role' => [],
    ],
];

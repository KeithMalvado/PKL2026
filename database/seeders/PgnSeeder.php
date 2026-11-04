<?php

namespace Database\Seeders;

use App\Models\Bdg;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder akun petugas (pgn).
 * Membuat 1 akun utk tiap role sbg data awal/login panel admin.
 * Password default: "password" (ganti setelah login pertama).
 */
class PgnSeeder extends Seeder
{
    public function run(): void
    {
        $bdgKeswan = Bdg::where('slug', 'kesehatan-hewan')->first();
        $bdgTernak = Bdg::where('slug', 'peternakan')->first();

        $dtPgn = [
            [
                'name' => 'Administrator PPID',
                'email' => 'admin@dkpp.test',
                'role' => 'admin',
                'jbt' => 'Admin / PPID',
                'bdg_id' => null,
                'no_telp' => '081200000001',
            ],
            [
                'name' => 'Kepala Dinas',
                'email' => 'kadis@dkpp.test',
                'role' => 'kadis',
                'jbt' => 'Kepala Dinas',
                'bdg_id' => null,
                'no_telp' => '081200000002',
            ],
            [
                'name' => 'Kepala Bidang Kesehatan Hewan',
                'email' => 'kabid@dkpp.test',
                'role' => 'kabid',
                'jbt' => 'Kepala Bidang',
                'bdg_id' => $bdgKeswan?->id,
                'no_telp' => '081200000003',
            ],
            [
                'name' => 'Tim Teknis Peternakan',
                'email' => 'teknis@dkpp.test',
                'role' => 'teknis',
                'jbt' => 'Tim Teknis',
                'bdg_id' => $bdgTernak?->id,
                'no_telp' => '081200000004',
            ],
        ];

        foreach ($dtPgn as $pgn) {
            User::updateOrCreate(
                ['email' => $pgn['email']],
                array_merge($pgn, [
                    'password' => Hash::make('password'),
                    'aktif' => true,
                ])
            );
        }
    }
}

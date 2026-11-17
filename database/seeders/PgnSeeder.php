<?php

namespace Database\Seeders;

use App\Models\Bdg;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

/**
 * Seeder 10 akun demo DKPPP Jember.
 *
 * Hanya untuk pengembangan lokal/pengujian.
 * Password awal: password
 *
 * Akun lama:
 * - ID tetap dipertahankan.
 * - Email dan nama diseragamkan.
 * - Password diatur ke "password" SATU KALI
 *   saat email lama dimigrasikan.
 *
 * Jika seeder dijalankan ulang:
 * - Tidak membuat akun duplikat.
 * - Tidak mereset password lagi.
 */
class PgnSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new RuntimeException(
                'Seeder akun demo hanya boleh dijalankan pada local/testing.'
            );
        }

        $akunDemo = [
            [
                'name' => 'Admin DKPPP',
                'email_lama' => 'admin@dkpp.test',
                'email' => 'admin@dkppp.test',
                'role' => 'admin',
                'jbt' => 'Admin / PPID',
                'bidang' => null,
            ],
            [
                'name' => 'Kepala Dinas DKPPP',
                'email_lama' => 'kadis@dkpp.test',
                'email' => 'kadis@dkppp.test',
                'role' => 'kadis',
                'jbt' => 'Kepala Dinas',
                'bidang' => null,
            ],
            [
                'name' => 'Kabid Kesehatan Hewan',
                'email_lama' => 'kabid@dkpp.test',
                'email' => 'kabid.keswan@dkppp.test',
                'role' => 'kabid',
                'jbt' => 'Kepala Bidang',
                'bidang' => 'kesehatan-hewan',
            ],
            [
                'name' => 'Kabid Peternakan',
                'email_lama' => null,
                'email' => 'kabid.ternak@dkppp.test',
                'role' => 'kabid',
                'jbt' => 'Kepala Bidang',
                'bidang' => 'peternakan',
            ],
            [
                'name' => 'Kabid Ketahanan Pangan',
                'email_lama' => 'kabid.workflow@dkpp.test',
                'email' => 'kabid.pangan@dkppp.test',
                'role' => 'kabid',
                'jbt' => 'Kepala Bidang',
                'bidang' => 'ketahanan-pangan',
            ],
            [
                'name' => 'Kabid Perikanan',
                'email_lama' => null,
                'email' => 'kabid.ikan@dkppp.test',
                'role' => 'kabid',
                'jbt' => 'Kepala Bidang',
                'bidang' => 'perikanan',
            ],
            [
                'name' => 'Tim Teknis Kesehatan Hewan',
                'email_lama' => 'teknis.keswan@dkpp.test',
                'email' => 'teknis.keswan@dkppp.test',
                'role' => 'teknis',
                'jbt' => 'Tim Teknis',
                'bidang' => 'kesehatan-hewan',
            ],
            [
                'name' => 'Tim Teknis Peternakan',
                'email_lama' => 'teknis@dkpp.test',
                'email' => 'teknis.ternak@dkppp.test',
                'role' => 'teknis',
                'jbt' => 'Tim Teknis',
                'bidang' => 'peternakan',
            ],
            [
                'name' => 'Tim Teknis Ketahanan Pangan',
                'email_lama' => 'teknis.workflow@dkpp.test',
                'email' => 'teknis.pangan@dkppp.test',
                'role' => 'teknis',
                'jbt' => 'Tim Teknis',
                'bidang' => 'ketahanan-pangan',
            ],
            [
                'name' => 'Tim Teknis Perikanan',
                'email_lama' => null,
                'email' => 'teknis.ikan@dkppp.test',
                'role' => 'teknis',
                'jbt' => 'Tim Teknis',
                'bidang' => 'perikanan',
            ],
        ];

        // Ambil ID berdasarkan slug bidang.
        $slugBidang = [
            'kesehatan-hewan',
            'peternakan',
            'ketahanan-pangan',
            'perikanan',
        ];

        $bidang = Bdg::query()
            ->whereIn('slug', $slugBidang)
            ->pluck('id', 'slug');

        foreach ($slugBidang as $slug) {
            if (! $bidang->has($slug)) {
                throw new RuntimeException(
                    "Bidang {$slug} tidak ditemukan. Jalankan BdgSeeder terlebih dahulu."
                );
            }
        }

        $dibuat = 0;
        $dimigrasikan = 0;
        $sudahAda = 0;

        DB::transaction(function () use (
            $akunDemo,
            $bidang,
            &$dibuat,
            &$dimigrasikan,
            &$sudahAda
        ) {
            foreach ($akunDemo as $dataAkun) {

                // Cari berdasarkan email final.
                $akunBaru = User::query()
                    ->where('email', $dataAkun['email'])
                    ->first();

                // Cari berdasarkan email lama.
                $akunLama = $dataAkun['email_lama']
                    ? User::query()
                        ->where('email', $dataAkun['email_lama'])
                        ->first()
                    : null;

                // Hindari konflik dua pengguna berbeda.
                if (
                    $akunBaru &&
                    $akunLama &&
                    $akunBaru->id !== $akunLama->id
                ) {
                    throw new RuntimeException(
                        "Konflik email {$dataAkun['email']}. "
                        . 'Terdapat dua akun berbeda.'
                    );
                }

                $akun = $akunBaru ?? $akunLama;

                // Pastikan akun lama bukan role lain.
                if (
                    $akun &&
                    $akun->role !== $dataAkun['role']
                ) {
                    throw new RuntimeException(
                        "Role akun {$akun->email} tidak sesuai."
                    );
                }

                $atribut = [
                    'name' => $dataAkun['name'],
                    'email' => $dataAkun['email'],
                    'role' => $dataAkun['role'],
                    'jbt' => $dataAkun['jbt'],
                    'bdg_id' => $dataAkun['bidang']
                        ? $bidang->get($dataAkun['bidang'])
                        : null,
                ];

                if ($akunLama && ! $akunBaru) {

                    // Migrasi akun lama, ID tidak berubah.
                    $akunLama->fill($atribut);

                    // Reset satu kali untuk akun demo lama.
                    $akunLama->password = Hash::make('password');

                    // Status aktif dan nomor telepon
                    // sengaja tidak diubah.
                    $akunLama->save();

                    $dimigrasikan++;

                } elseif ($akunBaru) {

                    // Seeder dijalankan ulang.
                    // Perbarui identitas tanpa mengubah password.
                    $akunBaru->fill($atribut);
                    $akunBaru->save();

                    $sudahAda++;

                } else {

                    // Akun baru.
                    User::create(array_merge($atribut, [
                        'password' => Hash::make('password'),
                        'aktif' => true,
                        'no_telp' => null,
                    ]));

                    $dibuat++;
                }
            }
        });

        $this->command?->info(
            "Seeder DKPPP berhasil: "
            . "{$dibuat} dibuat, "
            . "{$dimigrasikan} dimigrasikan, "
            . "{$sudahAda} sudah tersedia."
        );
    }
}

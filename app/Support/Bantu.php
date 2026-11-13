<?php

namespace App\Support;

use App\Models\Bdg;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Storage;

/**
 * Kumpulan helper tampilan yg dipakai lintas view.
 */
class Bantu
{
    /** Nilai pengaturan situs. */
    public static function setelan(string $kunci, ?string $bawaan = null): ?string
    {
        return Pengaturan::ambil($kunci, $bawaan);
    }

    /** Url logo utama; fallback ke aset bawaan. */
    public static function logo(): string
    {
        $logo = Pengaturan::ambil('logo');

        if ($logo && Storage::disk('public')->exists($logo)) {
            return Storage::url($logo);
        }

        return asset('img/logo-dkpp.png');
    }

    /** Url logo bidang; null bila belum diunggah. */
    public static function logoBdg(?Bdg $bdg): ?string
    {
        if (! $bdg || ! $bdg->logo || ! Storage::disk('public')->exists($bdg->logo)) {
            return null;
        }

        return Storage::url($bdg->logo);
    }

    /** Nomor telepon siap tayang, mis. (0331) 5101342. */
    public static function telp(): ?string
    {
        return Pengaturan::ambil('kontak.telp');
    }

    /** Nomor WhatsApp dalam format 62xxxx utk tautan wa.me. */
    public static function wa(): ?string
    {
        $no = Pengaturan::ambil('kontak.wa');

        if (! $no) {
            return null;
        }

        $no = preg_replace('/[^0-9]/', '', $no);

        if (str_starts_with($no, '0')) {
            $no = '62'.substr($no, 1);
        } elseif (! str_starts_with($no, '62')) {
            $no = '62'.$no;
        }

        return $no;
    }

    /** Nomor WhatsApp siap tayang, mis. +62 331 5101342. */
    public static function waTampil(): ?string
    {
        $no = static::wa();

        if (! $no) {
            return null;
        }

        $sisa = substr($no, 2);

        if (strlen($sisa) < 9) {
            return '+'.$no;
        }

        return '+62 '.substr($sisa, 0, 3).' '.substr($sisa, 3);
    }

    /** Daftar tautan layanan terkait (admin-editable). */
    public static function tautanLayanan(): array
    {
        return [
            ['judul' => 'PPID Kabupaten Jember', 'ket' => 'Portal keterbukaan informasi publik', 'url' => Pengaturan::ambil('tautan.ppid')],
            ['judul' => 'Layanan BKD', 'ket' => 'Badan Kepegawaian Daerah', 'url' => Pengaturan::ambil('tautan.bkd')],
            ['judul' => 'SIKEREN', 'ket' => 'Sistem kearsipan elektronik', 'url' => Pengaturan::ambil('tautan.sikeren')],
        ];
    }

    /** Daftar akun sosial media resmi (hanya yang url-nya terisi). */
    public static function sosmed(): array
    {
        $daftar = [
            ['kunci' => 'facebook', 'nama' => 'Facebook'],
            ['kunci' => 'instagram', 'nama' => 'Instagram'],
            ['kunci' => 'tiktok', 'nama' => 'TikTok'],
            ['kunci' => 'youtube', 'nama' => 'YouTube'],
        ];

        $hasil = [];

        foreach ($daftar as $item) {
            $url = Pengaturan::ambil('sosmed.'.$item['kunci']);

            if (! $url) {
                continue;
            }

            $hasil[] = [
                'kunci' => $item['kunci'],
                'nama' => $item['nama'],
                'url' => $url,
            ];
        }

        return $hasil;
    }
}

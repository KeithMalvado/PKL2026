<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * Service notifikasi WhatsApp.
 *
 * TAHAP SIMULASI:
 * Utk saat ini pesan hanya dicatat ke log & dikembalikn sbg teks,
 * belum mengirim ke WA asli. Saat gateway (mis. Fonnte/Wablas) siap,
 * cukup ganti isi method kirim() tanpa mengubah pemanggilnya.
 */
class WaService
{
    /**
     * Kirim pesan WA ke nomor tujuan.
     * $noTelp = nomor tujuan (format 08xxx / 62xxx)
     * $pesan  = isi pesan
     * return  = true bila "terkirim" (simulasi selalu true)
     */
    public function kirim(string $noTelp, string $pesan): bool
    {
        $noRapi = $this->rapikanNomor($noTelp);

        // SIMULASI: catat ke log, seolah terkirim
        Log::channel('stack')->info('[SIMULASI WA] Kirim pesan', [
            'tujuan' => $noRapi,
            'pesan' => $pesan,
        ]);

        return true;
    }

    /**
     * Rapikan nomor telp ke format 62xxxx (standar WA).
     */
    public function rapikanNomor(string $noTelp): string
    {
        $no = preg_replace('/[^0-9]/', '', $noTelp);

        if (str_starts_with($no, '0')) {
            $no = '62' . substr($no, 1);
        } elseif (! str_starts_with($no, '62')) {
            $no = '62' . $no;
        }

        return $no;
    }

    /**
     * Susun pesan notifikasi kode tiket baru.
     */
    public function pesanTiketBaru(string $kdTkt, string $namaPelapor, string $judul): string
    {
        return "Halo {$namaPelapor},\n\n"
            . "Pengaduan Anda telah kami terima.\n"
            . "Kode Tiket: *{$kdTkt}*\n"
            . "Perihal: {$judul}\n\n"
            . "Simpan kode tiket ini untuk melacak status pengaduan di website kami.\n\n"
            . "Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember";
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

/**
 * Captcha matematika sederhana (tanpa dependency eksternal).
 * Menyimpn jawaban di session, lalu diverifikasi saat submit form.
 */
class CaptchaService
{
    protected const KEY = 'captcha_jwb';

    /**
     * Buat soal captcha baru & simpan jawabannya di session.
     * return = teks soal, mis. "3 + 5"
     */
    public function buat(): string
    {
        $a = random_int(1, 9);
        $b = random_int(1, 9);

        // acak operasi tambah/kurang (pastikan hasil tdk negatif)
        if (random_int(0, 1) === 1 && $a >= $b) {
            $soal = "{$a} - {$b}";
            $jwb = $a - $b;
        } else {
            $soal = "{$a} + {$b}";
            $jwb = $a + $b;
        }

        Session::put(self::KEY, $jwb);

        return $soal;
    }

    /**
     * Cek jawaban user terhadap soal yg tersimpan.
     */
    public function cek(mixed $jawaban): bool
    {
        $benar = Session::get(self::KEY);

        if ($benar === null) {
            return false;
        }

        return (int) $jawaban === (int) $benar;
    }

    /**
     * Hapus jawaban dr session (dipakai setelah validasi).
     */
    public function hapus(): void
    {
        Session::forget(self::KEY);
    }
}

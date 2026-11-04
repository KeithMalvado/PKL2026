<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model konten halaman statis (hal_statis).
 * Diidentifikasi lewat kolom 'kunci' (mis. profil.sambutan).
 */
class HalStatis extends Model
{
    protected $table = 'hal_statis';

    protected $fillable = ['kunci', 'judul', 'isi', 'gambar'];

    /** Ambil konten berdasarkn kunci, aman bila belum ada. */
    public static function byKunci(string $kunci): ?self
    {
        return static::where('kunci', $kunci)->first();
    }
}

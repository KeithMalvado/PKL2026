<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model pengaturan situs (pengaturan).
 * Key-value sederhana utk logo, kontak center, & tautan layanan terkait.
 */
class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = ['kunci', 'nilai'];

    protected static ?array $cache = null;

    /** Ambil nilai pengaturan (null bila belum diisi). */
    public static function ambil(string $kunci, ?string $bawaan = null): ?string
    {
        if (static::$cache === null) {
            static::$cache = static::query()->pluck('nilai', 'kunci')->all();
        }

        return static::$cache[$kunci] ?? $bawaan;
    }

    /** Simpan/nimpa satu pengaturan. */
    public static function simpan(string $kunci, ?string $nilai): void
    {
        static::updateOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
        static::$cache = null;
    }

    /** Buang cache memori (dipakai seeder & test). */
    public static function lupakan(): void
    {
        static::$cache = null;
    }
}

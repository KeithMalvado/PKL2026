<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model artikel & jurnal (art).
 * jenis: artikel | jurnal
 */
class Art extends Model
{
    protected $table = 'art';

    protected $fillable = [
        'jenis', 'judul', 'slug', 'penulis', 'ringkasan',
        'isi', 'gambar', 'file', 'terbit', 'tgl_terbit',
    ];

    protected function casts(): array
    {
        return [
            'terbit' => 'boolean',
            'tgl_terbit' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

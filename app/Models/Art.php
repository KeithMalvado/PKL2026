<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model artikel & jurnal (art).
 * jenis: artikel | jurnal
 */
class Art extends Model
{
    protected $table = 'art';

    protected $fillable = [
        'jenis', 'bdg_id', 'judul', 'slug', 'penulis', 'ringkasan',
        'isi', 'gambar', 'file', 'terbit', 'tgl_terbit',
    ];

    protected function casts(): array
    {
        return [
            'terbit' => 'boolean',
            'tgl_terbit' => 'datetime',
        ];
    }

    public function bdg(): BelongsTo
    {
        return $this->belongsTo(Bdg::class, 'bdg_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

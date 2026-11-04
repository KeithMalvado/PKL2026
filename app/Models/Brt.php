<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model berita (brt).
 * jenis: ppid | kegiatan
 */
class Brt extends Model
{
    protected $table = 'brt';

    protected $fillable = [
        'jenis', 'judul', 'slug', 'ringkasan', 'isi',
        'gambar', 'pgn_id', 'terbit', 'tgl_terbit', 'dilihat',
    ];

    protected function casts(): array
    {
        return [
            'terbit' => 'boolean',
            'tgl_terbit' => 'datetime',
        ];
    }

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pgn_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

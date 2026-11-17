<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agenda extends Model
{
    use SoftDeletes;

    protected $table = 'agendas';

    protected $fillable = [
        'judul',
        'uraian',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'keterangan_waktu',
        'lokasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'dibatalkan_at' => 'datetime',
        ];
    }

    public function bdg(): BelongsTo
    {
        return $this->belongsTo(Bdg::class, 'bdg_id');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function pengubah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diperbarui_oleh');
    }
}

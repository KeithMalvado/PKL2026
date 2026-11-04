<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Laporan Hasil Tindak Lanjut (lhtl).
 */
class Lhtl extends Model
{
    protected $table = 'lhtl';

    protected $fillable = ['pgdn_id', 'pgn_id', 'uraian', 'foto'];

    public function pgdn(): BelongsTo
    {
        return $this->belongsTo(Pgdn::class, 'pgdn_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pgn_id');
    }
}

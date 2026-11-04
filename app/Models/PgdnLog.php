<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model jejak/audit pengaduan (pgdn_log).
 */
class PgdnLog extends Model
{
    protected $table = 'pgdn_log';

    protected $fillable = ['pgdn_id', 'pgn_id', 'aksi', 'sts_lama', 'sts_baru', 'ket'];

    public function pgdn(): BelongsTo
    {
        return $this->belongsTo(Pgdn::class, 'pgdn_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pgn_id');
    }
}

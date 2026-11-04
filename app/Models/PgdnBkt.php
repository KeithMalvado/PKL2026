<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model bukti/lampiran pengaduan (pgdn_bkt).
 */
class PgdnBkt extends Model
{
    protected $table = 'pgdn_bkt';

    protected $fillable = ['pgdn_id', 'path', 'nama_asli', 'tipe'];

    public function pgdn(): BelongsTo
    {
        return $this->belongsTo(Pgdn::class, 'pgdn_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Survei Kepuasan Masyarakat (skm).
 */
class Skm extends Model
{
    protected $table = 'skm';

    protected $fillable = ['pgdn_id', 'skor', 'saran'];

    public function pgdn(): BelongsTo
    {
        return $this->belongsTo(Pgdn::class, 'pgdn_id');
    }
}

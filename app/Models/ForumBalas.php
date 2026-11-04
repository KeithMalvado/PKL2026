<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model balasan forum (forum_balas).
 */
class ForumBalas extends Model
{
    protected $table = 'forum_balas';

    protected $fillable = ['forum_id', 'pgn_id', 'isi'];

    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pgn_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model forum konsultasi (forum).
 * sts moderasi: tunggu | tampil | tolak
 */
class Forum extends Model
{
    protected $table = 'forum';

    protected $fillable = ['nama', 'email', 'judul', 'pertanyaan', 'kat', 'sts'];

    public function balasan(): HasMany
    {
        return $this->hasMany(ForumBalas::class, 'forum_id');
    }
}

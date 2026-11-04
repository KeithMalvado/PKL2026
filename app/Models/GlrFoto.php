<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model galeri foto (glr_foto).
 */
class GlrFoto extends Model
{
    protected $table = 'glr_foto';

    protected $fillable = ['judul', 'album', 'path', 'ket'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model inovasi pelayanan (inov).
 */
class Inov extends Model
{
    protected $table = 'inov';

    protected $fillable = ['judul', 'slug', 'ringkasan', 'isi', 'gambar', 'terbit'];

    protected function casts(): array
    {
        return ['terbit' => 'boolean'];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

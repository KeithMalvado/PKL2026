<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model master bidang (bdg).
 */
class Bdg extends Model
{
    protected $table = 'bdg';

    protected $fillable = ['nama', 'slug', 'kode'];

    /** Petugas di bidang ini. */
    public function petugas(): HasMany
    {
        return $this->hasMany(User::class, 'bdg_id');
    }

    /** Pengaduan yg didisposisi ke bidang ini. */
    public function pgdn(): HasMany
    {
        return $this->hasMany(Pgdn::class, 'bdg_id');
    }
}

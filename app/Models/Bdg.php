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

    protected $fillable = ['nama', 'slug', 'kode', 'logo', 'deskripsi'];

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

    /** Berita bidang ini. */
    public function berita(): HasMany
    {
        return $this->hasMany(Brt::class, 'bdg_id');
    }

    /** Artikel bidang ini. */
    public function artikel(): HasMany
    {
        return $this->hasMany(Art::class, 'bdg_id');
    }

    /** Artikel terbit + bergambar, utk slide beranda. */
    public function artikelSlide(int $batas = 5)
    {
        return $this->artikel()
            ->where('terbit', true)
            ->latest('tgl_terbit')
            ->take($batas)
            ->get();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

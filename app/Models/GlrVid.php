<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model video kegiatan (glr_vid).
 */
class GlrVid extends Model
{
    protected $table = 'glr_vid';

    protected $fillable = ['judul', 'url', 'thumbnail', 'ket'];

    /** Ambil ID video YouTube dr berbagai format url. */
    public function ytId(): ?string
    {
        $url = $this->url ?? '';
        $pola = '%(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([\w-]{11})%i';
        return preg_match($pola, $url, $m) ? $m[1] : null;
    }

    /** Url embed YouTube bila url berupa link YouTube. */
    public function embedUrl(): ?string
    {
        $id = $this->ytId();
        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }

    /** Thumbnail otomatis dr YouTube bila tdk ada thumbnail custom. */
    public function thumbUrl(): ?string
    {
        if ($this->thumbnail) {
            return \Illuminate\Support\Facades\Storage::url($this->thumbnail);
        }
        $id = $this->ytId();
        return $id ? "https://img.youtube.com/vi/{$id}/hqdefault.jpg" : null;
    }
}

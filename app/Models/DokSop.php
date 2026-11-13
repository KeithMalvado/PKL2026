<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model dokumen SOP / standar pelayanan / SK (dok_sop).
 * Berkas berupa PDF yg diunggah admin.
 */
class DokSop extends Model
{
    protected $table = 'dok_sop';

    protected $fillable = ['judul', 'jenis', 'file', 'thn', 'urut'];

    protected function casts(): array
    {
        return [
            'thn' => 'integer',
            'urut' => 'integer',
        ];
    }

    /** Label jenis dokumen. */
    public function labelJenis(): string
    {
        return match ($this->jenis) {
            'standar' => 'Standar Pelayanan',
            'sk' => 'Surat Keputusan',
            default => 'SOP',
        };
    }
}

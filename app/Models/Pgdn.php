<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model pengaduan (pgdn) - inti sistem.
 * sts: baru | verif | tolak | dsps | proses | selesai
 */
class Pgdn extends Model
{
    protected $table = 'pgdn';

    protected $fillable = [
        'kd_tkt', 'nama_pelapor', 'nik', 'no_telp', 'email',
        'judul', 'isi', 'kat', 'lokasi', 'lat', 'lng',
        'sts', 'darurat', 'bdg_id', 'verif_oleh', 'teknis_id', 'alasan_tolak',
        'tgl_verif', 'tgl_dsps', 'batas_sla', 'tgl_selesai', 'token_skm',
    ];

    protected function casts(): array
    {
        return [
            'darurat' => 'boolean',
            'tgl_verif' => 'datetime',
            'tgl_dsps' => 'datetime',
            'batas_sla' => 'datetime',
            'tgl_selesai' => 'datetime',
        ];
    }

    // ===== Relasi =====

    public function bdg(): BelongsTo
    {
        return $this->belongsTo(Bdg::class, 'bdg_id');
    }

    /** Admin yg memverifikasi. */
    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verif_oleh');
    }

    /** Tim teknis yg ditunjuk. */
    public function teknis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teknis_id');
    }

    public function bukti(): HasMany
    {
        return $this->hasMany(PgdnBkt::class, 'pgdn_id');
    }

    public function log(): HasMany
    {
        return $this->hasMany(PgdnLog::class, 'pgdn_id');
    }

    public function lhtl(): HasOne
    {
        return $this->hasOne(Lhtl::class, 'pgdn_id');
    }

    public function skm(): HasOne
    {
        return $this->hasOne(Skm::class, 'pgdn_id');
    }

    // ===== Helper label status =====

    public function labelSts(): string
    {
        return match ($this->sts) {
            'baru' => 'Baru Masuk',
            'verif' => 'Terverifikasi',
            'tolak' => 'Ditolak',
            'dsps' => 'Didisposisi',
            'proses' => 'Ditindaklanjuti',
            'selesai' => 'Selesai',
            default => $this->sts,
        };
    }

    // ===== Helper SLA =====

    /** Apakah pengaduan sdh melewati batas waktu & belum selesai. */
    public function slaLewat(): bool
    {
        return $this->batas_sla
            && $this->sts !== 'selesai'
            && $this->sts !== 'tolak'
            && $this->batas_sla->isPast();
    }

    /** Sisa hari menuju batas SLA (negatif = sudah lewat). */
    public function sisaSlaHari(): ?int
    {
        if (! $this->batas_sla) {
            return null;
        }

        return (int) round(now()->diffInDays($this->batas_sla, false));
    }
}

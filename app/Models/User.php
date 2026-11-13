<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model petugas (pgn) - memakai tabel users bawaan.
 * Role: admin | kadis | kabid | teknis
 */
#[Fillable(['name', 'email', 'password', 'role', 'jbt', 'bdg_id', 'no_telp', 'aktif'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'aktif' => 'boolean',
        ];
    }

    // ===== Relasi =====

    /** Bidang tempat petugas bertugas (utk kabid/teknis). */
    public function bdg(): BelongsTo
    {
        return $this->belongsTo(Bdg::class, 'bdg_id');
    }

    /** Pengaduan yg diverifikasi petugas ini. */
    public function pgdnVerif(): HasMany
    {
        return $this->hasMany(Pgdn::class, 'verif_oleh');
    }

    /** Pengaduan yg ditugaskan ke tim teknis ini. */
    public function pgdnTeknis(): HasMany
    {
        return $this->hasMany(Pgdn::class, 'teknis_id');
    }

    // ===== Helper role =====

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isKadis(): bool
    {
        return $this->role === 'kadis';
    }

    public function isKabid(): bool
    {
        return $this->role === 'kabid';
    }

    public function isTeknis(): bool
    {
        return $this->role === 'teknis';
    }
}

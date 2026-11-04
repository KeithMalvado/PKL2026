<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model produk hukum & kebijakan (prod_hkm).
 */
class ProdHkm extends Model
{
    protected $table = 'prod_hkm';

    protected $fillable = ['judul', 'jenis', 'no_dok', 'thn', 'file', 'ket', 'diunduh'];
}

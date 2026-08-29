<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    protected $fillable = ['nama', 'watt_rekomendasi', 'harga', 'link_produk'];
}

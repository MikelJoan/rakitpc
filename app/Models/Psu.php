<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Psu extends Model
{
    protected $fillable = ['nama', 'kapasitas_watt', 'harga', 'link_produk'];
}

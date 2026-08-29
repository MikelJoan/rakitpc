<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casing extends Model
{
    protected $fillable = ['nama', 'form_factor', 'harga', 'link_produk'];
}

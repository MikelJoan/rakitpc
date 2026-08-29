<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpu extends Model
{
    protected $fillable = ['nama', 'socket', 'harga', 'punya_igpu', 'link_produk'];
}

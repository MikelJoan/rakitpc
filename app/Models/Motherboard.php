<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motherboard extends Model
{
    protected $fillable = ['nama', 'socket', 'tipe_ram_supported', 'jumlah_slot_ram', 'kapasitas_maks_per_slot', 'form_factor', 'harga'];
}

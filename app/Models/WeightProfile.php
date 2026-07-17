<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightProfile extends Model
{
    protected $fillable = ['kebutuhan', 'bobot_cpu', 'bobot_gpu', 'bobot_ram', 'bobot_storage', 'bobot_psu'];
}

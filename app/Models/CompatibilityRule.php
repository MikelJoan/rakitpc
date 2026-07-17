<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompatibilityRule extends Model
{
    protected $fillable = ['kolom_a', 'atribut_a', 'operator', 'kolom_b', 'atribut_b'];
}

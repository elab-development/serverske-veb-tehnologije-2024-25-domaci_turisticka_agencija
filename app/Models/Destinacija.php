<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinacija extends Model
{
    protected $table = 'destinacije';  // OVDE navodiš pravo ime tabele
    protected $fillable = ['naziv', 'drzava'];
}


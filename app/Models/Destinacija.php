<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Destinacija extends Model
{
  use HasFactory;
  protected $table = 'destinacije'; // tačan naziv tabele
    protected $fillable = ['naziv', 'drzava']; // samo postojeće kolone

    // Jedna destinacija može imati više aranžmana
    public function aranzmani()
    {
        return $this->hasMany(Aranzman::class, 'destinacija_id'); // veza sa Aranzman
    }
}

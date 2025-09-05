<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'aranzman_id',
        'datum_rezervacije',
        'broj_osoba',
        'ukupna_cena',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aranzman()
    {
        return $this->belongsTo(Aranzman::class);
    }
}

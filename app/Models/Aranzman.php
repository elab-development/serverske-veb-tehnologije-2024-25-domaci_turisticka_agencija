<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aranzman extends Model
{
    use HasFactory;

    protected $table = 'aranzmani';

    protected $fillable = ['naziv', 'opis', 'cena', 'popust', 'pocetak', 'kraj', 'broj_mesta', 'destinacija_id', 'last_minute'];

    public function destinacija()
    {
        return $this->belongsTo(Destinacija::class);
    }

    public function rezervacije()
    {
        return $this->hasMany(Rezervacija::class);
    }

    public function akcije()
    {
        return $this->hasMany(Akcija::class);
    }
}

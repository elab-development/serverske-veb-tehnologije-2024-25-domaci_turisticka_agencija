<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aranzman extends Model
{
    use HasFactory;

    protected $table = 'aranzmani'; // <--- dodaj ovo

    protected $fillable = ['naziv_aranzmana', 'cena', 'last_minute', 'popust', 'destinacija_id'];

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

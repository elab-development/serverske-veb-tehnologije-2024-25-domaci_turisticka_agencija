<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akcija extends Model
{
    use HasFactory;

    protected $fillable = ['naziv', 'popust', 'aranzman_id'];

    public function aranzman()
    {
        return $this->belongsTo(Aranzman::class);
    }
}

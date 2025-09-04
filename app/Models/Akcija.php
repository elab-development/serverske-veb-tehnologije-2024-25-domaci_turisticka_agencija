<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akcija extends Model
{
    use HasFactory;

    protected $fillable = ['naziv', 'popust', 'aranzman_id'];

    public function aranzman()
    {
        return $this->belongsTo(Aranzman::class);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AranzmanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'aranzman' => $this->aranzman->naziv ?? null,
        'ime' => $this->ime,
        'prezime' => $this->prezime,
        'email' => $this->email,
        'broj_osoba' => $this->broj_osoba,
    ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinacijaResource extends JsonResource
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
        'naziv' => $this->naziv,
        'drzava' => $this->drzava,
        'opis' => $this->opis,
    ];
    }
}

<?php

declare(strict_types=1);

namespace Internships\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name" => "{$this->street}, {$this->city}, {$this->postal_code}, {$this->voivodeship}, {$this->country}",
            "shortName" => "{$this->street}, {$this->city}",
            "coordinates" => [$this->coordinates->longitude, $this->coordinates->latitude],
        ];
    }
}

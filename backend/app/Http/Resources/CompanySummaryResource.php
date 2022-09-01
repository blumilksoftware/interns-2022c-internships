<?php

namespace Internships\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CompanySummaryResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "logo" => $this->logo,
            "status" => $this->status,
            "location" => new LocationResource($this->address),
            "has_signed_papers" => $this->has_signed_papers,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Internships\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            "id" => $this->id,
            "owner_id" => $this->user_id,
            "name" => $this->name,
            "logo" => $this->logo,
            "status" => $this->status,
            "description" => $this->description,
            'address' => $this->address,
            "location" => new LocationResource($this->address),
            "contact_details" => $this->contact_details,
            "specializations" => SpecializationResource::collection($this->specializations),
            "has_signed_papers" => $this->has_signed_papers,
        ];
    }
}

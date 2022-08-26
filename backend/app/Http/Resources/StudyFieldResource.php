<?php

namespace Internships\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class StudyFieldResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request) : array|Arrayable|JsonSerializable
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "specializations" => SpecializationResource::collection($this->specializations),
        ];
    }
}

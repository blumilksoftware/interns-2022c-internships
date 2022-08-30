<?php

declare(strict_types=1);

namespace Internships\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class StudyFieldResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            "id" => $this->name,
            "label" => $this->name,
            "children" => SpecializationResource::collection($this->specializations),
        ];
    }
}

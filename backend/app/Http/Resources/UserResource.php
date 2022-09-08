<?php

declare(strict_types=1);

namespace Internships\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "full_name" => "{$this->first_name} {$this->last_name}",
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "role" => $this->role,
            "children" => CompanyResource::collection($this->companies),
        ];
    }
}

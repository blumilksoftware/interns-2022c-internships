<?php

declare(strict_types=1);

namespace Internships\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Internships\Models\Embeddable\Coordinates;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class CompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
            "user_id" => ["required", "exists:users,id"],
            "address" => ["required"],
            "contact_details" => ["required"],
        ];
    }

    public function data(Coordinates $coordinates): array
    {
        $address = $this->get("address");
        $address["coordinates"] = $coordinates;

        $logoName = null;
        if(!$this->has("logo")) {
            fake()->addProvider(new FakerPicsumImagesProvider(fake()));
            $logoName = fake()->image(storage_path("app/public/images"), 200, 200, false);
        }

        return [
            "name" => $this->get("name"),
            "description" => $this->get("description"),
            "user_id" => $this->get("user_id"),
            "logo" => $logoName ?: $this->get("logo"),
            "address" => $address,
            "contact_details" => $this->get("contact_details"),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Internships\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Internships\Models\Company;
use Internships\Models\Embeddable\Coordinates;
use Internships\Services\LocationFetcher;
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

    public function data(): Company
    {
        $address = $this->get("address");
        $fetchedLocation = (new LocationFetcher())
            ->query(collect($address)
                ->except(["coordinates"])
                ->implode(" "))
            ->getLocations()
            ->first();

        $address["coordinates"] = new Coordinates([
            "latitude" => $fetchedLocation["coordinates"][1],
            "longitude" => $fetchedLocation["coordinates"][0],
        ]);

        $this->merge(["address" => $address]);

        if(!$this->has("logo")) {
            fake()->addProvider(new FakerPicsumImagesProvider(fake()));
            $this->merge(["logo" => fake()->image(storage_path("app/public/images"), 200, 200, false)]);
        }

        return Company::query()->create($this->all());
    }
}

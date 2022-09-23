<?php

declare(strict_types=1);

namespace Internships\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Internships\Enums\CompanyStatus;
use Internships\Enums\Permission;
use Internships\Models\Company;
use Internships\Services\LogoGenerator;
use Intervention\Image\Facades\Image;

class CompanyRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:2500"],
            "address.street" => ["required", "string"],
            "address.city" => ["required", "string"],
            "address.postal_code" => ["required", "string"],
            "address.voivodeship" => ["required", "string"],
            "address.country" => ["required", "string"],
            "address.coordinates" => ["required"],
            "contact_details.email" => ["required", "email"],
            "logoFile" => ["nullable",
                File::image()
                    ->max(3 * 1024)
                    ->dimensions(Rule::dimensions()->maxWidth(2000)->maxHeight(2000)),
            ],
        ];
    }

    public function data(): Company
    {
        $this->merge(["user_id" => auth()->id()]);

        if ($this->hasFile("logoFile")) {
            $image = $this->file("logoFile");
            $filename = Str::uuid() . "." . $image->guessExtension();

            $img = Image::make($image->getRealPath());

            $img->resize(200, 200, function ($constraint): void {
                $constraint->aspectRatio();
            });

            $img->stream();
            Storage::disk("public")->put("images/" . $filename, $img);
        } else {
            $filename = (new LogoGenerator())->generateLogoFromName($this->name);
        }
        $this->merge(["logo" => $filename]);

        $company = Company::query()->create($this->except(["logoFile", "specializations"]));
        $company->specializations()->sync($this->specializations);

        if (Gate::forUser(auth()->user())->allows(Permission::ManageCompanies->value)) {
            $company->update([
                "status" => CompanyStatus::Verified,
            ]);
        }

        return $company;
    }
}

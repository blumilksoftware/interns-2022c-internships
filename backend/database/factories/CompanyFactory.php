<?php

declare(strict_types=1);

namespace Database\Factories;

use Database\Factories\Embeddable\AddressDefines;
use Database\Factories\Embeddable\ContactDetailsDefines;
use Illuminate\Database\Eloquent\Factories\Factory;
use Internships\Enums\CompanyStatus;
use Internships\Models\Company;
use Internships\Models\Embeddable\Address;
use Internships\Models\Embeddable\ContactDetails;
use Internships\Models\Submission;
use Internships\Models\User;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->company(),
            "description" => fake()->sentence(100),
            "user_id" => User::factory(),
            "address" => new Address(AddressDefines::definition()),
            "contact_details" => new ContactDetails(ContactDetailsDefines::definition()),
            "status" => fake()->randomElement(CompanyStatus::toArray()),
            "has_signed_papers" => fake()->boolean(),
        ];
    }

    public function status(CompanyStatus $companyStatus): static
    {
        return $this->state(function (array $attributes) use ($companyStatus) {
            return [
                "status" => $companyStatus,
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (Company $company): void {
            if ($company->status === CompanyStatus::PendingNew) {
                Submission::factory([
                    "company_original_id" => $company->id,
                    "company_edited_id" => null,
                ])->create();
            }

            if ($company->status === CompanyStatus::PendingEdited) {
                $companyOriginal = Company::factory([
                    "name" => $company->name,
                    "user_id" => $company->user_id,
                    "contact_details" => $company->contact_details,
                    "status" => CompanyStatus::Verified,
                    "has_signed_papers" => $company->has_signed_papers,
                ])->create();

                Submission::factory([
                    "company_original_id" => $companyOriginal->id,
                    "company_edited_id" => $company->id,
                ])->create();
            }
        });
    }
}

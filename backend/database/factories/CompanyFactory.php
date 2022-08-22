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
}

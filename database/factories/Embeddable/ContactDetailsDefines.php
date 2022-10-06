<?php

declare(strict_types=1);

namespace Database\Factories\Embeddable;

class ContactDetailsDefines
{
    public static function definition(): array
    {
        return [
            "email" => fake()->companyEmail(),
            "phone_number" => fake()->phoneNumber(),
            "website_url" => config("app.url"),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Internships\Models\Company;

class SubmissionFactory extends Factory
{
    public function definition()
    {
        return [
            "company_original_id" => Company::factory(),
            "company_edited_id" => Company::factory(),
            "comment" => fake()->sentence(100),
        ];
    }
}

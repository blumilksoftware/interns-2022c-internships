<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Internships\Models\Company;
use Internships\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 15; $i++) {
            User::factory(5)
                ->has(Company::factory()->count(rand(1, 2)))
                ->create();
        }
    }
}

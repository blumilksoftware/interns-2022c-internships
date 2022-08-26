<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Internships\Enums\Role;
use Internships\Models\Company;
use Internships\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory([
            "role" => Role::Administrator,
        ])->create();

        User::factory(50)
            ->has(Company::factory(rand(min: 1, max: 3)))
            ->create();
    }
}

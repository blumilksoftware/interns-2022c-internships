<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Internships\Enums\Role;
use Internships\Models\Company;
use Internships\Models\Specialization;
use Internships\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory([
            "role" => Role::Administrator,
        ])->create();

        User::factory(50)
            ->has(Company::factory(rand(1, 3))->afterCreating(function (Company $company): void {
                $company->specializations()
                    ->sync(Specialization::all()->random(rand(1, 5)));
            }))
            ->create();
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Internships\Enums\Role;
use Internships\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(9)->create();
        User::factory([
            "role" => Role::Administrator,
        ])
            ->create();
    }
}

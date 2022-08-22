<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Internships\Models\Company;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory(20)->create();
    }
}

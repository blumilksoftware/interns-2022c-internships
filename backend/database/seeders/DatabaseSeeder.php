<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        File::cleanDirectory(storage_path("app/public/images"));

        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);
    }
}

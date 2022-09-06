<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (File::exists(storage_path("app/public/images"))) {
            File::cleanDirectory(storage_path("app/public/images"));
        } else {
            File::makeDirectory(storage_path("app/public/images"));
        }

        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $imageFolder = storage_path("app/public/images");

        if (File::exists($imageFolder)) {
            File::cleanDirectory($imageFolder);
        } else {
            File::makeDirectory($imageFolder);
        }

        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);
    }
}

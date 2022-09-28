<?php

declare(strict_types=1);

namespace Internships\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Internships\Enums\Role;
use Internships\Models\User;

class CreateAdminUser extends Command
{
    protected $signature = "make:admin {email} {password} {name} {surname}";
    protected $description = "Creates an admin user.";

    public function validate(): void
    {
        $validator = Validator::make([
            "email" => $this->argument("email"),
            "password" => $this->argument("password"),
            "first_name" => $this->argument("name"),
            "last_name" => $this->argument("surname"),
        ], [
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "min:8"],
            "first_name" => ["required"],
            "last_name" => ["required"],
        ]);

        if ($validator->fails()) {
            $this->info("An admin account could not be created.");

            $this->error("An email should be unique and contain a valid syntax.");
            $this->error("A password should contain a minimum of 8 characters.");

            exit();
        }
    }

    public function handle(): void
    {
        $this->validate();

        User::factory([
            "role" => Role::Administrator,
            "first_name" => $this->argument("name"),
            "last_name" => $this->argument("surname"),
            "email" => $this->argument("email"),
            "email_verified_at" => now(),
            "password" => bcrypt($this->argument("password")),
        ])->create();

        $this->comment("Successfully created the admin account.");
    }
}

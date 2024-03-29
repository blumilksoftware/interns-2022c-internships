<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Enums\Role;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("users", function (Blueprint $table): void {
            $table->id()->index();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->string("role")->default(Role::Company->value);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("users");
    }
};

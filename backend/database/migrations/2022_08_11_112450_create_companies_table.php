<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Enums\CompanyStatus;
use Internships\Models\User;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("companies", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->foreignIdFor(User::class)->constrained();
            $table->json("address");
            $table->string("logo")->nullable();
            $table->json("contact_details");
            $table->string("status")->default(CompanyStatus::PendingNew->value);
            $table->boolean("has_signed_papers")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("companies");
    }
};

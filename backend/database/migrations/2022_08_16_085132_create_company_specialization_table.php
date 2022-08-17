<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Models\Company;
use Internships\Models\Specialization;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("company_specialization", function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(Specialization::class)->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("company_specialization");
    }
};

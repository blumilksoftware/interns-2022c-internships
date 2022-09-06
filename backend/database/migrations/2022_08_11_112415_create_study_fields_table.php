<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Models\Department;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("study_fields", function (Blueprint $table): void {
            $table->id()->index();
            $table->string("name");
            $table->foreignIdFor(Department::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("study_fields");
    }
};

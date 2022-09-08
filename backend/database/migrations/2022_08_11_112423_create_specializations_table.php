<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Models\StudyField;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("specializations", function (Blueprint $table): void {
            $table->id()->index();
            $table->string("name");
            $table->foreignIdFor(StudyField::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("specializations");
    }
};

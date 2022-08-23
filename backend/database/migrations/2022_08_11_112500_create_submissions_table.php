<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("submissions", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("company_original_id")->unique()->constrained("companies")->cascadeOnDelete();
            $table->foreignId("company_edited_id")->nullable()->unique()->constrained("companies")->cascadeOnDelete();
            $table->text("comment")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("submissions");
    }
};

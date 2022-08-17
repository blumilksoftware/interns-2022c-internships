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
            $table->foreignId("company_id")->constrained("companies");
            $table->foreignId("edited_company_id")->nullable()->constrained("companies");
            $table->string("comment");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("submissions");
    }
};

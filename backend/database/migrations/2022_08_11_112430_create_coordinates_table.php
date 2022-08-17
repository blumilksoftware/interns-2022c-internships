<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("coordinates", function (Blueprint $table): void {
            $table->id();
            $table->double("latitude");
            $table->double("longitude");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("coordinates");
    }
};

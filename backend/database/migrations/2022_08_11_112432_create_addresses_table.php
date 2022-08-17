<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Models\Coordinates;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("addresses", function (Blueprint $table): void {
            $table->id();
            $table->string("country");
            $table->string("voivodeship");
            $table->string("city");
            $table->string("street");
            $table->string("postal_code");
            $table->foreignIdFor(Coordinates::class)->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("addresses");
    }
};

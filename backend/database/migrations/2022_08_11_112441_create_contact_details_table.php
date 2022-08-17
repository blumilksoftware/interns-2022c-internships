<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("contact_details", function (Blueprint $table): void {
            $table->id();
            $table->string("website")->nullable();
            $table->string("email");
            $table->string("phone")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("contact_details");
    }
};

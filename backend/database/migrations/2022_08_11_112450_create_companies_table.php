<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Internships\Models\Address;
use Internships\Models\ContactDetails;
use Internships\Models\User;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("companies", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Address::class)->constrained();
            $table->string("logo")->nullable();
            $table->foreignIdFor(ContactDetails::class)->constrained()->cascadeOnDelete();
            $table->boolean("is_visible");
            $table->boolean("has_signed_papers");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("companies");
    }
};

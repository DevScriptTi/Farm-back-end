<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('veterinaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last');
            $table->string('username')->unique();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('academic_degree');
            $table->string('license_number')->unique();
            $table->string('clinic_location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinaries');
    }
};

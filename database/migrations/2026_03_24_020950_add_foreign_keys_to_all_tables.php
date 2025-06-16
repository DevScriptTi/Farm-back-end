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
        Schema::table('all_tables', function (Blueprint $table) {
            Schema::table('baladiyas', function (Blueprint $table) {
                $table->foreignId('wilaya_id')->constrained('wilayas')->cascadeOnDelete();
            });

            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('key_id')->constrained('keys')->cascadeOnDelete();
            });

            // Add foreign key to 'mechtas' table
            Schema::table('mechtas', function (Blueprint $table) {
                $table->foreignId('baladiya_id')->constrained('baladiyas')->cascadeOnDelete();
            });

            // Add foreign key to 'farms' table
            Schema::table('farms', function (Blueprint $table) {
                $table->foreignId('mechta_id')->constrained('mechtas')->cascadeOnDelete();
                $table->foreignId('farmer_id')->constrained('farmers')->cascadeOnDelete();
            });

            // Add foreign key to 'pictures' table


            // Add foreign key to 'animal_illness' table
            Schema::table('animal_illnesses', function (Blueprint $table) {
                $table->foreignId('animal_id')->constrained('animals')->cascadeOnDelete();
                $table->foreignId('illness_id')->constrained('illnesses')->cascadeOnDelete();
            });

            // Add foreign key to 'animals' table
            Schema::table('animals', function (Blueprint $table) {
                $table->foreignId('farm_id')->constrained('farms')->cascadeOnDelete();
                $table->foreignId('animal_type_id')->constrained('animal_types')->cascadeOnDelete();
            });

            // Add foreign key to 'qr_codes' table
            Schema::table('q_r_codes', function (Blueprint $table) {
                $table->foreignId('animal_id')->constrained('animals')->cascadeOnDelete();
            });

            // Add foreign key to 'animal_vaccine' table
            Schema::table('animal_vaccines', function (Blueprint $table) {
                $table->foreignId('animal_id')->constrained('animals')->cascadeOnDelete();
                $table->foreignId('vaccine_id')->constrained('vaccines')->cascadeOnDelete();
            });
            Schema::table('veterinaries', function (Blueprint $table) { 
                $table->foreignId('baladiya_id')->constrained('baladiyas')->cascadeOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_tables', function (Blueprint $table) {
            Schema::table('keys', function (Blueprint $table) {
                $table->dropForeign(['keyable_id']);
            });

            // Drop foreign keys from 'baladiyas' table
            Schema::table('baladiyas', function (Blueprint $table) {
                $table->dropForeign(['wilaya_id']);
            });

            // Drop foreign keys from 'mechtas' table
            Schema::table('mechtas', function (Blueprint $table) {
                $table->dropForeign(['baladiya_id']);
            });

            // Drop foreign keys from 'farms' table
            Schema::table('farms', function (Blueprint $table) {
                $table->dropForeign(['mechta_id']);
                $table->dropForeign(['farmer_id']);
            });

            // Drop foreign keys from 'pictures' table
            Schema::table('pictures', function (Blueprint $table) {
                $table->dropForeign(['pictureable_id']);
            });

            // Drop foreign keys from 'animal_illness' table
            Schema::table('animal_illness', function (Blueprint $table) {
                $table->dropForeign(['animal_id']);
                $table->dropForeign(['illness_id']);
            });

            // Drop foreign keys from 'animals' table
            Schema::table('animals', function (Blueprint $table) {
                $table->dropForeign(['farm_id']);
                $table->dropForeign(['animal_type_id']);
            });

            // Drop foreign keys from 'qr_codes' table
            Schema::table('qr_codes', function (Blueprint $table) {
                $table->dropForeign(['animal_id']);
            });

            // Drop foreign keys from 'animal_vaccine' table
            Schema::table('animal_vaccine', function (Blueprint $table) {
                $table->dropForeign(['animal_id']);
                $table->dropForeign(['vaccine_id']);
            });
        });
    }
};

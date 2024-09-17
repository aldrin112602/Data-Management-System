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
        Schema::create('location_information', function (Blueprint $table) {
            $table->id();
            $table->string('location_name');
            $table->string('address');
            $table->foreignId('province_id')->constrained('provincial_data')->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained('municipal_data')->onDelete('cascade');
            $table->string('owner')->nullable();
            $table->text('description')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_information');
    }
};

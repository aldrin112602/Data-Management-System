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
        Schema::create('municipal_data', function (Blueprint $table) {
            $table->id();
            $table->string('municipal_name');
            $table->foreignId('province_id')->constrained('provincial_data')->onDelete('cascade');
            $table->string('municipal_logo')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipal_data');
    }
};

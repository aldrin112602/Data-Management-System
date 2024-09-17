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
        Schema::table('location_information', function (Blueprint $table) {
            Schema::table('location_information', function (Blueprint $table) {
                $table->string('image')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('location_information', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};

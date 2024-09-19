<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PinnedLocation;

class PinnedLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::first(); // Get the first user
        // $location = Location::first(); // Get the first location

        PinnedLocation::create([
            'user_id' => 1,
            'location_id' => 1,
            'status' => 'pending',
            'latitude' => 51.509865, // Example latitude
            'longitude' => -0.118092, // Example longitude
        ]);
    }
}

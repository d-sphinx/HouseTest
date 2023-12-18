<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = base_path('property-data.csv');
        $houses = array_map('str_getcsv', file($csvFile));

        if (count($houses) > 1) {

            unset($houses[0]);

            foreach ($houses as $house) {
                House::create([
                    'name' => $house[0],
                    'price' => $house[1],
                    'bedrooms' => $house[2],
                    'bathrooms' => $house[3],
                    'storeys' => $house[4],
                    'garages' => $house[5],
                ]);
            }
        }

    }
}

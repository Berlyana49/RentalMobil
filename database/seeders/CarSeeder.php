<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'brand_model' => 'Toyota Vios',
                'category' => 'sedan',
                'rental_rate_per_day' => '250000',
                'plate_number' => 'B 1234 XYZ',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'brand_model' => 'Lamborgini Huracan',
                'category' => 'coupe',
                'rental_rate_per_day' => '900000',
                'plate_number' => 'B 7633 JFGH',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'brand_model' => 'Suzuki',
                'category' => 'hatchback',
                'rental_rate_per_day' => '300000',
                'plate_number' => 'B 4567 SYN',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'brand_model' => 'Daihatsu Sirion',
                'category' => 'hatchback',
                'rental_rate_per_day' => '500000',
                'plate_number' => 'B 1331 POQ',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'brand_model' => 'Cherry Thigo',
                'category' => 'suv',
                'rental_rate_per_day' => '700000',
                'plate_number' => 'B 8745 KLM',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}

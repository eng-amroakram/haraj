<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuel_types = config('data.data.fuel-types');

        foreach ($fuel_types as $fuel_type) {
            DB::table('fuel_types')->insert([
                'name_en' => $fuel_type,
                'name_ar' => __($fuel_type),

            ]);
        }

        $this->command->info('Fuel Type table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars_models = config('data.data.cars-models');

        foreach ($cars_models as $car_model) {
            DB::table('car_models')->insert([
                'name_en' => $car_model,
                'name_ar' => __($car_model),
            ]);
        }

        $this->command->info('Cars models table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $car_conditions = config('data.data.car-conditions');

        foreach ($car_conditions as $car_condition) {
            DB::table('car_conditions')->insert([
                'name_en' => $car_condition,
                'name_ar' => __($car_condition),
            ]);
        }

        $this->command->info('Car conditions table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

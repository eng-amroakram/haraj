<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnginePowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $engine_powers = config('data.data.engine-powers');

        foreach ($engine_powers as $engine_power) {
            DB::table('engine_powers')->insert([
                'name_en' => $engine_power,
                'name_ar' => __($engine_power),
            ]);
        }

        $this->command->info('Engine Power table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

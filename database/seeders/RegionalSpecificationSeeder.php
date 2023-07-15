<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionalSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regional_specifications = config('data.data.regional-specifications');

        foreach ($regional_specifications as $regional_specification) {
            DB::table('regional_specifications')->insert([
                'name_en' => $regional_specification,
                'name_ar' => __($regional_specification),

            ]);
        }

        $this->command->info('Regional Specifications table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

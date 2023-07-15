<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $additional_features = config('data.data.additional-features');

        foreach ($additional_features as $additional_feature) {
            DB::table('additional_features')->insert([
                'name_en' => $additional_feature,
                'name_ar' => __($additional_feature),
            ]);
        }

        $this->command->info('Additional features table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

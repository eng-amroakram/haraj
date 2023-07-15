<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insurances = config('data.data.insurances');

        foreach ($insurances as $insurance) {
            DB::table('insurances')->insert([
                'name_en' => $insurance,
                'name_ar' => __($insurance),
            ]);
        }

        $this->command->info('Insurances table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

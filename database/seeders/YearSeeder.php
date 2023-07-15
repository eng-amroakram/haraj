<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = config('data.years');

        foreach ($years as $year) {
            DB::table('years')->insert([
                'name_en' => $year,
                'name_ar' => __($year),
            ]);
        }

        $this->command->info('Transmission Types table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

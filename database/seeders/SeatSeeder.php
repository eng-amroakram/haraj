<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats_numbers = config('data.data.seats-number');

        foreach ($seats_numbers as $seats_number) {
            DB::table('seats')->insert([
                'name_en' => $seats_number,
                'name_ar' => __($seats_number),

            ]);
        }

        $this->command->info('Seats table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $speeds = config('data.data');

        foreach ($speeds as $speed) {
            DB::table('speeds')->insert([
                'name' => $speed,
            ]);
        }

        $this->command->info('Seller Types table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

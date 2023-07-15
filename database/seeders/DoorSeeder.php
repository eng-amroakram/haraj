<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doors = config('data.data.doors-number');

        foreach ($doors as $door) {
            DB::table('doors')->insert([
                'name_en' => $door,
                'name_ar' => __($door),
            ]);

        }

        $this->command->info('Doors table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

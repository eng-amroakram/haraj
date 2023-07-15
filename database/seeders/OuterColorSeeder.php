<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OuterColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = config('data.data.colors');

        foreach ($colors as $color) {
            DB::table('outer_colors')->insert([
                'name_en' => $color,
                'name_ar' => __($color),

            ]);
        }

        $this->command->info('Outer Colors table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

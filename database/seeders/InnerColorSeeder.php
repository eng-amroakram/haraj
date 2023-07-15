<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InnerColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = config('data.data.colors');

        foreach ($colors as $color) {
            DB::table('inner_colors')->insert([
                'name_en' => $color,
                'name_ar' => __($color),

            ]);
        }

        $this->command->info('Inner Color table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CylinderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cylinders = config('data.data.cylinders');

        foreach ($cylinders as $cylinder) {
            DB::table('cylinders')->insert([
                'name_en' => $cylinder,
                'name_ar' => __($cylinder),

            ]);
        }

        $this->command->info('Cylinders table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MechanicalConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mechanical_conditions = config('data.data.mechanical-conditions');

        foreach ($mechanical_conditions as $mechanical_condition) {
            DB::table('mechanical_conditions')->insert([
                'name_en' => $mechanical_condition,
                'name_ar' => __($mechanical_condition),

            ]);
        }

        $this->command->info('Mechanical Conditions table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

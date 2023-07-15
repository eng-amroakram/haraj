<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BodyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $body_types = config('data.data.body-types');

        foreach ($body_types as $body_type) {
            DB::table('body_types')->insert([
                'name_en' => $body_type,
                'name_ar' => __($body_type),
            ]);
        }

        $this->command->info('Body types table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

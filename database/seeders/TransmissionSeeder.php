<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transmissions_types = config('data.data.transmissions-types');

        foreach ($transmissions_types as $transmissions_type) {
            DB::table('transmissions')->insert([
                'name_en' => $transmissions_type,
                'name_ar' => __($transmissions_type),

            ]);
        }

        $this->command->info('Transmission Types table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

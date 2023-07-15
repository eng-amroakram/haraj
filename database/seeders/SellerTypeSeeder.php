<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller_types = config('data.data.seller-types');

        foreach ($seller_types as $seller_type) {
            DB::table('seller_types')->insert([
                'name_en' => $seller_type,
                'name_ar' => __($seller_type),
            ]);
        }

        $this->command->info('Seller Types table seeded!');
        $this->command->info('Thanks for using our seeder!');
    }
}

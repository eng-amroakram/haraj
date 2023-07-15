<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BodyTypeSeeder::class,
            CarConditionSeeder::class,
            CarModelSeeder::class,
            CylinderSeeder::class,
            DoorSeeder::class,
            EnginePowerSeeder::class,
            FuelTypeSeeder::class,
            InnerColorSeeder::class,
            OuterColorSeeder::class,
            InsuranceSeeder::class,
            MechanicalConditionSeeder::class,
            RegionalSpecificationSeeder::class,
            SeatSeeder::class,
            SellerTypeSeeder::class,
            TransmissionSeeder::class,
            YearSeeder::class,
            AdditionalFeaturesSeeder::class,
        ]);
    }
}

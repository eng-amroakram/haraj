<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Abu Dhabi' => 'أبو ظبي',
            'Ajman' => 'عجمان',
            "Fujairah" =>   'الفجيرة',
            'Dubai' => 'دبي',
            'Ras Al Khaimah' => 'رأس الخيمة',
            'Sharjah' => 'الشارقة',
            'Umm Al Quwain' => 'أم القيوين',
        ];

        foreach($names as $name_en => $name_ar) {
            City::create([
                'name_en' => $name_en,
                'name_ar' => $name_ar,
                'status' => 'active',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\AvailableDay;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ["day_en"=>"Saturday","day_ar"=>" السبت"],
            ["day_en"=>"Sunday","day_ar"=>"الأحد"],
            ["day_en"=>"Monday","day_ar"=>"الإثنين"],
            ["day_en"=>"Tuesday","day_ar"=>"الثلاثاء"],
            ["day_en"=>"Wednesday","day_ar"=>"الأربعاء"],
            ["day_en"=>"Thursday","day_ar"=>"الخميس "],
        ];

        foreach ($days as $day) {
            Day::create(
                [
                    'day_en' => $day['day_en'],
                    'day_ar' => $day['day_ar'],
                ],
            );
        }
    }
}

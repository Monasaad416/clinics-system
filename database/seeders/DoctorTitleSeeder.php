<?php

namespace Database\Seeders;

use App\Models\DoctorTitle;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            ["name_en"=>"Doctor","name_ar"=>"دكتور"],
            ["name_en"=>"Specialist","name_ar"=>" أخصائي"],
            ["name_en"=>"Prof. Doctor","name_ar"=>"أستاذ دكتور"],
        ];

        foreach ($titles as $title) {
            $slug = Str::slug($title['name_ar']);
            DoctorTitle::create(
                [
                    'name_en' => $title['name_en'],
                    'name_ar' => $title['name_ar'],
                    'slug' => $slug,
                ],
            );
        }
    }
}

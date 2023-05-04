<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ProfessionalTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfessionalTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            ["name_en"=>"Specialist","name_ar"=>" أخصائي"],
            ["name_en"=>"Consultant","name_ar"=>"إستشاري"],
            ["name_en"=>"Professor Assistant","name_ar"=>"مدرس مساعد "],
            ["name_en"=>"Professor","name_ar"=>"أستاذ"],
            ["name_en"=>"General Practitioner","name_ar"=>"طبيب عام"],
        ];

        foreach ($titles as $title) {
            $slug = Str::slug($title['name_ar']);
            ProfessionalTitle::create(
                [
                    'name_en' => $title['name_en'],
                    'name_ar' => $title['name_ar'],
                    'slug' => $slug,
                ],
            );
        }
    }
}

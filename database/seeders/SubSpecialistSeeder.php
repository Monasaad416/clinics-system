<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\SubSpecialist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubSpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $specialists = [
                [
                    "name_en"=>" Gynecology-1 ",
                    "name_ar"=>"-1النساء والتوليد ",
                    "specialist_id" => 1,
            
                ],

                [
                    "name_en"=>" Gynecology-2 ",
                    "name_ar"=>"-2النساء والتوليد ",
                    "specialist_id" => 1,
            
                ],
                [
                    "name_en"=>"pediatrics-1",
                    "name_ar"=>"-1طب الأطفال",
                    "specialist_id" => 2,
                ],

                [
                    "name_en"=>"pediatrics-2",
                    "name_ar"=>"-2طب الأطفال",
                    "specialist_id" => 2,
                ],
                [
                    "name_en"=>"Internal Medicine-1 ",
                    "name_ar"=>"-1الباطنة العامة",
                    "specialist_id" => 3,
                ],

                [
                    "name_en"=>"Internal Medicine-2 ",
                    "name_ar"=>"-2الباطنة العامة",
                    "specialist_id" => 3,
                ],
                [
                    "name_en"=>"Orthopedics-1  ",
                    "name_ar"=>"-1العظام",
                    "specialist_id" => 4,
                ],

                [
                    "name_en"=>"Orthopedics-1  ",
                    "name_ar"=>"-1العظام",
                    "specialist_id" => 4,
                ],
        
   
                     [
                    "name_en"=>", oral surgery-1",
                    "name_ar"=>"-1جراحة الفم والأسنان ",
                    "specialist_id" => 5,
                ],
                [
                    "name_en"=>", oral surgery-2",
                    "name_ar"=>"-2جراحة الفم والأسنان ",
                    "specialist_id" => 5,
                ],
                   [
                    "name_en"=>"ENT-1",
                    "name_ar"=>"-1الأنف والأذن والحنجرة",
                    "specialist_id" => 6,
                ],
                [
                    "name_en"=>"ENT-2",
                    "name_ar"=>"-2الأنف والأذن والحنجرة",
                    "specialist_id" => 6,
                ],
            ];
        foreach ($specialists as $sp) {
            $slug = Str::slug($sp['name_en']);
            SubSpecialist::create(
                [
                    'name_en' => $sp['name_en'],
                    'name_ar' => $sp['name_ar'],
                    'slug' => $slug,
                    'specialist_id' => $sp['specialist_id'],
                ],
            );
        }
    }
}

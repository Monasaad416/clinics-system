<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialists = [
                [
                    "name_en"=>" Gynecology ",
                    "name_ar"=>"النساء والتوليد ", 
                    "image" => "fas fa-heartbeat" ,          
                ],
                [
                    "name_en"=>"pediatrics.",
                    "name_ar"=>"طب الأطفال",
                    "image" => "fas fa-pills" ,    
                ],
                [
                    "name_en"=>"Internal Medicine ",
                    "name_ar"=>"الباطنة العامة",
                    "image" => "fas fa-hospital-user" ,    
                ],
                   [
                    "name_en"=>"Orthopedics  ",
                    "name_ar"=>"العظام",
                    "image" => "fas fa-dna" ,    
                ],
                   [
                    "name_en"=>"oral surgery ",
                    "name_ar"=>"جراحة الفم والأسنان ",
                    "image" => "fas fa-wheelchair" ,    
                ],
                [
                    "name_en"=>"ENT",
                    "name_ar"=>"fas fa-notes-medical",
                    "image" => "fas fa-heartbeat" ,    
                ],
            ];
        foreach ($specialists as $sp) {
            $slug = Str::slug($sp['name_en']);
            Specialist::create(
                [
                    'name_en' => $sp['name_en'],
                    'name_ar' => $sp['name_ar'],
                    'slug' => $slug,
                    "image" => $sp['image'], 
                ],
            );
        }
    }
}

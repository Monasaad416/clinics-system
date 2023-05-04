<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [["name_en"=>"Reception-1","name_ar"=>"الاستقبال-1","branch_id" => 1],
                        ["name_en"=>"Customer Service-1","name_ar"=>" خدمة العملاء-1","branch_id" => 1],
                        ["name_en"=>"Marketing-1","name_ar"=>"التسويق-1","branch_id" => 1],
                        ["name_en"=>"Financial-1","name_ar"=>"الحسابات-1 ","branch_id" => 1],
                        ["name_en"=>"Nursing-1","name_ar"=>"التمريض-1","branch_id" => 1],
                        ["name_en"=>"Doctors-1","name_ar"=>"الأطباء-1","branch_id" => 1],
                        ["name_en"=>"administration-1","name_ar"=>"الإدارة-1","branch_id" => 1],

                        ["name_en"=>"Reception-2","name_ar"=>"الإستقبال-2","branch_id" => 2],
                        ["name_en"=>"Customer Service-2","name_ar"=>" خدمة العملاء-2","branch_id" => 2],
                        ["name_en"=>"Marketing=2","name_ar"=>"التسويق-2","branch_id" => 2],
                        ["name_en"=>"Financial=2","name_ar"=>"الحسابات-2 ","branch_id" => 2],
                        ["name_en"=>"Nursing-2","name_ar"=>"التمريض-2","branch_id" => 2],
                        ["name_en"=>"Doctors-2","name_ar"=>"الأطباء-2","branch_id" => 2],
                        ["name_en"=>"administration-2","name_ar"=>"الإدارة-2","branch_id" => 2],

                        ["name_en"=>"Reception-3","name_ar"=>"الإستقبال-3","branch_id" => 3],
                        ["name_en"=>"Customer Service-3","name_ar"=>" خدمة العملاء-3","branch_id" => 3],
                        ["name_en"=>"Marketing=3","name_ar"=>"التسويق-3","branch_id" => 3],
                        ["name_en"=>"Financial-3","name_ar"=>"الحسابات-3 ","branch_id" => 3],
                        ["name_en"=>"Nursing-3","name_ar"=>"التمريض-3","branch_id" => 3],
                        ["name_en"=>"Doctors-3","name_ar"=>"الأطباء-3","branch_id" => 3],
                        ["name_en"=>"administration-3","name_ar"=>"الإدارة-3","branch_id" => 3],
                    ];
        foreach ($departments as $department) {
            $slug = Str::slug($department['name_en']);
            Department::create(
                [
                    'name_en' => $department['name_en'],
                    'name_ar' => $department['name_ar'],
                    'slug' => $slug,
                    'branch_id' => $department['branch_id'],

                ],
            );
        }
    }
}

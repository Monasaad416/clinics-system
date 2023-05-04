<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $services = [
                        [
                            "name_en"=>"test",
                            "name_ar"=>" تحليل",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>"وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ",
                            "price"=>"300",
                            "branch_id"=>1,

                        ],
                        [
                            "name_en"=>"CAT Scan",
                            "name_ar"=>"اشعة مقطعية ",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>"وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت",
                            "price"=>"1000",
                            "branch_id"=>1,

                        ],
                        [
                            "name_en"=>"MRI Scan ",
                            "name_ar"=>"اشعة رنين ",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>" وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ",
                            "price"=>"1000",
                            "branch_id"=>1
                        ],
                                     [
                            "name_en"=>"test",
                            "name_ar"=>" تحليل",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>"وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ",
                            "price"=>"300",
                            "branch_id"=>2,

                        ],
                        [
                            "name_en"=>"CAT Scan",
                            "name_ar"=>"اشعة مقطعية ",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>"وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت",
                            "price"=>"1000",
                            "branch_id"=>2,

                        ],
                        [
                            "name_en"=>"MRI Scan ",
                            "name_ar"=>"اشعة رنين ",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>" وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ",
                            "price"=>"1000",
                            "branch_id"=>2
                        ],
                                     [
                            "name_en"=>"test",
                            "name_ar"=>" تحليل",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>"وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ",
                            "price"=>"300",
                            "branch_id"=>3,

                        ],
                        [
                            "name_en"=>"CAT Scan",
                            "name_ar"=>"اشعة مقطعية ",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>"وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت",
                            "price"=>"1000",
                            "branch_id"=>3,

                        ],
                        [
                            "name_en"=>"MRI Scan ",
                            "name_ar"=>"اشعة رنين ",
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                            "description_ar"=>" وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ",
                            "price"=>"1000",
                            "branch_id"=>3
                        ],

                    ];


            foreach ($services as $branch) {
            $slug = Str::slug($branch['name_en']);
            Service::create(
                [
                    'name_en' => $branch['name_en'],
                    'name_ar' => $branch['name_ar'],
                    'slug' => $slug,
                    'description_en' => $branch['description_en'],
                    'description_ar' => $branch['description_ar'],
             
                    'price' => $branch['price'],
                    'branch_id' => $branch['branch_id'],
                ],
            );
        }
    }



}

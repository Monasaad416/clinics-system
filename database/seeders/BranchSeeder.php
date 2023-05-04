<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
                        [
                            "name_en"=>"Sheikh Zayed",
                            "name_ar"=>"الشيخ زايد",
                            "address_en"=>"Charles Mall, located in the Sheikh Zayed area, in the seventh district in particular"
                            ,"address_ar"=>"شالز مول، المتواجد في منطقة الشيخ زايد، بالحي السابع ",
                            "lattitude"=>"30.854372",
                            "longitude"=>"29.531840",
                            "phones"=>"234565777",'234566777',
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
                            "description_ar"=>"لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...",
                        ],
                        [
                            "name_en"=>"Nasr City",
                            "name_ar"=>"مدينة نصر",
                            "address_en"=>"nars ciry ,abc street"
                            ,"address_ar"=>"مدينة نصر شارع ا",
                            "lattitude"=>"30.854372",
                            "longitude"=>"29.531840",
                            "phones"=>"234565777",'234566777',
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
                            "description_ar"=>"لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...",
                        ],
                        [
                            "name_en"=>"New Cairo ",
                            "name_ar"=>"القاهرة الجديد",
                            "address_en"=>"new cairo abc streetr"
                            ,"address_ar"=>"القاهرة الجديدة شارع ا ",
                            "lattitude"=>"30.854372",
                            "longitude"=>"29.531840",
                            "phones"=>"234565777",'234566777',
                            "description_en"=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
                            "description_ar"=>"لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...",
                        ],

                    ];
        foreach ($branches as $branch) {
            $slug = Str::slug($branch['name_en']);
            Branch::create(
                [
                    'name_en' => $branch['name_en'],
                    'name_ar' => $branch['name_ar'],
                    'slug' => $slug,
                    'address_en' => $branch['address_en'],
                    'address_ar' => $branch['address_ar'],
                    'lattitude' => $branch['lattitude'],
                    'longitude' => $branch['longitude'],
                    'phones' => $branch['phones'],
                    'description_ar' => $branch['description_ar'],
                    'description_en' => $branch['description_en'],
                ],
            );
        }
    }
}

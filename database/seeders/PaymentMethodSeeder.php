<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $methods = [ 
            ["name_ar"=>"كاش","name_en"=>" Cash"],
            ["name_ar"=>"فيزا","name_en"=>"Visa"]
           ];
        foreach ($methods as $method) {
            $slug = Str::slug($method['name_en']);
            PaymentMethod::create(
                [
                    'name_en' => $method['name_en'],
                    'name_ar' => $method['name_ar'],
                    'slug' => $slug,
                ]);
        }
}

}

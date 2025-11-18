<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Du lịch trong nước',
                'slug' => 'du-lich-trong-nuoc',
                'description' => 'Các tour du lịch trong nước Việt Nam',
            ],
            [
                'name' => 'Du lịch nước ngoài',
                'slug' => 'du-lich-nuoc-ngoai',
                'description' => 'Các tour du lịch quốc tế',
            ],
            [
                'name' => 'Du lịch biển đảo',
                'slug' => 'du-lich-bien-dao',
                'description' => 'Các tour du lịch biển và đảo',
            ],
            [
                'name' => 'Du lịch văn hóa',
                'slug' => 'du-lich-van-hoa',
                'description' => 'Các tour du lịch khám phá văn hóa',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}


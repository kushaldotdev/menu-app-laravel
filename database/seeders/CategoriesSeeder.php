<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use GuzzleHttp\Promise\Create;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(4)->create();
        Category::create([
            'category_name' => 'Foods',
            'category_href' => 'foods',
            'category_description' => 'A variety of food items including fruits, vegetables, meats, and more',
            'category_logo' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg>',
            'category_status' => 'active',
            'parent_category_id' => null
        ]);

        Category::create([
            'category_name' => 'Beverages',
            'category_href' => 'beverages',
            'category_description' => 'A wide selection of drinks including sodas, juices, and more',
            'category_logo' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cup-soda"><path d="m6 8 1.75 12.28a2 2 0 0 0 2 1.72h4.54a2 2 0 0 0 2-1.72L18 8"></path><path d="M5 8h14"></path><path d="M7 15a6.47 6.47 0 0 1 5 0 6.47 6.47 0 0 0 5 0"></path><path d="m12 8 1-6h2"></path></svg>',
            'category_status' => 'active',
            'parent_category_id' => null
        ]);

        Category::create([
            'category_name' => 'Desserts',
            'category_href' => 'desserts',
            'category_description' => 'Sweet treats to satisfy your cravings',
            'category_logo' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake-slice"><circle cx="9" cy="7" r="2"></circle><path d="M7.2 7.9 3 11v9c0 .6.4 1 1 1h16c.6 0 1-.4 1-1v-9c0-2-3-6-7-8l-3.6 2.6"></path><path d="M16 13H3"></path><path d="M16 17H3"></path></svg>',
            'category_status' => 'active',
            'parent_category_id' => null
        ]);

        Category::create([
            'category_name' => 'Drinks',
            'category_href' => 'drinks',
            'category_description' => 'Soft drinks, juices, milkshakes, and other beverages',
            'category_logo' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wine"><path d="M8 22h8"></path><path d="M7 10h10"></path><path d="M12 15v7"></path><path d="M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"></path></svg>',
            'category_status' => 'active',
            'parent_category_id' => null
        ]);

        Category::factory(10)->subCategory()->create();
    }
}

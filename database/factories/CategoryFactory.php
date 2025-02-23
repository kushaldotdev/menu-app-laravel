<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = "Main " . $this->faker->words(2, true);
        $href = str_replace(' ', '-', strtolower($name));
        return [
            'category_name' => $name,
            'category_href' => $href,
            'category_description' => $this->faker->sentence(),
            // 'category_logo' => $this->faker->imageUrl(100, 100, 'business', true, 'logos'),
            'category_logo' => "https://picsum.photos/100?random=" . $this->faker->randomNumber(1, 1000),
            'category_status' => 'active',
            'parent_category_id' => null,
        ];
    }

    public function subCategory()
    {
        return $this->state(function (array $attributes) {
            $Category = Category::inRandomOrder()->whereNull('parent_category_id')->first();
            $name = $Category->category_name . '-' . "Sub " . $this->faker->words(2, true);
            $href = $name;
            return [
                'category_name' => $name,
                'category_href' => $href,
                'parent_category_id' => $Category->category_id,
            ];
        });
    }
}

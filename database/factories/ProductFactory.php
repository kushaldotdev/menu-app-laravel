<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $category_ids = \App\Models\Category::where('parent_category_id', '>', 0)
            ->pluck('category_id')
            ->toArray();

        return [
            'product_sku' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'product_image' => "https://picsum.photos/800?random=" . $this->faker->randomNumber(1, 1000),
            'product_name' => $this->faker->name(4, true),
            'product_description' => $this->faker->sentence(),
            'product_long_description' => $this->faker->paragraphs(3, true),
            'product_price' => $this->faker->randomFloat(0, 1000, 2),
            'product_veg_non_veg' => $this->faker->randomElement(['veg', 'non-veg', 'n/a']),
            'product_status' => $this->faker->randomElement(['active']),
            'category_id' => $this->faker->randomElement($category_ids),
        ];
    }
}

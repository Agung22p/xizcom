<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $product_name= $this->faker->unique()->words($nb=2,$asText = true);
        $slug = Str::slug($product_name);
        $image_name = $this->faker->numberBetween(1,24).'.jpg';
        return [
            'name' => Str::title($product_name),
            'slug' => $slug,
            'description' => $this->faker->text(200),
            'price' => $this->faker->numberBetween(100000,50000000),
            'SKU' => 'SMD' .$this->faker->numberBetween(100,500),
            'status' => 'instock',
            'quantity' => $this->faker->numberBetween(100,200),
            'image' => $image_name,
            'images' => $image_name,
            'category_id' => $this->faker->numberBetween(1,6),
            'brand_id' => $this->faker->numberBetween(1,6),

        ];
    }
}

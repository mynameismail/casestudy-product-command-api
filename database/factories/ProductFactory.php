<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
        return [
            'sku' => fake()->numerify('SKU-###'),
            'name' => 'abc',
            'price' => 1000,
            'stock' => 1000,
            'category_id' => Category::factory(),
            'created_at' => time(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'category_id' => \App\Models\Category::factory(),
            'price' => fake()->numberBetween(10000, 500000),
            'qty' => fake()->numberBetween(1, 50), // Ganti jadi 'stock' jika di database kamu namanya stock
        ];
    }
}

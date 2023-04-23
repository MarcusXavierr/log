<?php

namespace Database\Factories;

use Bezhanov\Faker\Provider\Commerce;
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
    public function definition()
    {
        $this->faker->addProvider(new Commerce($this->faker));

        return [
            'name' => "{$this->faker->productName} - " . random_int(1,100),
            'price' => $this->faker->numberBetween(1000, 10000),
        ];
    }
}

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
            'name' => array_slice(explode(' ', $this->faker->productName), -1)[0],
            'description' => $this->faker->text(30),
            'price' => $this->faker->numberBetween(1000, 10000),
        ];
    }
}

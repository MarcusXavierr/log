<?php

namespace Database\Factories;

use App\Support\Constants\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $regions = Region::getAllRegions();

        return [
            'value' => $this->faker->numberBetween(10000, 999999),
            'region' => data_get($regions, array_rand($regions))
        ];
    }
}

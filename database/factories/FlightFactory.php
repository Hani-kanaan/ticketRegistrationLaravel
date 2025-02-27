<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1000, 9999),
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'departure_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'arrival_time' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
        ];
    }
}

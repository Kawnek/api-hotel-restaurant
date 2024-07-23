<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = app(Faker::class);

        return [
            'number' => $faker->unique()->randomNumber(3),
            'size' => $faker->randomElement(['Small', 'Medium', 'Large']),
            'price' => $faker->randomNumber(5),
            'hotel_id' => rand(1, 10),
        ];
    }
}

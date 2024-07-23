<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class HotelFactory extends Factory
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
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
            'phone_alt' => $faker->optional()->phoneNumber,
            'locality' => $faker->city,
            'address' => $faker->streetAddress,
            'house_no' => $faker->randomNumber(3),
            'district' => $faker->state,
        ];
    }
}

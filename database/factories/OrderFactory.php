<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class OrderFactory extends Factory
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
            'number' => $faker->unique()->randomNumber(5),
            'name' => $faker->optional()->name,
            'phone' => $faker->optional()->phoneNumber,
            'user_id' => UserFactory::new()->create()->id,
            'dining_table_id' => rand(1, 25),
            'room_id' => rand(1, 10),
        ];
    }
}

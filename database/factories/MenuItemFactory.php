<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = app(Faker::class);
        $image_path = rand(1, 20) . '.jpg';
        // $image_path = 'image-' . rand(1, 10) . '.jpg';
        return [
            'name' => $faker->text(15),
            'image_path' => $image_path,
            'description' => $faker->text(20),
            'price' => $faker->randomFloat(2, 10, 100),
        ];
    }
}

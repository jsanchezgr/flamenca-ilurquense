<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    public function generateFullName(): string
    {
        return (rand(0, 1) == 1)
            ? fake()->firstNameFemale() . ' ' . fake()->lastName()
            : fake()->firstNameMale() . ' ' . fake()->lastName();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->generateFullName(),
            'nick' => fake()->userName(),
            'type' => fake()->randomElement(['v', 'g', 'k', 'e', 'p', 'd']),
            'birthdate' => fake()->dateTimeBetween('-70 years', '-14 years'),
            'birthplace' => fake()->city(),
            'image' => fake()->imageUrl(),
            'biography' => fake()->realText(1500),
        ];
    }
}

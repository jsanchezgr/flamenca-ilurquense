<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class EventFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'date' => fake()->dateTimeThisYear(),
            'slug' => fake()->slug(),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

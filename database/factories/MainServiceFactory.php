<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MainService>
 */
class MainServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'      => $this->faker->unique()->randomNumber(4),
            'name'      => $this->faker->name,
            'mm_name'      => $this->faker->name,
        ];
    }
}
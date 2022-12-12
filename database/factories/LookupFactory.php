<?php

namespace Database\Factories;

use App\Models\MainService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lookup>
 */
class LookupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type'          => $this->faker->name,
            'key'           => $this->faker->name,
            'value'         => $this->faker->name,
        ];
    }
}

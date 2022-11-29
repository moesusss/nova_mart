<?php

namespace Database\Factories;

use App\Models\MainService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'main_service_id' => $this->faker->randomElement(MainService::pluck('id')->toArray()),
            // 'main_service_id' => MainService::factory()->create()->id,
            'code'      => $this->faker->unique()->randomNumber(4),
            'name'      => $this->faker->name,
            'mm_name'      => $this->faker->name,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
            // 'main_service_id' => MainService::factory()->create()->id,
            'code'      => $this->faker->unique()->randomNumber(4),
            'name'      => $this->faker->name,
            'mm_name'      => $this->faker->name,
        ];
    }
}
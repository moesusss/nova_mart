<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sub_category_id' => $this->faker->randomElement(SubCategory::pluck('id')->toArray()),
            // 'main_service_id' => MainService::factory()->create()->id,
            'code'      => $this->faker->unique()->randomNumber(4),
            'name'      => $this->faker->name,
            'mm_name'      => $this->faker->name,
            'is_active'     => 1,
        ];
    }
}
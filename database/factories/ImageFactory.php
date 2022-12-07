<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'resourceable_type'      => 'Item',
            'resourceable_id'      => Item::all()->random()->id,
            'image_url'      => $this->faker->imageUrl($width = 640, $height = 480),
            'is_default'      => $this->faker->randomElement(array(true, false))
        ];
    }
}

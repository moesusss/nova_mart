<?php

namespace Database\Factories;

use App\Models\MainService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HubVendor>
 */
class HubVendorFactory extends Factory
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
            'email'      => $this->faker->unique()->safeEmail(),
            'name'      => $this->faker->name,
            'mobile'      => $this->faker->unique()->e164PhoneNumber,
            'address'      => $this->faker->address,
            'password'      => Hash::make('password'),
            'is_active'      => 1,
        ];
    }
}
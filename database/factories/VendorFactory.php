<?php

namespace Database\Factories;

use App\Models\HubVendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $hub_vendor = HubVendor::all()->random();
        return [
            'name'      => $this->faker->name,
            'mm_name'      => $this->faker->name,
            'email'      => $this->faker->unique()->safeEmail(),
            'username'      => $this->faker->unique()->userName(),
            'password'      => Hash::make('password'),

            'main_service_id' => $hub_vendor->main_service_id,
            'hub_vendor_id' => $hub_vendor->id,
            'address'      => $this->faker->address,
            'opening_time'      => time('H:i A'),
            'closing_time'      => time('H:i A'),
            'lat'      => $this->faker->latitude($min = -90, $max = 90),
            'lng'      => $this->faker->longitude($min = -180, $max = 180),
            'is_active'      => 1,
        ];
    }
}


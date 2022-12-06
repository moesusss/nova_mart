<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sub_category = SubCategory::all()->random();
        $item_type = $this->faker->randomElement(array('best_seller', 'best_deal'));
        $unit_type = $this->faker->randomElement(array('pc', 'kg'));
        $is_active = $this->faker->randomElement(array(true, false));
        $is_instock = $this->faker->randomElement(array(true, false));
        $is_package = $this->faker->randomElement(array(true, false));
        return [

            'name'      => $this->faker->name,
            'mm_name'      => $this->faker->name,
            'category_id' => $sub_category->category_id,
            'sub_category_id' => $sub_category->id,
            'vendor_id' => Vendor::all()->random()->id,
            // 'brand_id' => Brand::all()->random()->id,
            'sku'      => $this->faker->unique()->ean8(),
            'barcode'      => $this->faker->unique()->ean13(),
            // 'qty'      =>  $this->faker->numberBetween($min = 1, $max = 1000),
            'qty'      =>  $this->faker->randomDigitNotNull,
            'price'      =>  $this->faker->randomNumber(4),
            'weight'      =>  $this->faker->numberBetween($min = 0.1, $max = 20),
            'item_type'  => $item_type,
            'unit_type' => $unit_type,
            'is_active' => $is_active,
            'is_instock' => $is_instock,
            'is_package' => $is_package,
            'description'      =>  $this->faker->text,
        ];
    }
}

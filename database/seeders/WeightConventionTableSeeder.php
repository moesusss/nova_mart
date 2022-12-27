<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightConvention;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WeightConventionTableSeeder extends Seeder
{
    protected $data = [
        ['unit_type' => 'Ounces', 'rate' => 0.028, 'is_active' => true],
        ['unit_type' => 'Viss', 'rate' => 1.633, 'is_active' => true],
        ['unit_type' => 'Gram', 'rate' => 0.001, 'is_active' => true],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        foreach ($this->data as $row) {
            WeightConvention::create([
                'unit_type' => $row['unit_type'],
                'rate' => $row['rate'],
                'is_active' => $row['is_active']
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}

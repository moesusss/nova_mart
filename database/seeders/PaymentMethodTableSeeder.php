<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodTableSeeder extends Seeder
{
    protected $data = [
        ['name' => 'Cash', 'type' => 'COD', 'is_active' => true],
        ['name' => 'KPay', 'type' => 'KPay', 'is_active' => false],
        ['name' => 'AYAPay', 'type' => 'AYAPay', 'is_active' => false],
        ['name' => 'CBPay', 'type' => 'CBPay', 'is_active' => false],
        ['name' => 'WavePay', 'type' => 'WavePay', 'is_active' => false],
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
            PaymentMethod::create([
                'name' => $row['name'],
                'type' => $row['type'],
                'is_active' => $row['is_active']
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}

<?php

namespace Database\Seeders;

use App\Models\HubVendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HubVendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HubVendor::factory()
            ->count(5)
            ->create();
    }
}

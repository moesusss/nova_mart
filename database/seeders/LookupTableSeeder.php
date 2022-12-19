<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LookupTableSeeder extends Seeder
{
    protected $data = [
        ['type' => 'item_type', 'key' => 'best_sellers','value'=>'Best Sellers'  ],
        ['type' => 'item_type', 'key' => 'special_deals','value'=>'Special Deals'  ],
        ['type' => 'unit_type', 'key' => 'pc','value'=>'PC'  ],
        ['type' => 'unit_type', 'key' => 'kg','value'=>'KG'  ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $row) {
            Lookup::factory()->create([
                 'type'     => $row['type'],
                 'key'      => $row['key'],
                 'value'    => $row['value'],
             ]);
         }
    }
}

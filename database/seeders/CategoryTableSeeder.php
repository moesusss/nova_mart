<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MainService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    protected $data = [
        ['name' => 'Meat', 'mm_name' => 'Meat',  ],
        ['name' => 'Alcohol and Drinks', 'mm_name' => 'Alcohol and Drinks',  ],
        ['name' => 'Beauty', 'mm_name' => 'Beauty',  ],
        ['name' => 'Electronic', 'mm_name' => 'Electronic',  ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $row) {
           Category::factory()->create([
                'name'  => $row['name'],
                'mm_name'  => $row['mm_name'],
            ]);
        }
        
      
    }
}

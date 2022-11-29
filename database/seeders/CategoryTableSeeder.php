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
       Category::factory()
            ->count(10)
            ->create();
    }
}

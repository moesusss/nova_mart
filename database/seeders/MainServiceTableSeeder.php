<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MainService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainServiceTableSeeder extends Seeder
{
    // protected $data = [
    //     ['name' => 'Grocery', 'mm_name' => 'ကုန္စံုဆိုင္မ်ား',  ]
    // ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        MainService::factory()->create([
             'name'  => 'Grocery',
             'mm_name'  => 'ကုန္စံုဆိုင္မ်ား',
        ]);

        // MainService::factory()
        //             ->create([
        //                 'name'  => 'Grocery',
        //                 'mm_name'  => 'ကုန္စံုဆိုင္မ်ား',
        //             ])
        //             ->has(Category::factory()->count(4));
        
    }
}

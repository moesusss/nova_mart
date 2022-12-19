<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleTableSeeder::class,
            PermissionTableSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            CreateAdminUserSeeder::class,
            PaymentMethodTableSeeder::class,
            MainServiceTableSeeder::class,
            CategoryTableSeeder::class,
            SubCategoryTableSeeder::class,
            BrandTableSeeder::class,
            HubVendorTableSeeder::class,
            VendorTableSeeder::class,
            ItemTableSeeder::class,
            ImageTableSeeder::class,
            LookupTableSeeder::class,
        ]);
    }
}

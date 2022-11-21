<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'main-service-list',
           'main-service-create',
           'main-service-edit',
           'main-service-delete',
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
           'sub-category-list',
           'sub-category-create',
           'sub-category-edit',
           'sub-category-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission,'guard_name' => 'web']);
        }
    }
}

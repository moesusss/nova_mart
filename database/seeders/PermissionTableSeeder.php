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
           'brand-list',
           'brand-create',
           'brand-edit',
           'brand-delete',
           'hub-vendor-list',
           'hub-vendor-create',
           'hub-vendor-edit',
           'hub-vendor-delete',
           'vendor-list',
           'vendor-create',
           'vendor-edit',
           'vendor-delete',
           'customer-list',
           'item-list',
           'item-create',
           'item-edit',
           'item-delete',
           'customer-edit',
           'customer-delete',
           'order-list',
           'order-edit',
           'order-delete',
           'stock-create',
           'stock-list',
           'delivery-fee-list',
           'delivery-fee-create',
           'delivery-fee-edit',
           'delivery-fee-delete',
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}

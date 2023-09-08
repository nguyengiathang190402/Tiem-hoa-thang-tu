<?php
  
namespace Database\Seeders;
  
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
            'user-menu',
            'user-list',
            'user-create',
            'user-edit',
            'user-show',
            'user-delete',

            'role-menu',
            'role-list',
            'role-create',
            'role-edit',
            'role-show',
            'role-delete',

            'permission-menu',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-show',
            'permission-delete',

            'product-menu',
            'product-list',
            'product-create',
            'product-edit',
            'product-show',
            'product-delete',


            'attribute-menu',
            'attribute-list',
            'attribute-create',
            'attribute-edit',
            'attribute-show',
            'attribute-delete',
            'attribute-manage',


            'value-menu',
            'value-list',
            'value-create',
            'value-edit',
            'value-show',
            'value-delete',


            'category-menu',
            'category-list',
            'category-create',
            'category-edit',
            'category-show',
            'category-delete',


            'tag-menu',
            'tag-list',
            'tag-create',
            'tag-edit',
            'tag-show',
            'tag-delete',

        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
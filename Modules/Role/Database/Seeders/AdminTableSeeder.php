<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        //create admin user 
        $user = User::create([
            'name' => 'Admin',
            'email' => 'Reachus@certifytechnologies.com',
            'password' => Hash::make('Certify@2023@2030'),
        ]);
        //create super admin role 
        $role = Role::create(['name' => config('core.super-admin')]);
        $user->assignRole(config('core.super-admin'));
       
        //create permision
        Permission::create(['name' => 'admin.role.index']);
        Permission::create(['name' => 'admin.role.create']);
        Permission::create(['name' => 'admin.role.edit']);
        Permission::create(['name' => 'admin.role.delete']);
        Permission::create(['name' => 'admin.role.mass_delete']);
       
        Permission::create(['name' => 'admin.permission.index']);
        Permission::create(['name' => 'admin.permission.create']);
        Permission::create(['name' => 'admin.permission.edit']);
        Permission::create(['name' => 'admin.permission.delete']);
        Permission::create(['name' => 'admin.permission.mass_delete']);
       

        //assign permission
        $role->givePermissionTo('admin.role.index');
        $role->givePermissionTo('admin.role.create');
        $role->givePermissionTo('admin.role.edit');
        $role->givePermissionTo('admin.role.delete');
        $role->givePermissionTo('admin.role.mass_delete');
        
        $role->givePermissionTo('admin.permission.index');
        $role->givePermissionTo('admin.permission.create');
        $role->givePermissionTo('admin.permission.edit');
        $role->givePermissionTo('admin.permission.delete');
        $role->givePermissionTo('admin.permission.mass_delete');
    }
}

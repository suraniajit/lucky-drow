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
        $permissions =[
            'admin.role.index',
            'admin.role.create',
            'admin.role.edit',
            'admin.role.delete',
            'admin.role.mass_delete',
            'admin.permission.index',
            'admin.permission.create',
            'admin.permission.edit',
            'admin.permission.delete',
            'admin.permission.mass_delete',
            'admin.user.index',
            'admin.role.permission_change',
            'admin.symbole.index',
            'admin.show.index',
            'admin.home.index',
            'admin.show.create',
            'admin.show.edit',
            'admin.show.delete',
            'admin.setting.index',
            'admin.balance.index',
            'admin.show.booking',
            'admin.show.result',
            'admin.show.history',
            'admin.booking.index',
            'admin.result.index',
            'admin.result.history',
            'admin.setting.update',
            'admin.user.create',
            'admin.user.edit',
            'admin.user.delete',
          
        ];
        //create admin user 
        $user = User::create([
            'name' => 'Admin',
            'email' => 'Admin@server.com',
            'password' => Hash::make('Server@123'),
            'status'=>1,
        ]);
        //create super admin role 
        $role = Role::create(['name' => config('core.super-admin')]);
        $user->assignRole(config('core.super-admin'));
       
        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
            $role->givePermissionTo($permission);
        }
    }
}

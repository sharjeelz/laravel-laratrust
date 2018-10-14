<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
        $role = \App\Role::create([
            'name' => 'Owner',
            'display_name' => 'Owner',
            'description' => 'Owner of this System',
            'type'=>-1
        ]);

        $permission = \App\Permission::create([
            'name' => 'root',
            'display_name' => 'Root Access',
            'description' => 'Root',
            'type'=>-1

        ]);

        $user=DB::table('users')->insertGetId([
            'name' => 'Super Admin',
            'email' =>'admin@admin.com',
            'password' => bcrypt('123456'),
            'pic'=>'avatars/noimage.png'

        ]);

        $user_=App\User::find($user);

        $user_->attachRole($role);
        $user_->attachPermission($permission);


    }
}

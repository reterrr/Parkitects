<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = new User();
        $superAdmin->name = 'Super Admin';
        $superAdmin->email = 'superadmin@gmail.com';
        $superAdmin->password  = Hash::make('123');
        $superAdmin->save();
        $superAdmin->roles()->attach(Role::query()->find(1));

        //TODO admin and user can be deleted later
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password  = Hash::make('123');
        $admin->save();
        $admin->roles()->attach(Role::query()->find(2));

        $user = new User();
        $user->name = 'user';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('123');
        $user->save();
        $user->roles()->attach(Role::query()->find(3));
    }
}

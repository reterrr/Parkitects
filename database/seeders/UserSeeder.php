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
        $superAdmin->email = 'sharonovnikola1@gmail.com';
        $superAdmin->password  = Hash::make('123');
        $superAdmin->save();
        $superAdmin->roles()->attach(Role::query()->find(1));

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password  = Hash::make('123');
        $admin->save();
        $admin->roles()->attach(Role::query()->find(2));
    }
}

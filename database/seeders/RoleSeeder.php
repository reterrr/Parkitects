<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = new Role();
        $superAdmin->name = 'Super administrator';
        $superAdmin->slug = 'super-admin';
        $superAdmin->save();
        $superAdmin->permissions()->attach(Permission::query()->get());

        $admin = new Role();
        $admin->name = 'Administrator';
        $admin->slug = 'admin';
        $admin->save();
        $admin->permissions()->attach(Permission::query()->whereNotIn('slug', ['parkings.create'])->get());

        $user = new Role();
        $user->name = 'User';
        $user->slug = 'user';
        $user->save();
    }
}

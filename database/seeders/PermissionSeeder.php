<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createRole = new Permission();
        $createRole->name = 'add role';
        $createRole->slug = 'roles.create';
        $createRole->save();

        $deleteRole = new Permission();
        $deleteRole->name = 'delete role';
        $deleteRole->slug = 'roles.delete';
        $deleteRole->save();

        $updateRole = new Permission();
        $updateRole->name = 'update role';
        $updateRole->slug = 'roles.update';
        $updateRole->save();

        $givePermission = new Permission();
        $givePermission->name = 'give permission';
        $givePermission->slug = 'permissions.give';
        $givePermission->save();

        $deletePermission = new Permission();
        $deletePermission->name = 'delete permission';
        $deletePermission->slug = 'permissions.delete';
        $deletePermission->save();

        $detachPermission = new Permission();
        $detachPermission->name = 'detach permission';
        $detachPermission->slug = 'permissions.detach';
        $detachPermission->save();

        $addParking = new Permission();
        $addParking->name = 'add parking';
        $addParking->slug = 'parkings.create';
        $addParking->save();

        $deleteUser = new Permission();
        $deleteUser->name = 'delete user';
        $deleteUser->slug = 'users.delete';
        $deleteUser->save();

        $getUser = new Permission();
        $getUser->name = 'get user';
        $getUser->slug = 'users.get';
        $getUser->save();
    }
}

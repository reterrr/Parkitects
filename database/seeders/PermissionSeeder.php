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
        $createRole->name = 'give role';
        $createRole->slug = 'roles.give';
        $createRole->save();

        $findRole = new Permission();
        $findRole->name = 'find role';
        $findRole->slug = 'roles.find';
        $findRole->save();

        $givePermission = new Permission();
        $givePermission->name = 'give permission';
        $givePermission->slug = 'permissions.give';
        $givePermission->save();

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
        $getUser->name = 'get users';
        $getUser->slug = 'users.get';
        $getUser->save();

        $findUser = new Permission();
        $findUser->name = 'find user';
        $findUser->slug = 'users.find';
        $findUser->save();
    }
}

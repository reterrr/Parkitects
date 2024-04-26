<?php

namespace App;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRolesAndPermissions
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string... $roles): bool
    {
        return $this->roles()->whereIn('slug', $roles)->exists();
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('slug', $permission)->exists();
    }

    public function hasPermissionThroughRole(string $permission): bool
    {
        return $this->roles->contains(function (Role $role) use($permission) {
            return $role->hasPermission($permission);
        });
    }

    public function hasPermissionTo(string $permission): bool
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function getPermissions(array $permissions): Collection|array
    {
        return $this->permissions()->whereIn('slug', $permissions)->get();
    }

    public function givePermissions(string ...$permissions): self
    {
        $permissions = $this->getPermissions($permissions);

        if ($permissions == null)
            return $this;

        $this->permissions()->attach($permissions);

        return $this;
    }

    public function deletePermissions(string ...$permissions): self
    {
        $permissions = $this->getPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    public function refreshPermissions(string ...$permissions): self
    {
        $this->permissions()->detach();

        return $this->givePermissions(...$permissions);
    }
}

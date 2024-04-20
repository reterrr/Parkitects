<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

trait HasPermissions
{
    public function hasPermission(string $permission): bool
    {
        return $this->permissions->contains('slug', $permission);
    }

    public function getPermissions(array $permissions): Collection|array
    {
        return $this->permissions()->whereIn('slug', $permissions)->get();
    }

    public function givePermissions(array $permissions): self
    {
        if ($permissions == null)
            return $this;

        $this->permissions()->attach(Permission::query()->whereIn('slug', $permissions)->get());

        return $this;
    }

    public function deletePermissions(array $permissions): self
    {
        $permissions = $this->getPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    public function modifyPermissions(array $permissions): self
    {
        $this->permissions()->detach();
        $this->givePermissions($permissions);

        return $this;
    }
}

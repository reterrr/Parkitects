<?php

namespace App\Repositiories\User;

use App\Exceptions\RegisterFailedException;
use App\Exceptions\SuperAdminDelete;
use App\Models\Role;
use App\Models\User;
use App\RoleType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository implements UserRepositoryInterface
{
    public function list()
    {
        return QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::callback('roles', function (Builder $query, array $value): Builder {
                    return $query->join('role_user', 'id', '=', 'user_id')
                        ->whereIn('roles_id', $value);
                }),
                AllowedFilter::callback('search', function (Builder $query, string $value) : Builder {
                    return $query->where('name', 'like', "%$value%")
                        ->orWhere('email', 'like', "%$value%");
                })
            ]);
    }

    public function update(int $id, array $data)
    {
        User::query()->where('id', $id)->update($data);
    }

    public function delete(int $id): void
    {
        $user = User::query()->where('id', $id)->first();

        if ($user->hasRole('super-admin'))
            throw new SuperAdminDelete();

        $user->delete();
    }

    public function find(int $id)
    {
        return User::query()->where('id', $id)->first();
    }

    public function create(array $data)
    {
        if (User::query()->where('email', $data['email'])->exists())
            throw new RegisterFailedException();

        $trashed = User::onlyTrashed()->where('email', $data['email'])->first();

        if ($trashed != null) {
            $trashed->restore();

            return;
        }

        $user = User::query()->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);

        $user->roles()->attach(Role::query()->where('slug', RoleType::USER->value)->first());
    }
}

<?php

namespace App\Models;

use App\RoleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes, HasPermissions;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    protected $fillable = [
      'name',
      'slug',
      'permissions'
    ];

    protected $hidden = [
      'slug',
      'permissions'
    ];

    protected $casts = [
        'slug' => RoleType::class
    ];

    public function priority()
    {
        return $this->slug->rolePriority();
    }
}

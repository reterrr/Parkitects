<?php

namespace App;

use App\Attributes\RolePriority;

enum RoleType: string
{
    use AttributableEnum;

    #[RolePriority(1)]
    case SUPER_ADMIN = 'super-admin';

    #[RolePriority(2)]
    case ADMIN = 'admin';

    #[RolePriority(3)]
    case USER = 'user';
}

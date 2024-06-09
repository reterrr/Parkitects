<?php

namespace App\Providers;

use App\Repositiories\Parking\ParkingRepository;
use App\Repositiories\Parking\ParkingRepositoryInterface;
use App\Repositiories\ParkingPlace\ParkingPlaceRepository;
use App\Repositiories\ParkingPlace\ParkingPlaceRepositoryInterface;
use App\Repositiories\Permission\PermissionRepository;
use App\Repositiories\Permission\PermissionRepositoryInterface;
use App\Repositiories\Reservation\ReservationRepository;
use App\Repositiories\Reservation\ReservationRepositoryInterface;
use App\Repositiories\Role\RoleRepository;
use App\Repositiories\Role\RoleRepositoryInterface;
use App\Repositiories\User\UserRepository;
use App\Repositiories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(ParkingPlaceRepositoryInterface::class, ParkingPlaceRepository::class);
        $this->app->bind(ParkingRepositoryInterface::class, ParkingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}

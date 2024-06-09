<?php

namespace App\Providers;

use App\Exceptions\ResourceNotFoundException;
use App\Repositiories\Parking\ParkingRepositoryInterface;
use App\Repositiories\ParkingPlace\ParkingPlaceRepositoryInterface;
use App\Repositiories\Reservation\ReservationRepositoryInterface;
use App\Repositiories\Role\RoleRepositoryInterface;
use App\Repositiories\User\UserRepositoryInterface;
use App\RouteLoader;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $userRepository = app(UserRepositoryInterface::class);
        $reservationRepository = app(ReservationRepositoryInterface::class);
        $parkingPlaceRepository = app(ParkingPlaceRepositoryInterface::class);
        $roleRepository = app(RoleRepositoryInterface::class);
        $parkingRepository = app(ParkingRepositoryInterface::class);

        $this->routes(function () use ($userRepository, $reservationRepository, $parkingPlaceRepository, $roleRepository, $parkingRepository) {
            $this->registerRoutes();
            $this->registerBindings($userRepository, $reservationRepository, $parkingPlaceRepository, $roleRepository, $parkingRepository);

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    private function registerRoutes(): void
    {
        $loader = new RouteLoader;

        $loader->register();
    }

    private function registerBindings(UserRepositoryInterface $userRepository, ReservationRepositoryInterface $reservationRepository, ParkingPlaceRepositoryInterface $parkingPlaceRepository, RoleRepositoryInterface $roleRepository, ParkingRepositoryInterface $parkingRepository): void
    {
        Route::bind('user', fn ($id) => $userRepository->find($id) ?? throw new ResourceNotFoundException(message: 'User not found'));
        Route::bind('reservation', fn ($id) => $reservationRepository->find($id) ?? throw new ResourceNotFoundException);
        Route::bind('parkingPlace', fn ($id) => $parkingPlaceRepository->find($id) ?? throw new ResourceNotFoundException);
        Route::bind('role', fn ($id) => $roleRepository->find($id) ?? throw new ResourceNotFoundException);
        Route::bind('parking', fn ($id) => $parkingRepository->find($id) ?? throw new ResourceNotFoundException);
    }
}

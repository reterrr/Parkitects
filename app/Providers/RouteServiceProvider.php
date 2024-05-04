<?php

namespace App\Providers;

use App\Models\ParkingPlace;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\User;
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

        $this->routes(function () {
            $this->registerRoutes();
            $this->registerBindings();

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

    private function registerBindings(): void
    {
        Route::bind('user', fn ($id) => User::query()->find($id) ?? $this->resourceNotFoundException($id));
        Route::bind('reservation', fn ($id) => Reservation::query()->find($id) ?? $this->resourceNotFoundException($id));
        Route::bind('parkingPlace', fn ($id) => ParkingPlace::query()->find($id) ?? $this->resourceNotFoundException($id));
        Route::bind('role', fn ($id) => Role::query()->find($id) ?? $this->resourceNotFound($id));
    }
}

<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    public const HOME = '/home';
    private array $module = ['Modules/','/Routes/routes.php'];
    protected $namespace = '';

    public function boot()
    {
        $this->configureRateLimiting();

    }

    public function map(Router $router)
    {
        $this->registerAuthRoutes();
        $this->registerCarRoutes();

    }

    private function registerAuthRoutes(){
        Route::prefix('api')
                ->middleware('api')
                ->group(base_path($this->module[0].'Authentication'.$this->module[1]));
    }

    private function registerCarRoutes(){
        Route::prefix('api')
                ->middleware('api')
                ->group(base_path($this->module[0].'Car'.$this->module[1]));
    }


    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}

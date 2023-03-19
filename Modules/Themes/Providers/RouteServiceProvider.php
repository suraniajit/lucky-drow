<?php

namespace Modules\Themes\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
   
    protected $backendModuleNamespace = 'Modules\Themes\Http\Controllers\Backend';
    protected $frantendModuleNamespace = 'Modules\Themes\Http\Controllers\Frantend';
    protected $apiModuleNamespace = 'Modules\Themes\Http\Controllers\Api';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebBackendRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebBackendRoutes()
    {
        Route::prefix('backend')
            ->middleware('web')
            ->namespace($this->backendModuleNamespace)
            ->group(__DIR__ . '/../Routes/backend.php');
    }
    
    protected function mapWebRoutes()
    {
        Route::prefix('')
            ->middleware('web')
            ->namespace($this->frantendModuleNamespace)
            ->group(__DIR__ . '/../Routes/frantend.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->apiModuleNamespace)
            ->group(__DIR__ . '/../Routes/api.php');
    }
}

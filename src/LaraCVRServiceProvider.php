<?php

namespace Lhartmann\LaraCVR;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaraCVRServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package has views
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'LaraCVR');

        // use this if your package has lang files
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'LaraCVR');

        // use this if your package has routes
        $this->setupRoutes($this->app->router);

        // use this if your package needs a config file
        $this->publishes([
                 __DIR__.'/config/config.php' => config_path('laraCVR.php'),
        ]);

        // use the vendor configuration file as fallback
        // $this->mergeConfigFrom(
        //     __DIR__.'/config/config.php', 'LaraCVR'
        // );
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Lhartmann\LaraCVR\Http\Controllers'], function ($router) {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLaraCVR();

        // use this if your package has a config file
        config([
                 'config/laraCVR.php',
        ]);
    }

    private function registerLaraCVR()
    {
        $this->app->bind('LaraCVR', function ($app) {
            return new LaraCVR($app);
        });
        /*
        $this->app->singleton(LaraCVR::class, function ($app) {
            return $app->make(BroadcastManager::class)->connection();
        });*/
    }
}

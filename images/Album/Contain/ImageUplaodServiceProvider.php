<?php

namespace Images\Album;

use Illuminate\Support\ServiceProvider;

class ImageUplaodServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

          require __DIR__.'/Http/routes.php';
        //   if (! $this->app->routesAreCached()) {
        //     require __DIR__.'/Contain/routes.php';
        //   }
        //
         $this->loadViewsFrom(__DIR__.'/../Http/views', 'Album');
        $this->publishes([ __DIR__ . '/database/migratioins/2016_02_17_130122_image.php' => base_path('/database/migratioins/2016_02_17_130122_image.php')]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //require __DIR__.'/htttproutes.php';        //
        $this->app->bind('Album',function($app)
          {
            return new Album;
          });
    }
}

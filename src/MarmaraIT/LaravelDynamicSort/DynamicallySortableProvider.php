<?php

namespace MarmaraIT\LaravelDynamicSort;

use Illuminate\Support\ServiceProvider;

class DynamicallySortableProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'laraveldynamicsort');
        $this->publishes([
            __DIR__.'/assets' => resource_path('/assets/js/'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

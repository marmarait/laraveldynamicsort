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

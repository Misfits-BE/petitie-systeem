<?php

namespace Misfits\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Shared view composers
        view()->composer('*', \Misfits\Http\ViewComposers\GlobalComposer::class);
        view()->composer('layouts.app', \Misfits\Http\ViewComposers\AppLayoutComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

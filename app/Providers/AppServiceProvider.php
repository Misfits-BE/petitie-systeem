<?php

namespace Misfits\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Application service provider 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Shared view composers
        view()->composer('*', \Misfits\Http\ViewComposers\GlobalComposer::class);
        view()->composer('layouts.app', \Misfits\Http\ViewComposers\AppLayoutComposer::class);
        view()->composer('shared.helpdesk.navigation', \Misfits\Http\ViewComposers\HelpdeskCategoryComposer::class);
    }
}

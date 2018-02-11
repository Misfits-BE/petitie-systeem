<?php

namespace Misfits\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class HelperServiceProvider
 * ---
 * Registration for the helper methods;
 *
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Providers
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/Routing.php';
    }
}

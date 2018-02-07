<?php

use Illuminate\Support\Facades\Route;

/**
 * Helper that determine if the given route is active or not
 *
 * @param  string $route    The name for the route
 * @param  string $class    The active css class | Default = active
 * @return string
 */
function isActive(string $route, string $class = 'active'): string
{
    return request()->is($route)
        ? $class
        : '';
}
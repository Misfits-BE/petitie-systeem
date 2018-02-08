<?php

namespace Misfits\Http\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\View\View;

/**
 * Class AppLayoutComposer
 * ---
 * The view composer file that applies to the view. ('layouts.app')
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     App\Http\ViewComposers
 */
class AppLayoutComposer
{
    /** @var \Illuminate\Contracts\Auth\Guard $auth */
    protected $auth;

    /**
     * Create a new app layout composer
     *
     * @param  Guard $auth  The authentication guard.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind the data to the view.
     *
     * @param  View  $view The view contract form laravel.
     * @return void
     */
    public function compose(View $view): void
    {
        if ($this->auth->check()) {
            $view->with('helpdeskUrl', $this->auth->user()->hasRole('admin')
                ? route('admin.helpdesk.index') // TRUE
                : route('helpdesk.index')       // FALSE
            );
        }
    }
}
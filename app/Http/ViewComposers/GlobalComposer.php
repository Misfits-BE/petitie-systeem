<?php

namespace Misfits\Http\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\View\View;

/**
 * Class GlobalComposer
 * ---
 * The view composer file that applies to all views.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     App\Http\ViewComposers
 */
class GlobalComposer
{
    /** @var \Illuminate\Contracts\Auth\Guard $auth  */
    protected $auth;

    /**
     * Create a new global layout composer.
     *
     * @param  Guard $auth  The authentication guard.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view  The view contract from laravel.
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('user', $this->auth->user());
    }
}

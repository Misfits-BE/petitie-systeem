<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;

/**
 * Controller for application policy pages.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and contributors
 * @package     \Misfits\Http\Controllers\Frontend
 */
class PolicyController extends Controller
{
    /**
     * The policy page for the disclaimer.
     *
     * @return \Illuminate\View\View
     */
    public function disclaimer(): View
    {
        return view('frontend.policies.disclaimer');
    }
}

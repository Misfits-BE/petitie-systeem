<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View; 
use Misfits\Http\Controllers\Controller;

/**
 * Class: ContactController
 * ----- 
 * Controller for the contact module. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     \Misfits\Http\Controllers\Frontend
 */
class ContactController extends Controller
{
    /**
     * Get the contact page for the guest user.
     *
     * @todo implementatie phpunit tests
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        if (auth()->check()) { // User is authencated so they need more contact options (sidenav)
            return view('frontend.contact.authenticated-user'); 
        } 

        return view('frontend.contact.guest-user'); 
    }

    /**
     * Send the contact form to the contact person. 
     * 
     * @todo write phpunit test 
     * @todo register route
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(): RedirectResponse
    {
        return redirect()->route('contact.index');
    }
}

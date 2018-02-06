<?php

namespace Misfits\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\UserRepository;

/**
 * Controller for the user his account settings 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \Misfits\Http\Controllers\Auth
 */
class AccountSettingsController extends Controller
{
    /** @var \Misfits\Repositories\UserRepository $user */
    private $user;

    /**
     * AccountSettingsController Constructor
     * 
     * @param  UserRepository $user     Database ORM wrapper.
     * @return void 
     */
    public function __construct(UserRepository $user) 
    {
        $this->middleware('auth');
    }

    /**
     * Account settings view. 
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view('auth.settings');
    }

    /**
     * @todo docblock
     */
    public function updateInformation(): RedirectResonse
    {
        //
    }

    /**
     * @todo docblock
     */
    public function updatePassword(): RedirectResponse 
    {
        //
    }
}

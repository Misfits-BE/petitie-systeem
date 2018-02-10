<?php

namespace Misfits\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\UserRepository;
use Misfits\Requests\Auth\InformationValidator;
use Misfits\Requests\Auth\PasswordValidator;

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
     * Update the account information in the datebase.
     *
     * @param. InformationValidator $input  The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInformation(InformationValidator $input): RedirectResonse
    {
        if ($this->user->update($input->all(), auth()->user()->id)) {
            flash('Your profile information has been updated.')->success()->important();
        }

        return redirect()->route('account.settings');
    }

    /**
     * Update the password settings for the user in the database.
     *
     * @todo Build up the validator
     *
     * @param. PasswordValidator $input     The user given input (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordValidator $input): RedirectResponse
    {
        if ($this->user->update($input->all(), auth()->user()->id)) {
            flash('Your profile password has been updated.')->success()->important();
        }

        return redirect()->route('account.settings');
    }
}

<?php

namespace Misfits\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\UserRepository;
use Misfits\Repositories\CountryRepository;
use Misfits\Http\Requests\Auth\InformationValidator;
use Misfits\Http\Requests\Auth\PasswordValidator;

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

    /** @var \Misfits\Repositories\CountryRepository $countries */
    private $countries; 

    /**
     * AccountSettingsController Constructor
     *
     * @param  UserRepository       $user       Database ORM wrapper.
     * @param  CountryRepository    $countries  Database ORM wrapper.
     * @return void
     */
    public function __construct(UserRepository $user, CountryRepository $countries)
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->user      = $user;
        $this->countries = $countries;
    }

    /**
     * Account settings view.
     *
     * @todo Implement phpunit tests
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $user = auth()->user();

        return view('auth.settings', [
            'countries' => $this->countries->all(['id', 'name']),
            'login'     => $this->user->findOrFail($user->id, ['name', 'email', 'country_id'])
        ]);
    }

    /**
     * Update the account information in the datebase.
     *
     * @todo Implement phpunit tests
     * 
     * @param. InformationValidator $input  The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInformation(InformationValidator $input): RedirectResponse
    {
        if ($this->user->update($input->except('_token', '_method'), auth()->user()->id)) {
            flash('Your profile information has been updated.')->success()->important();
        }

        return redirect()->route('account.settings', ['type' => 'informatie']);
    }

    /**
     * Update the password settings for the user in the database.
     *
     * @todo Implement phpunit tests
     *
     * @param. PasswordValidator $input     The user given input (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordValidator $input): RedirectResponse
    {
        if ($this->user->update(['password' => bcrypt($input->password)], auth()->user()->id)) {
            flash('Your profile password has been updated.')->success()->important();
        }

        return redirect()->route('account.settings', ['type' => 'security']);
    }
}

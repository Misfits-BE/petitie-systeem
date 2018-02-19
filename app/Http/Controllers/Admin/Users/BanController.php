<?php

namespace Misfits\Http\Controllers\Admin\Users;

use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Admin\Ban\BanValidator;
use Misfits\Repositories\UserRepository;
use Misfits\Repositories\BanRepository;

/**
 * Class BanController
 * ---
 * Controller for banning and unbanning of users in the system.
 *
 * @todo Implementatie tests for the forbid-banned-user middleware
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contibutors
 * @package     Misfits\Http\Controllers\Admin\Users
 */
class BanController extends Controller
{
    /** @var \Misfits\Repositories\UserRepository $users */
    private $users;

    /** @var \Misfits\Repositories\BanRepository $bans */
    private $bans;

    /**
     * BanController constructor.
     *
     * @todo Implmentatie Laravel authorization gate.
     *
     * @param  UserRepository $users    Abstraction layer between controller, logic, database
     * @param  BanRepository  $bans     Repository for all the ban/unban logic in the application.
     * @return void
     */
    public function __construct(UserRepository $users, BanRepository $bans)
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);

        $this->users = $users;
        $this->bans  = $bans;
    }

    /**
     * Creation view for the user ban.
     *
     * @todo Disable resizing textarea
     * 
     * @param  int $user    The unique identifier from the user in the database storage.
     * @return \Illuminate\View\View
     */
    public function create(int $user): View
    {
        // variable $dbUser is used becasue the variabe,
        // $user is reserved for the authenticated user.

        return view('admin.ban.create', ['dbUser' => $this->users->findOrFail($user)]);
    }

    /**
     * Create the user ban in the storage.
     *
     * @todo Implement test ban success
     * 
     * @param  BanValidator $input   The given uer input (Validated).
     * @param  int          $user    The unique identifier from the user in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BanValidator $input, int $user): RedirectResponse
    {
        $user = $this->users->findOrFail($user);

        if (Gate::allows('ban-user', $user)) { // The user is not the same user then the authenticated user
            // TODO: Fill in the ->lock() function. (notify logic)
            if ($this->bans->lock($user, $input->reason)) { // The user is notified and blocked. 
                $this->logActivity($user, auth()->user()->name . ' has banned a user in the application');
                flash($user->name . ' has been banned in the system.')->important()->success();
            }
        } else { // User is the same user then the authenticated user. And can't ban himself
            flash('Info: We could not perform the ban in the application.')->important()->info();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete a user ban out of the system.
     *
     * @todo Implement test revoke ban success
     * 
     * @param  int $user    The unique identifier from the user in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->users->findOrFail($user);

        if (Gate::allows('revoke-ban-user', $user)) {
            $this->bans->unlock($user); // TODO: implementatie notify logic.
            $this->logActivity($user, auth()->user()->name . ' has revoked the ban from ' . $user->name);

            flash($user->name . ' his ban has been revoked in the system.')->success()->important();
        } else { // user is the same user then the authenticated user. and can't ban himself
            flash('Info: we could not revoke the ban in the application.')->important()->info();
        }

        return redirect()->route('admin.users.index');
    }
}

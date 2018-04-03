<?php

namespace Misfits\Http\Controllers\Admin\Users;

use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Admin\Users\CreateValidator;
use Misfits\Repositories\RoleRepository;
use Misfits\Repositories\UserRepository;
use Misfits\Notifications\NewUser;

/**
 * Class IndexController
 * ---
 * Controller for user management in the system.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Admin\Users
 */
class IndexController extends Controller
{
    /** @var \Misfits\Repositories\UserRepository $users */
    private $users;

    /** @var \Misfits\Repositories\RoleRepository $roles */
    private $roles;

    /**
     * IndexController constructor.
     *
     * @param  UserRepository $users    Abstraction layer between controller, logic, database.
     * @param  RoleRepository $roles    Abstraction layer between controller, logic, database.
     * @return void
     */
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->middleware(['role:admin'])->except(['destroy']);

        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Get the index controller for the user management.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.users.index', ['users' => $this->users->getUsers(15)]);
    }

    /**
     * Create view for a new user in the system.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.users.create', ['roles' => $this->roles->all(['name'])]);
    }

    /**
     * Store the new user in the database storage
     *
     * @todo build up phpunit tests (no auth, auth, blocked user, success, validation errors)
     *
     * @param  CreateValidator $input   The user given input. (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        $password = str_random(16);
        $input = $input->merge(['password' => $password]);

        if ($user = $this->users->create($input->all())) {
            $user->assignRole($input->role);
            $user->notify((new NewUser($user, $password))->delay(now()->addMinute(1)));

            $this->logActivity($user, "Has created a login for {$user->name}");
            flash("Has created a login for {$user->name} in the application.")->success()->important();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete a user out off the system.
     * 
     * @param  int $user    The unique identifier in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->users->findOrFail($user);

        if (Gate::allows('delete', $user) && $user->delete()) { //! Returns true when user is deleted and authorized to perform delete
            if (auth()->user()->hasRole('admin')) { //! User = Admin so needs to be logged
                $this->logActivity($user, "Has removed {$user->name} in the application");
            }

            flash($user->name . ' is deleted in the application.')->success()->important();
        }

        return redirect()->route('admin.users.index');
    }
}

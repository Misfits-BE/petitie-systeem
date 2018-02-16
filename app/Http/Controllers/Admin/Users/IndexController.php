<?php

namespace Misfits\Http\Controllers\Admin\Users;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Admin\Users\CreateValidator;
use Misfits\Repositories\RoleRepository;
use Misfits\Repositories\UserRepository;

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
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);

        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Get the index controller for the user management.
     *
     * @todo build up phpunit tests
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => $this->users->getUsers(15)
        ]);
    }

    /**
     * Create view for a new user in the system.
     *
     * @todo register route
     * @todo build up phpunit tests
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => $this->roles->all(['name'])
        ]);
    }

    /**
     * Store the new user in the database storage
     *
     * @todo register route
     * @todo build up phpunit tests
     *
     * @param  CreateValidator $input   The user given input. (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        if ($user = $this->users->createUser($input)) {
            $this->logActivity($user, "Has created a login for {$user->name}");
            flash("Has created a login for {$user->name} in the application.")->success()->important();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete a user out off the system.
     *
     * @todo register route
     * @todo build up phpunit tests
     *
     * @param  int $user    The unique identifier in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->users->findOrFail($user);

        if ($user->delete()) {
            $this->logActivity($user, "Has removed {$user->name} in the application");
            flash($user->name . ' is deleted in the application.')->success()->important();
        }

        return redirect()->route('admin.users.index');
    }
}

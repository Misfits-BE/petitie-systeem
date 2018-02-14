<?php

namespace Misfits\Http\Controllers\Admin\Users;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
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

    /**
     * IndexController constructor.
     *
     * @param  UserRepository $users    Abstraction layer between controller, logic, database.
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->users = $users;
    }

    /**
     * Get the index controller for the user management.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {

    }

    public function create(): View
    {

    }

    public function store(): View
    {

    }

    public function destroy(): RedirectResponse
    {

    }
}

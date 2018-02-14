<?php

namespace Misfits\Http\Controllers\Admin\Users;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\UserRepository;

/**
 * Class BanController
 * ---
 * Controller for banning and unbanning of users in the system.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contibutors
 * @package     Misfits\Http\Controllers\Admin\Users
 */
class BanController extends Controller
{
    /** @var \Misfits\Repositories\UserRepository $users */
    private $users;

    /**
     * BanController constructor.
     *
     * @todo Implmentatie Laravel authorization gate.
     *
     * @param  UserRepository $users    Abstraction layer between controller, logic, database
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->users = $users;
    }

    /**
     * Creation view for the user ban.
     *
     * @param  int $user    The unique identifier from the user in the database storage.
     * @return \Illuminate\View\View
     */
    public function create(int $user): View
    {
        return view('admin.ban.create', [
            'user' => $this->users->findOrFail($user)
        ]);
    }

    /**
     * Create the user ban in the storage.
     *
     * @param  int $user    The uniqie identifier from the user in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $user): RedirectResponse
    {

    }

    public function destroy(): RedirectResponse
    {

    }
}

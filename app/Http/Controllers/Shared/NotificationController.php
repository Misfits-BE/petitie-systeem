<?php

namespace Misfits\Http\Controllers\Shared;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;

/**
 * Class NotificationController 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Shared
 */
class NotificationController extends Controller
{
    private $notifications; /** @var \Misfits\Repositories\NotificationRepository $notifications */

    /**
     * NotificationController Constructor 
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view();
    }
}

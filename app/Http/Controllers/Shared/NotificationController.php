<?php

namespace Misfits\Http\Controllers\Shared;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Misfits\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Misfits\Repositories\NotificationRepository;

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
     * @param  NotificationRepository $notifications DB Wrapper for the notifications in the database. 
     * @return void
     */
    public function __construct(NotificationRepository $notifications)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->notifications = $notifications;
    }

    /**
     * Get the index page for the notifications.
     * 
     * @todo phpunit unit test (Not authenticated, success, banned user) -> In progress
     * @todo Convert inline styles to external css
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view('shared.notifications.index', [
            'notifications' => $this->notifications->getUserNotifications('simple', 10)
        ]);
    }
}

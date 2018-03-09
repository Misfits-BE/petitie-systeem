<?php

namespace Misfits\Http\Controllers\Shared;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Misfits\Http\Controllers\Controller;
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
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view('shared.notifications.index', [
            'notifications' => $this->notifications->getUserNotifications('simple', 10)
        ]);
    }

    /**
     * Mark a specific notification as read. 
     * 
     * @todo Implement phpunit tests
     * 
     * @param  string $notification     The UUID indentification in the database storage. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markOne(string $notification): RedirectResponse 
    {
        $notification = $this->notifications->findOrFail($notification); 

        if ($notification->update(['read_at' => now()])) {
            flash("You've marked the notification as read.")->success();
        }

        return redirect()->to($notification->data['url']);
    }

    /**
     * Mark all the unread notifications from the user as read.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAll(): RedirectResponse
    {
        auth()->user()->unreadNotifications->markAsRead();
        flash("You've read all your notifications.")->important()->success();

        return redirect()->route('notifications.index');
    }
}

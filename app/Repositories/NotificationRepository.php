<?php 

namespace Misfits\Repositories;

use Illuminate\Pagination\Paginator;
use Illuminate\Notifications\DatabaseNotification;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class notificationRepository
 *
 * @package Misfits\Repositories
 */
class NotificationRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return DatabaseNotification::class;
    }

    /**
     * Get the notications from the authenticated out of the database storage. 
     *
     * @param  string $type     Type for the pagination instance.
     * @param  int    $perPage  The amount of results u want to display per page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getUserNotifications(string $type, int $perPage): Paginator
    {
        $notifications = auth()->user()->unreadNotifications();

        switch ($type) {
            case 'simple':   return $notifications->simplePaginate($perPage);
            case 'default':  return $notifications->paginate($perPage);
            
            default: return $notifications->paginate($perPage);
        }
    }
}
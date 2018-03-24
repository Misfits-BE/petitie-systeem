<?php 

namespace Misfits\Traits;

/**
 * ActivityLog
 * ----
 * Trait helper for internal user logging.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @license     2018 Tim Joosten and his contributors
 * @package     Misfits\Traits
 */
trait ActivityLog
{
    /**
     * Write an activity log to the database
     *
     * @param  mixed  $model    The model instance where the action happend on
     * @param  string $message  The message that needs to be logged
     * @return void
     */
    public function logActivity($model, string $message): void
    {
        activity()
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->log($message);
    }
}

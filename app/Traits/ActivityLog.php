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
     * @param  mixed  $model
     * @param  string $message
     * @return void
     */
    public function logActivity($model, string $message): string 
    {
        activity()
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->log($message);
    }
}
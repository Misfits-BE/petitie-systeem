<?php

namespace Misfits\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors 
 * @package     Misfits\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Misfits\Ticket::class      => \Misfits\Policies\HelpdeskPolicy::class,
        \Misfits\User::class        => \Misfits\Policies\UserPolicy::class,
        \Misfits\Comment::class     => \Misfits\Policies\CommentPolicy::class,
        \Misfits\Petition::class    => \Misfits\Policies\PetitionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

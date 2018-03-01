<?php

namespace Misfits;

use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements BannableContract
{
    use Notifiable, HasRoles, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'city', 'name', 'firstname', 'lastname', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

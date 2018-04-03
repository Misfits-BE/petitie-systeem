<?php

namespace Misfits;

use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Cog\Laravel\Ban\Traits\Bannable;

/**
 * Class User
 * ---- 
 * Database model for the users. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     MisFits 
 */
class User extends Authenticatable implements BannableContract, HasMediaConversions
{
    use Notifiable, HasRoles, Bannable, HasMediaTrait;

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
    protected $hidden = ['password', 'remember_token'];

    /**
     * Method for encrypting the user password in the database.
     *
     * @param  string $password The given user password
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * The media conversions for the user avatar 
     * 
     * @param  Media $media Defaults to null
     * @return mixed
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb-comment') // (2)
            ->height(20)
            ->width(20)
            ->performOnCollections('images');
    }
}

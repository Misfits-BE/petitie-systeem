<?php

namespace Misfits;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country 
 * --- 
 * Database models for the countries 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits
 */
class Country extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['id', 'name'];
}

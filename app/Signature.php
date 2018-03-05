<?php

namespace Misfits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Signature 
 * --- 
 * Database model for the petition signatures.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits
 */
class Signature extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['firstname', 'lastname', 'country_id', 'city', 'email'];

    /**
     * Data relation for the specific country data 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id')
            ->withDefault(['name' => 'Unknown']);
    }
}

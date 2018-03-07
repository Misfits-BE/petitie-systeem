<?php

namespace Misfits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Misfits\Reportable\Contracts\Reportable;
use Misfits\Reportable\Traits\Reportable as ReportableTrait;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Petition 
 * ---
 * Database model for the petitions 
 * 
 * @author      TIm Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten
 * @package     Misfits
 */
class Petition extends Model implements Reportable
{
    use HasSlug, ReportableTrait; 

    /**
     * Mass-assign fields for the database table. 
     * 
     * @var array
     */
    protected $fillable = ['title', 'author_id', 'decision_maker', 'text'];

    /**
     * Database relation for the author data. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Data relation for the petition signatures 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function signatures(): HasMany 
    {
        return $this->hasMany(Signature::class);
    }

    /**
     * Get the options for generating the slug. 
     * 
     * @return \Spatie\Sluggable\SlugOptions 
     */
    public function getSlugOptions(): SlugOptions 
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}

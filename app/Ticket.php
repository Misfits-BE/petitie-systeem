<?php

namespace Misfits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Database model fàor the helpdesk tickets
 *
 * @todo Implement slugs
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits
 */
class Ticket extends Model
{
    use HasSlug;

    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'assignee_id', 'category_id', 'is_open', 'title', 'description', 'closed_at'];

    /**
     * Type cast columns
     *
     * @var array
     */
    protected $casts = ['is_open' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'closed_at'];

    /**
     * Get the author data trough the relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the information from the category through the relation. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class, 'category_id')
            ->withDefault(['name' => '(none)']);
    }

    /**
     * Get the information from the assigned user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id')->withDefault([
            'name' => '
                <span class="text-muted">(none) - </span> 
                <a href="'. route('admin.helpdesk.tickets.assign', ["slug" => $this->slug]) . '">Assign yourself</a>'
        ]);
    }

    /**
     * Get the options for generating the slug.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}

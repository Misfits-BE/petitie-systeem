<?php

namespace Misfits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Database model fàor the helpdesk tickets
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits
 */
class Ticket extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'assignee_id', 'category', 'is_open', 'title', 'description'];

    /**
     * Type cast columns
     *
     * @var array
     */
    protected $casts = ['is_open' => 'boolean'];

    /**
     * Get the author data trough the relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author_id(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
                <span class="text-muted">No one assigned - </span> 
                <a href="">Assign yourself</a>'
        ]);
    }
}

<?php

namespace Misfits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Category
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 TIm Joosten and his contributors
 * @package     Misfits
 */
class Category extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'module', 'color', 'name', 'description'];

    /**
     * Database relation for the author data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')
            ->withDefault(['name' => '<span class="text-danger">' . config('app.name') . '</span>']);
    }
}

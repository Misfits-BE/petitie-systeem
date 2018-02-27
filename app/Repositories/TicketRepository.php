<?php 

namespace Misfits\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Misfits\Ticket;
use Illuminate\Pagination\Paginator;

/**
 * Class TicketRepository
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and hs contributors
 * @package     Misfits\Repositories
 */
class TicketRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Ticket::class;
    }

    /**
     * Count tickets in the helpdesk specified by field and value.
     *
     * @return int
     */
    public function countTickets($field, $value): int
    {
        return $this->model->where($field, $value)->count();
    }

    /**
     * Get all the open tickets. The query will be changed when the user gives a search term. 
     * 
     * @param  null|string  $term    The user given search term.
     * @param  int          $perPage The amount of results u want per page. Defaults to 15
     * @return \illuminate\Pagination\Paginator
     */
    public function getOpenTickets(?string $term, int $perPage = 15): Paginator
    {
        $outputColumns = ['id', 'slug', 'title', 'author_id', 'created_at'];
        $baseQuery     = $this->model->where(['is_open' => true]);

        switch ($term) {
            case is_null($term): // There is a search term given.
                return $baseQuery->simplePaginate($perPage, $outputColumns);

            default: // No search term given so fallback on the normal DB query.
                return $baseQuery->where('title', 'LIKE', "%{$term}%")->simplePaginate($perPage, $outputColumns);
        }
    }

    /**
     * @param  \Misfits\Ticket  $ticket  The database entity form the ticket in the database.
     * @param  string           $status  The newly status form the ticket. Default to. be reopen or close.
     * @return bool
     */
    public function openClose(Ticket $ticket, string $status): bool
    {
        switch ($status) { // Determine the database query
            case 'reopen': return $ticket->update(['is_open' => true,  'closed_at' => null]); 
            case 'close':  return $ticket->update(['is_open' => false, 'closed_at' => now()]);

            // Default return value
            default: return false;
        }
    }
}

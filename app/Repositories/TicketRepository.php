<?php 

namespace Misfits\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Misfits\Ticket;

/**
 * Class TicketRepository
 *
 * @package Misfits\Repositories
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
}

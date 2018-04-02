<?php 

namespace Misfits\Http\ViewComposers;

use Illuminate\View\View;
use Misfits\Repositories\TicketRepository;

/**
 * Class HelpdeskCategoryComposer
 * ----
 * The view composer for the helpdesk navigation
 *
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and hs contributors
 * @package     App\Http\ViewComposers
 */
class HelpdeskCategoryComposer
{
    /** @var \Misfits\Repositories\TicketRepository $tickets */
    protected $tickets;

    /**
     * Create a admin helpdesk admin composer
     *
     * @param  TicketsRepository $tickets   Abstraction layer between app and database
     * @return void
     */
    public function __construct(TicketRepository $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Bind data to the view
     *
     * @param  View $view    The view contract from laravel.
     * @return void
     */
    public function compose(View $view): void
    {
        $user = auth()->user();

        $view->with('openTickets', $this->tickets->countTickets('is_open', true));
        $view->with('assignedTickets', $this->tickets->countTickets('assignee_id', $user->id));
    }
}

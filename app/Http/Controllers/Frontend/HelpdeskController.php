<?php

namespace Misfits\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Frontend\HelpdeskValidator;
use Misfits\Repositories\CategoryRepository;

/**
 * Controller for letting user creating support tickets.
 *
 * @author 		Tim Joosten <tim@activisme.be>
 * @copyright	2018 Tim Joosten and contributors
 * @package 	\Misfits\Http\Controllers\Frontend
 */
class HelpdeskController extends Controller
{
    /** @var \Misfits\Repositories\CategoryRepository $categories */
    private $categories;

    /**
     * HelpdeskController constructor
     *
     * @param  CategoryRepository $categories   Abstraction layer between controller, logic, database
     * @return void
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->middleware('auth');
        $this->categories = $categories;
    }

    /**
     * Create view for the user his helpdesk question.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('frontend.helpdesk.create', [
            'categories' => $this->categories->whereIn('module', ['helpdesk'], ['id', 'name'])
        ]);
    }

    /**
     * Store method for the user his helpdesk ticket.
     *
     * @param  HelpdeskValidator $input     The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HelpdeskValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id, 'is_open' => 1]);

        if ($ticket = $this->helpdesk->create($input->all())) {
            flash('Your helpdesk ticket has been created.')->success();
        }

        return redirect()->route('helpdesk.show', $ticket);
    }
}

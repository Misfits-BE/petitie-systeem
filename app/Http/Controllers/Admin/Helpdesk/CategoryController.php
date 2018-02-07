<?php

namespace Misfits\Http\Controllers\Admin\Helpdesk;

use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Repositories\CategoryRepository;

/**
 * Class CategoryController
 * ---
 * Admin side for the helpdesk categories
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Controllers\Admin\Helpdesk
 */
class CategoryController extends Controller
{
    /** @var \Misfits\Repositories\CategoryRepository $categories */
    private $categories; 

    /**
     * CategoryController constructor.
     *
     * @param  CategoryRepository $categories   Abstraction layer between controller, logic, database
     * @return void
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->middleware(['role:admin']);
        $this->categories = $categories;
    }

    /**
     * Get the admin dashboard for the ticket categories
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.helpdesk.categories.index', ['categories' => $this->categories->all()]);
    }
}

<?php

namespace Misfits\Http\Controllers\Admin\Helpdesk;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Misfits\Http\Controllers\Controller;
use Misfits\Http\Requests\Admin\Helpdesk\CategoryEditValidator;
use Misfits\Http\Requests\Admin\Helpdesk\CategoryValidator;
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
        $this->middleware(['auth', 'role:admin']);
        $this->categories = $categories;
    }

    /**
     * Get the admin dashboard for the ticket categories
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.helpdesk.categories.index', [
            'categories' => $this->categories->getHelpdeskCategories(15)
        ]);
    }

    /**
     * Get the create page for a new helpdesk category
     *
     * @todo   Implement resize css to the textarea. (goo.gl/W6FZs8)
     * @return \Illuminate\View\View
     */
    public function create(): view
    {
        return view('admin.helpdesk.categories.create');
    }

    /**
     * Store the new helpdesk category in the system.
     *
     * @param  CategoryValidator $input     The user given input. (Validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id, 'module' => 'helpdesk']);

        if ($category = $this->categories->create($input->all())) {
            $this->logActivity($category, "has created the category {$category->name}");
            flash($category->name . ' has been added as helpdesk category.')->success();
        }

        return redirect()->route('admin.helpdesk.categories.index');
    }

    /**
     * Function for editing a helpdesk category in the database storage
     *
     * @param  int $category    The unique identifier in the database storage
     * @return \Illuminate\View\View
     */
    public function edit(int $category): View
    {
        return view('admin.helpdesk.categories.edit', [
            'category' => $this->categories->findOrFail($category)
        ]);
    }

    /**
     * Update an helpdesk category in the database storage.
     *
     * @param  CategoryEditValidator $input     The user given input. (Validated)
     * @param  int                   $category  The uniqie identifier in the database storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryEditValidator $input, int $category): RedirectResponse
    {
        $category = $this->categories->findOrFail($category);

        if ($category->update($input->all())) {
            $this->logActivity($category, "Has updated the category {$category->name}");
            flash('The category has been updated.')->success();
        }

        return redirect()->route('admin.helpdesk.categories.edit', $category);
    }

    /**
     * Delete some helpdesk category out off the database storage.
     *
     * @param  int $category    The unique identifier from the category in the database
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $category): RedirectResponse
    {
        $category = $this->categories->findOrFail($category);

        if ($category->delete()) {
            $this->logActivity($category, " has deleted the category {$category->name}");
            flash($category->name . ' has been deleted as helpdesk category.')->success();
        }

        return redirect()->route('admin.helpdesk.categories.index');
    }
}

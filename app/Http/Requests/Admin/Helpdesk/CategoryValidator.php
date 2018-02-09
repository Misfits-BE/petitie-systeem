<?php

namespace Misfits\Http\Requests\Admin\Helpdesk;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryValidator
 * ---
 * Admin category insert validation
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Requests\Admin\Helpdesk
 */
class CategoryValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:180',
            'color' => 'required|string|max:7',
            'description' => 'required'
        ];
    }
}

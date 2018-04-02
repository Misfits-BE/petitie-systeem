<?php

namespace Misfits\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Frontend user validator for an helpdesk ticket.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     \Misfits\Http\Requests\Frontend
 */
class HelpdeskValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|max:190',
            'category_id' => 'required',
            'description' => 'required'
        ];
    }
}

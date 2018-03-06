<?php

namespace Misfits\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ReportValidator 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   Tim Joosten and his contributors
 * @package     Misfits\Http\Requests\Frontend
 */
class ReportValidator extends FormRequest
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
            'category'      => 'required|string', 
            'description'   => 'required|string', 
            'subject'       => 'required|string'
        ];
    }
}

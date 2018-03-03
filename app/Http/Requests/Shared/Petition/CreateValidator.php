<?php

namespace Misfits\Http\Requests\Shared\Petition;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateValidator 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     \Misfits\Http\Requests\Shared\Petition
 */
class CreateValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'          => 'required',
            'decision_maker' => 'required|string', 
            'image'          => 'required', 
            'text'           => 'required|string'
        ];
    }
}

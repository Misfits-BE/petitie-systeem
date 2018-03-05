<?php

namespace Misfits\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SignatureValidator 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Requests\Frontend
 */
class SignatureValidator extends FormRequest
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
            'firstname'  => 'required', 
            'lastname'   => 'required', 
            'country_id' => 'required',
            'city'       => 'required', 
            'email'      => 'required'  
        ];
    }
}

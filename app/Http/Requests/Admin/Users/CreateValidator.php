<?php

namespace Misfits\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateValidator 
 * ---- 
 * Validation class for creating an ew user
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributo)rs 
 * @package     Misfits\Http\Requests\Admin\Users
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
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',                    
            'email'     => 'required|string|email|max:255|unique:users',   
            'firstname' => 'required|string|max:190',                      
            'lastname'  => 'required|string|max:120',                      
            'role'      => 'required',                                   
        ];
    }
}

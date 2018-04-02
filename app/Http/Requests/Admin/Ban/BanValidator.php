<?php

namespace Misfits\Http\Requests\Admin\Ban;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request validator for the banning of users. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and huis contributors
 * @package     Misfits\Http\Requests\Admin\Ban
 */
class BanValidator extends FormRequest
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
        return ['reason' => 'required'];
    }
}

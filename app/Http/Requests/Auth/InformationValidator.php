<?php

namespace Misfits\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class InformationValidator 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Requests\Auth
 */
class InformationValidator extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    protected $redirectRoute = 'account.settings';

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
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getRedirectUrl() 
    {
        return $this->redirector->getUrlGenerator()->route(
            $this->redirectRoute, ['type' => 'informatie']
        );
    }
}

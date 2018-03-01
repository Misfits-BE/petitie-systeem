<?php

namespace Misfits\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PasswordValidator 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http^\Requests\Auth
 */
class PasswordValidator extends FormRequest
{
    /**
     * {@inheritDoc}
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
        return ['password' => 'required|string|min:6|confirmed'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->route(
            $this->redirectRoute, ['type' => 'security']
        );
    }
}

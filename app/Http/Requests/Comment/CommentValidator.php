<?php

namespace Misfits\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CommentValidator 
 * --- 
 * Validation rules for comments.
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Misfits\Http\Requests\Comment
 */
class CommentValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['comment' => 'required'];
    }
}

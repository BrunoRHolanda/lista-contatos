<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /** @var  Request $request */
        return [
            'name' => 'required|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => [Rule::requiredIf(function () use ($request) {
                return $request->isMethod('post');
            })]
        ];
    }
}

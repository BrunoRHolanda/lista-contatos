<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\V1\Traits\DisplayApiErros;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
{
    use DisplayApiErros;
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
        $id = $this->filled('id')? $this->input('id') : 0;
        $request = $this;

        return [
            'name' => 'required|max:100',
            'email' => [
                'required',
                //Rule::unique('users', 'email')->ignore($id),
                'max:100'
            ],
            'password' => [Rule::requiredIf(function () use ($request) {
                return $request->isMethod('post');
            })]
        ];
    }
}

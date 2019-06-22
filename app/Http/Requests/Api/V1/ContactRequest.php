<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\V1\Traits\DisplayApiErros;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'telephone' => 'required|integer',
        ];
    }
}

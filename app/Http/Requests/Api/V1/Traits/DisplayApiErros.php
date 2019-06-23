<?php


namespace App\Http\Requests\Api\V1\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Gera uma exception que envia um json com os erros ao ocorrer um erro de validação.
 *
 * Trait DisplayApiErros
 *
 * @package App\Http\Requests\Api\V1\Traits
 */
trait DisplayApiErros
{
    /**
     * Sobreescreve a função original que redireciona para uma determinada view.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
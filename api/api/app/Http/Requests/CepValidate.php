<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class CepValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'cep' => ['required', 'regex:/^\d{8}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.regex' => 'O formato do CEP é inválido. Use o formato 00000-000.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}

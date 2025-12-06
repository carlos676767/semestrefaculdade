<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array  
    {
        return [
            'userId'   => ['required', 'integer', 'exists:users,id'],
            'cep'      => ['required', 'regex:/^\d{8}$/'],
            'lat'      => ['required', 'numeric', 'between:-90,90'],
            'lng'      => ['required', 'numeric', 'between:-180,180'],
            'state'    => ['required', 'string', 'max:50'],
            'district' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'userId.required' => 'O campo userId é obrigatório.',
            'userId.integer'  => 'O campo userId deve ser um número inteiro.',
            'userId.exists'   => 'O usuário informado não existe.',

            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.regex'    => 'O formato do CEP é inválido. Use apenas números (ex: 12345678).',

            'lat.required' => 'A latitude é obrigatória.',
            'lat.numeric'  => 'A latitude deve ser um número.',
            'lat.between'  => 'A latitude deve estar entre -90 e 90.',

            'lng.required' => 'A longitude é obrigatória.',
            'lng.numeric'  => 'A longitude deve ser um número.',
            'lng.between'  => 'A longitude deve estar entre -180 e 180.',

            'state.required' => 'O campo estado é obrigatório.',
            'state.string'   => 'O estado deve ser um texto.',
            'state.max'      => 'O nome do estado não pode ter mais de 50 caracteres.',
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

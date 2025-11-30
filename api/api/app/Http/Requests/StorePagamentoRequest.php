<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'produtos'   => 'required|array|min:1',
            'produtos.*' => 'integer',
        ];
    }

    public function messages(): array
    {
        return [
            'produtos.required' => 'Você precisa selecionar pelo menos um produto para continuar.',
            'produtos.min'      => 'Selecione pelo menos um produto antes de finalizar o pagamento.',
            'produtos.*.integer' => 'Um ou mais produtos informados são inválidos.',
        ];
    }

 
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Ops! Encontramos alguns erros antes de continuar:',
                'errors' => $validator->errors()->all(),
                'hint' => 'Verifique os produtos selecionados e tente novamente.'
            ], 422)
        );
    }
}

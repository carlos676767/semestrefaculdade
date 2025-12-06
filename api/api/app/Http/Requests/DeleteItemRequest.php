<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'itemId'  => 'required|integer|exists:itens,id',
            'userId'  => 'required|integer|exists:users,id',
            'vSelect' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'itemId.required' => 'O ID do item é obrigatório.',
            'itemId.integer'  => 'O ID do item deve ser um número.',
            'itemId.exists'   => 'O item informado não existe.',

            'userId.required' => 'O usuário é obrigatório.',
            'userId.integer'  => 'O usuário deve ser um número.',
            'userId.exists'   => 'O usuário informado não existe.',

            'vSelect.required' => 'O valor selecionado é obrigatório.',
            'vSelect.string'   => 'O valor selecionado deve ser uma string.',
            'vSelect.max'      => 'O valor selecionado é muito longo.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'itemId'  => ['required', 'integer'],
            'userId'  => ['required', 'integer'],
            'vSelect' => ['required', 'string', 'max:255'],
            'status'  => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'itemId.required'  => 'O ID do item é obrigatório.',
            'itemId.integer'   => 'O ID do item deve ser um número inteiro.',

            'userId.required'  => 'O ID do usuário é obrigatório.',
            'userId.integer'   => 'O ID do usuário deve ser um número inteiro.',

            'vSelect.required' => 'O novo status é obrigatório.',
            'vSelect.string'   => 'O novo status deve ser texto.',

            'status.required'  => 'O status atual é obrigatório.',
            'status.string'    => 'O status atual deve ser texto.',
        ];
    }
}

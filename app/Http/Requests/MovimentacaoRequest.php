<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            'detalhe'=>'required',
            'id_categoria'=>'required',
            'valor'=>'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'detalhe.required' => 'Detalhe a transação financeira.',
            'id_categoria.required' => 'Escolha uma categoria.',
            'valor.numeric' => 'Informe o valor da transação.',
        ];
    }
}

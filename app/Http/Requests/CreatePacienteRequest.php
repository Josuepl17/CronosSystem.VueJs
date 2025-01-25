<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->input('id'); 
        return [
            'nome' => 'required|string',
            'DataNascimento' => 'required|date',
            'cpf' => 'required|size:11',
            'email' => 'required|email|unique:users,email,' . intval($id),
            'cidade' => 'required|string',
            'bairro' => 'required|string',
            'telefone' => 'required|string',
        ];
    }


    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'DataNascimento.required' => 'A data de nascimento é obrigatória.',
            'DataNascimento.date' => 'A data de nascimento deve ser uma data válida.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter exatamente 11 dígitos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cidade.required' => 'A cidade é obrigatória.',
            'bairro.required' => 'O bairro é obrigatório.',
            'empresa_id.exists' => 'A empresa selecionada não existe.',
            'telefone.required' => 'O telefone é obrigatório.',
        ];
    }
}

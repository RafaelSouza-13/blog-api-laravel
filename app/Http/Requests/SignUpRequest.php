<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SignUpRequest extends FormRequest
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
        return [
            "email" => 'required|email|max:255|unique:users,email|confirmed',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/'
            ],
            "name" => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'Email deve ser um endereço de email válido',
            'email.confirmed' => 'Confirmação de email não corresponde',
            'email.unique' => 'Email já está em uso',
            'email.max' => 'Email não pode ter mais de 255 caracteres',

            'password.confirmed' => 'Confirmação de senha não corresponde',
            'password.required' => 'Senha é obrigatória',
            'password.min' => 'Senha deve ter pelo menos 8 caracteres',
            'password.regex' => 'Senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial',
            
            'name.required' => 'Nome é obrigatório',
        ];
    }

    public function failedValidation(Validator $validator){
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $errors,
        ], 422));
    }
}

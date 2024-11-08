<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permite la solicitud si el usuario está autenticado
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Validación para el nombre
            'name' => [
                'required', // El nombre es obligatorio
                'string', // Debe ser una cadena de texto
                'max:255', // Máximo 255 caracteres
            ],

            // Validación para el correo electrónico (debe ser único, excepto el correo del usuario actual)
            'email' => [
                'required', // El correo electrónico es obligatorio
                'email', // Debe ser una dirección de correo electrónico válida
                Rule::unique('users')->ignore($this->user), // El correo debe ser único, excepto el del usuario actual
                'max:255', // Máximo 255 caracteres
            ],

            // Validación para la contraseña (opcional, solo si se está cambiando)
            'password' => [
                'nullable', // No es obligatorio al actualizar
                'string', // Debe ser una cadena de texto
                'min:8', // Mínimo 8 caracteres
                'confirmed', // Debe coincidir con el campo `password_confirmation`
            ],

            // Validación para el campo isAdmin (si es administrador)
            'isAdmin' => [
                'nullable', // Puede ser nulo (no obligatorio)
                'boolean', // Debe ser un valor booleano
            ],
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'email.max' => 'El correo electrónico no puede exceder los 255 caracteres.',
            
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            
            'isAdmin.boolean' => 'El campo de administrador debe ser un valor booleano.',
        ];
    }
}

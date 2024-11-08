<?php

namespace App\Http\Requests\Priority;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePriorityRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Obtiene las reglas de validación que aplican a la solicitud.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:priorities,name',
            ],
            'color' => [
                'required',
                'string',
                'size:7',
                'regex:/^#[0-9A-Fa-f]{6}$/',
                'unique:priorities,color',
            ],
            'description' => [
                'nullable',
                'string',
                'max:500',
            ],
        ];
    }

    /**
     * Obtiene los mensajes de error de validación personalizados.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la prioridad es obligatorio.',
            'name.string' => 'El nombre de la prioridad debe ser un texto.',
            'name.max' => 'El nombre de la prioridad no debe exceder los 255 caracteres.',
            'name.unique' => 'El nombre de la prioridad ya existe.',
            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.size' => 'El color debe tener exactamente 7 caracteres (incluyendo #).',
            'color.regex' => 'El color debe estar en formato hexadecimal (#000000).',
            'color.unique' => 'El color ya está asignado a otra prioridad.',
            'description.string' => 'La descripción debe ser un texto.',
            'description.max' => 'La descripción no debe exceder los 500 caracteres.',
        ];
    }
}

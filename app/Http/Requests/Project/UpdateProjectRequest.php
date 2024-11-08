<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'created_by' => ['required', 'exists:users,id'],
            'updated_by' => ['nullable', 'exists:users,id'],
            'status_id' => ['required', 'exists:statuses,id'],
            'priority_id' => ['required', 'exists:priorities,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('projects', 'name')->ignore($this->route('project')),
            ],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date', 'before_or_equal:due_date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'image_path' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'created_by.required' => 'El campo "Creado por" es obligatorio.',
            'created_by.exists' => 'El usuario seleccionado en "Creado por" no existe.',
            'updated_by.exists' => 'El usuario seleccionado en "Actualizado por" no existe.',
            'status_id.required' => 'El campo "Estado" es obligatorio.',
            'status_id.exists' => 'El estado seleccionado no existe.',
            'priority_id.required' => 'El campo "Prioridad" es obligatorio.',
            'priority_id.exists' => 'La prioridad seleccionada no existe.',
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'name.string' => 'El campo "Nombre" debe ser una cadena de texto.',
            'name.max' => 'El campo "Nombre" no debe exceder los 255 caracteres.',
            'name.unique' => 'Ya existe un proyecto con ese nombre.',
            'description.required' => 'El campo "Descripción" es obligatorio.',
            'description.string' => 'El campo "Descripción" debe ser una cadena de texto.',
            'start_date.required' => 'El campo "Fecha de inicio" es obligatorio.',
            'start_date.date' => 'El campo "Fecha de inicio" debe ser una fecha válida.',
            'start_date.before_or_equal' => 'La "Fecha de inicio" debe ser anterior o igual a la "Fecha de finalización".',
            'due_date.date' => 'El campo "Fecha de finalización" debe ser una fecha válida.',
            'due_date.after_or_equal' => 'La "Fecha de finalización" debe ser posterior o igual a la "Fecha de inicio".',
            'image_path.string' => 'El campo "Ruta de imagen" debe ser una cadena de texto.',
            'image_path.max' => 'El campo "Ruta de imagen" no debe exceder los 255 caracteres.',
        ];
    }
}

<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'integer',
                Rule::exists('projects', 'id'),
            ],
            'assigned_user_id' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'created_by' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'status_id' => [
                'required',
                'integer',
                Rule::exists('statuses', 'id'),
            ],
            'priority_id' => [
                'required',
                'integer',
                Rule::exists('priorities', 'id'),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks', 'name'),
            ],
            'description' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'image_path' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'El campo proyecto es obligatorio.',
            'project_id.integer' => 'El campo proyecto debe ser un número entero.',
            'project_id.exists' => 'El proyecto seleccionado no es válido.',

            'assigned_user_id.integer' => 'El campo usuario asignado debe ser un número entero.',
            'assigned_user_id.exists' => 'El usuario asignado no es válido.',

            'created_by.required' => 'El campo creador es obligatorio.',
            'created_by.integer' => 'El campo creador debe ser un número entero.',
            'created_by.exists' => 'El creador seleccionado no es válido.',

            'status_id.required' => 'El campo estado es obligatorio.',
            'status_id.integer' => 'El campo estado debe ser un número entero.',
            'status_id.exists' => 'El estado seleccionado no es válido.',

            'priority_id.required' => 'El campo prioridad es obligatorio.',
            'priority_id.integer' => 'El campo prioridad debe ser un número entero.',
            'priority_id.exists' => 'La prioridad seleccionada no es válida.',

            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'name.unique' => 'El nombre ya está en uso.',

            'description.required' => 'La descripción es obligatoria.',

            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',

            'due_date.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'due_date.after_or_equal' => 'La fecha de vencimiento debe ser igual o posterior a la fecha de inicio.',

            'image_path.image' => 'El archivo debe ser una imagen.',
            'image_path.max' => 'La imagen no debe ser mayor a 2MB.',
        ];
    }
}

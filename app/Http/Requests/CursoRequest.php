<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Aquí podrías validar permisos o roles
    }

    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'nivel' => 'nullable|string|max:50',
            'duracion' => 'nullable|integer|min:1',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'precio' => 'nullable|numeric|min:0',
            'activo' => 'nullable|boolean',
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del curso es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 150 caracteres.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',
            'nivel.string' => 'El nivel debe ser una cadena de texto.',
            'nivel.max' => 'El nivel no puede tener más de 50 caracteres.',
            'duracion.integer' => 'La duración debe ser un número entero.',
            'duracion.min' => 'La duración mínima es de 1 hora.',
            'fecha_inicio.date' => 'La fecha de inicio no tiene un formato válido.',
            'fecha_fin.date' => 'La fecha de fin no tiene un formato válido.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio no puede ser negativo.',
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}

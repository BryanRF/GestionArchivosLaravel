<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'required|string|max:150',
            'dni' => 'required|string|max:12',
            'user_id' => 'nullable|uuid',
            'active' => 'boolean',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'birthdate' => 'nullable|date',
            'role_id' => 'nullable|uuid|exists:roles,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
{
    return [
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de caracteres.',
        'name.max' => 'El nombre no puede tener más de 150 caracteres.',
        'dni.required' => 'El DNI es obligatorio.',
        'dni.string' => 'El DNI debe ser una cadena de caracteres.',
        'dni.max' => 'El DNI no puede tener más de 12 caracteres.',
        'user_id.uuid' => 'El ID de usuario debe ser un UUID válido.',
        'active.boolean' => 'El campo "activo" debe ser un valor booleano.',
        'address.string' => 'La dirección debe ser una cadena de caracteres.',
        'phone.string' => 'El teléfono debe ser una cadena de caracteres.',
        'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'birthdate.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'role_id.uuid' => 'El ID de rol debe ser un UUID válido.',
        'role_id.exists' => 'El rol seleccionado no existe.',
    ];
}

}

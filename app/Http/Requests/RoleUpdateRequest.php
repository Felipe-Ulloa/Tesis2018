<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:roles'.$this->role,
            'description' => 'required'
        ];
    }


    public function messages(){
        return [
            'name.required' => 'El Nombre esta vacio.',
            'slug.required' => 'El slug debe completarse.',
            'description.required' => 'Por favor, rellenar la información del Rol.',

            'slug.unique' => 'El slug esta en uso.',
        ];
    }
}

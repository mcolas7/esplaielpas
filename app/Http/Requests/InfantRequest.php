<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfantRequest extends FormRequest
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
            'nom' => 'required',
            'cognoms' => 'required',
            'email' => 'required|email',
            'telefon' => 'required|min:9|max:9|digits:9',
            'data_naixement' => 'required',
            'curs' => 'required',
            'grup' => 'required',
            'targeta_sanitaria' => 'required|unique:persones',
            'carrer' => 'required',
            'poblacio_id' => 'required',
            'codi_postal' => 'required|min:5|max:5|digits:5',
            'dni' => 'unique:persones|nullable',
            'alergies' => 'required',
            'alergia' => 'nullable'
        ];
    }

    /**
     * The messages() function returns an array of custom error messages that will be used by the
     * validator
     */
    public function messages()
    {
        return [
            'targeta_sanitaria.unique' => 'La targeta sanitària ja està registrada i no es pot repetir.',
            'dni.unique' => 'El DNI ja està registrat i no es pot repetir.'
        ];
    }
}

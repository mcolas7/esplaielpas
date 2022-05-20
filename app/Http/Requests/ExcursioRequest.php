<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcursioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //$this->user()->isAdmin()
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|max:20',
            //'checkbox' => 'accepted',
            'tipo_excursio_id' => 'required',
            'localitzacio' => 'required|max:50',
            'preu' => 'required|numeric|between:1,300', 
            'data_inici' => 'required',
            'hora_inici' => 'required',
            'data_fi' => 'required',
            'hora_fi' => 'required',
            'lat' => 'nullable',
            'long' => 'nullable',
            'imatge' => 'required|image', //size:3000
            'autoritzacio' => 'required|file', //size:1000
            'descripcio' => 'required|max:2000' //min:5|max:5|digits:5
        ];
    }

    public function messages()
    {
        return [
            'targeta_sanitaria.unique' => 'La targeta sanitària ja està registrada i no es pot repetir.',
            'dni.unique' => 'El DNI ja està registrat i no es pot repetir.'
        ];
    }
}

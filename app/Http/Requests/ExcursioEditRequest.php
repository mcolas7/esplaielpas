<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcursioEditRequest extends FormRequest
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
            'nom' => 'required|max:20',
            'tipo_excursio_id' => 'required',
            'localitzacio' => 'required|max:50',
            'preu' => 'required|numeric|between:1,300', 
            'data_inici' => 'required',
            'hora_inici' => 'required',
            'data_fi' => 'required',
            'hora_fi' => 'required',
            'lat' => 'nullable',
            'long' => 'nullable',
            'imatge' => 'nullable|image',
            'autoritzacio' => 'nullable|file',
            'descripcio' => 'required|max:2000'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            'type_customer'         => 'required|numeric',
            'name'                  => 'required|max:255',
            'telephone'             => 'nullable|max:15',
            'cellphone'             => 'nullable|max:15',
            'address'               => 'required|max:255',
            'ncr'                   => 'nullable|max:15',
            'nit'                   => 'required|unique:customers|max:15',
            'dui'                   => 'required|max:15'
        ];
    }

    public function messages()
    {
        return [
            'type_customer.numeric' => 'El tipo seleccionado no es valido',
            'nit.unique'            => 'El campo NIT ya ha sido tomado por otro cliente.'
        ];
    }
}

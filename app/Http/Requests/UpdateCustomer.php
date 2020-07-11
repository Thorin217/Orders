<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomer extends FormRequest
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
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'telephone'             => 'nullable|max:15',
            'cellphone'             => 'nullable|max:15',
            'address'               => 'required|max:255',
            'ncr'                   => 'nullable|max:15',
            'nit'                   => [
                                            'required',
                                            Rule::unique('customers')->ignore($this->customer),
                                            'max:15'
                                       ],
            'dui'                   => 'required|max:15'
        ];
    }
}

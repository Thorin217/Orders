<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryStore extends FormRequest
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
            'description'           => 'required',
            'unit_price'            => 'required|gt:0|numeric',
            'quantity_stock'         => 'required|gt:0|numeric',
            'percent_commission'    => 'required|gt:0|numeric'
        ];
    }
}

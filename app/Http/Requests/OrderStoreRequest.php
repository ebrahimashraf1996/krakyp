<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'payment' => 'string|required',
            'country' => 'string|required',
            'city' => 'string|required',
            'state' => 'string|required',
            'address' => 'string|required',
            'phone' => 'numeric|required',
            'email' => 'sometimes',
            'address_2' => 'sometimes',
            'postal_code' => 'sometimes',
            'notes' => 'sometimes',
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}

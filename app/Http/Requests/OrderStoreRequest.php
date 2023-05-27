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
            'first_name' => 'required',
            'last_name' => 'required',
            'payment' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
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
            'required' => 'هذا الحقل إلزامي',
            'numeric' => 'رقم هاتف غير صحيح',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatpackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'title' => 'required|max:255',
             'description' => 'required|max:1000',
             'duration' => 'required',
             'ads_count' => 'required',
             'price' => 'required',
             'discount' => 'sometimes',
             'cat_id' => 'required',
             'status' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب'
        ];
    }
}

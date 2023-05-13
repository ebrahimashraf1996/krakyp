<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalUpdateRequest extends FormRequest
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
        $user = backpack_auth()->user();
        $userId = isset($user) ? $user->id : null;
        return [
            'edit_photo_check' => 'required|in:0,1',
            'image' => 'sometimes',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $userId.',id',
            'phone' => 'required|unique:users,phone,'. $userId.',id',
            'whats_app' => 'required'
//            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'حدث خطأ ما .. برجاء المحاولة فيما بعد',
            'unique' => 'هذه البيانات مستخدمة بالفعل'
        ];
    }
}

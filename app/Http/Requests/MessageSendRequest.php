<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class  MessageSendRequest extends FormRequest
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
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required',
            'reason' => 'required|in:explain,report_post,report_seller',
            'order_no' => 'sometimes|max:20',
            'message' => 'required|max:200',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'email' => 'البريد الإلكتروني غير صالح',
            'max' => 'الرسالة لا تتخطي ال 200 حرف',
            'in' => 'حدث خطأ ما .. برجاء المحاولة فيما بعد',
        ];
    }
}

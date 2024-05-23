<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có được phép thực hiện yêu cầu này hay không.
     */
    public function authorize(): bool
    {
        return true; //mọi người đều được phép thực hiện yêu cầu này.
    }

    /**
     * Nhận các quy tắc xác thực áp dụng cho yêu cầu.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5', 'max:10'],
            'password' => 'required'
        ];
    }

    //cung cấp các thông báo lỗi tùy chỉnh cho các quy tắc xác thực->tại vì trong vi ko có username nên chúng ta phải định nghĩa lại name, để khi thông báo ra là username này ko để trống
    public function messages(){
        return [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.min' => 'Tên người dùng phải có ít nhất 6 ký tự.',
            'name.max' => 'Tên người dùng không được lớn hơn 10 ký tự.'
        ];
    }
}

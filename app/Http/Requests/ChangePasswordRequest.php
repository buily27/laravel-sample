<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => [
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('validation.password.old'));
                    }
                }
            ],
            'password' => ['required', 'confirmed', 'min:6', 'max:30', 'regex:/(?=.*[A-Za-z])(?=.*\d)(?=.*[ !"#$%&\'()*+,-.\/:;<=>?@[\]^_`{|}~])/'],
            'password_confirmation' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'required' => __('validation.required'),
            'password.min' => __('validation.password.min'),
            'password.max' => __('validation.password.max'),
            'password.regex' => __('validation.password.regex'),
            'password.confirmed' => __('validation.password.confirm'),
        ];
    }
}

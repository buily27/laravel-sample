<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
        $id = Auth::user()->id;
        return [
            'image' => ['mimes:jpeg,jpg,png', 'max:5120'],
            'phone' => ['nullable', 'regex:/^[0-9]{10}$/', 'unique:users,phone,' . $id],
            'dob' => ['required', 'before:today'],
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
            'required' => __('validation.required'),
            'phone.unique' => __('validation.unique.phone'),
            'image.max' => __('validation.max.size'),
            'phone.regex' => __('validation.regex.phone'),
            'dob.before' => __('validation.dob_before'),
        ];
    }
}

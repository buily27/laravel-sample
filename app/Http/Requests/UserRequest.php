<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = app('request')->get('id');
        return [
            'name' => ['required', 'min:3', 'max:30'],
            'username' => ['required', 'email', 'max:255', 'unique:users,username,' . $id],
            'image' => ['mimes:jpeg,jpg,png', 'max:5120'],
            'phone' => ['nullable', 'regex:/^[0-9]{10}$/', 'unique:users,phone,' . $id],
            'address' => ['required','max:255'],
            'dob' => ['required', 'before:today'],
            'worked_at' => ['required'],
            'role_id' => ['required', 'exists:roles,id'],
            'department_id' => ['required', 'exists:departments,id'],
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
            'username.unique' => __('validation.unique.username'),
            'phone.unique' => __('validation.unique.phone'),
            'name.min' => __('validation.name.min'),
            'name.max' => __('validation.name.max'),
            'email' => __('validation.email'),
            'mimes' => __('validation.mimes'),
            'max' => __('validation.max.string'),
            'image.max' => __('validation.max.size'),
            'phone.regex' => __('validation.regex.phone'),
            'role_id.required' => __('validation.role'),
            'department_id.required' => __('validation.department'),
            'dob.before' => __('validation.dob_before'),
            'role_id.exists' => __('validation.exists'),
            'department_id.exists' => __('validation.exists'),
        ];
    }
}

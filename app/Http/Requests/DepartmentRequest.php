<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:50', 'unique:departments,name,' . $id],
            'description' => ['nullable', 'max:255'],
            'user_id' => 'exists:users,id'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique.department'),
            'name.min' => __('validation.department_min'),
            'name.max' => __('validation.department_max'),
            'description.max' => __('validation.max'),
            'user_id.exists' => __('validation.exists'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->email == 'admin@admin.com';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company' => 'required|exists:companies,id',
            'avatar' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'email' => [
                'nullable',
                'email:filter',
                Rule::unique('employees')->ignore($this->route('employee')),
            ],
            'phone' => [
                'nullable',
                'min:10',
                Rule::unique('employees')->ignore($this->route('employee')),
            ],
        ];
    }
}

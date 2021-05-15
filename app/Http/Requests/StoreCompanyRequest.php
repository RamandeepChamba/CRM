<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('companies')->ignore($this->route('company'))
            ],
            'email' => [
                'nullable',
                'email:filter',
                Rule::unique('companies')->ignore($this->route('company')),
            ],
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|string'
        ];
    }
}

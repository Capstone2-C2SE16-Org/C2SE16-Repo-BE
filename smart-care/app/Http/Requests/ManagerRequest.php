<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $managerId = $this->route('id');
        return [
            'name' => 'required|string|max:1000',
            'address' => 'required|string|max:1000',
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'email' => ['required', 'email', Rule::unique('managers')->ignore($managerId)],
            'gender' => 'required|boolean', 
            'profile_image' => 'nullable|image|max:2048',
            'phone_number' => 'required|string|max:100',
            'username' => [
                'required', 'string', Rule::unique('managers')->ignore($managerId)
            ],
            'ward_id' => 'required|exists:wards,id',
            'district_id' => 'required|exists:districts,id',
            'province_id' => 'required|exists:provinces,id',
            'password' => $managerId ? 'nullable|string|min:8' : 'required|string|min:8',
            'roles' => $managerId ? 'nullable|array' : 'required|array', 
            'roles.*' => 'exists:roles,id' 
        ];
    }
    protected function prepareForValidation()
    {
        if ($this->has('password')) {
            $this->merge([
                'password' => Hash::make($this->password)
            ]);
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('id');
        return [
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'email' => 'required|email|unique:students,email,' . $studentId,
            'gender' => 'required|boolean',
            'profile_image' => 'nullable|image|max:2048',
            'phone_number' => 'required|string|max:20',
            'username' => [
                'required', 'string', 'max:255',
                Rule::unique('students')->ignore($studentId),
            ],
            'password' => $studentId ? 'nullable|string|min:8' : 'required|string|min:8',
            'classroom_id' => 'required|exists:classrooms,id',
            'ward_id' => 'required|exists:wards,id',
            'district_id' => 'required|exists:districts,id',
            'province_id' => 'required|exists:provinces,id',
            'parent_name' => 'required|string|max:255',
            'parent_date_of_birth' => 'required|date|before:today',
            'parent_gender' => 'required|boolean',
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

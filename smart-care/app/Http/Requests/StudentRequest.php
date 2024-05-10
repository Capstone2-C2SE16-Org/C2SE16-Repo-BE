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
            'name' => 'required|string|max:1000',
            'address' => 'required|string|max:1000',
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'email' => 'required|email',
            'gender' => 'required',
            'profile_image' => 'nullable|string',
            'phone_number' => 'required|string|max:100',
            'username' => [
                'required',
                Rule::unique('students', 'username')->ignore($studentId)
            ],
            'password' => 'required|string|min:6',
            'classroom_id' => 'required|exists:classrooms,id',
            'parent_name' => 'required|string|max:1000',
            'parent_date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'parent_gender' => 'required',
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

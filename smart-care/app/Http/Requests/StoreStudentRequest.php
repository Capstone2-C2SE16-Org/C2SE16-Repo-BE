<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
        return [
            'reason' => 'required_without:other_reason|string|max:255',
            'other_reason' => 'required_without:reason|string|max:255',
            'leave_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:leave_date',
            'status' => 'required|boolean',
            'request_date' => 'required|date',
            'student_id' => 'required|exists:students,id',
            'manager_id' => 'required|exists:managers,id',
        ];
    }
}

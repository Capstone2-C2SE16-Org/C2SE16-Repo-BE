<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reason' => 'required_without:other_reason|nullable|string|max:255',
            'other_reason' => 'required_without:reason|nullable|string|max:255',
            'leave_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:leave_date',
            'request_date' => 'required|date',
        ];
    }
}

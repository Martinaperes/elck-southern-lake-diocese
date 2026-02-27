<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $memberId = $this->route('member') ? $this->route('member')->id : null;
        $userId = $this->route('member') && $this->route('member')->user ? $this->route('member')->user->id : null;

        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'unique:members,email,' . $memberId,
                'unique:users,email,' . $userId,
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'marital_status' => ['nullable', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'baptism_date' => 'nullable|date',
            'confirmation_date' => 'nullable|date',
            'home_congregation' => 'nullable|string|max:200',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'parish_id' => 'nullable|exists:parishes,id',
            'is_active' => 'boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['name'] = 'required|string|max:255';
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['role'] = 'required|in:user,admin,pastor,secretary,treasurer,deacon';
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }
}

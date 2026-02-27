<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'nullable|date',
            'end_time' => 'nullable',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:service,meeting,conference,workshop,other',
            'ministry_id' => 'nullable|exists:ministries,id',
            'is_public' => 'boolean',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_public' => $this->has('is_public'),
        ]);
    }
}

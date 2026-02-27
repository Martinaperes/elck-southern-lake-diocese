<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SermonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'preacher' => 'required|string|max:255',
            'sermon_date' => 'required|date',
            'scripture_references' => 'nullable|string|max:500',
            'duration_minutes' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'audio_url' => 'nullable|url|max:500',
            'video_url' => 'nullable|url|max:500',
            'document_url' => 'nullable|url|max:500',
            'is_published' => 'boolean',
            'featured' => 'boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_published' => $this->has('is_published'),
            'featured' => $this->has('featured'),
        ]);
    }
}

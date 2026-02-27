<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'scheduled_at' => 'nullable|date|after:now',
            'send_option' => 'required|in:draft,now,schedule',
            'remove_image' => 'boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_featured' => $this->has('is_featured'),
        ]);
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MinistryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('ministry') ? $this->route('ministry')->id : null;

        return [
            'name' => 'required|string|max:255|unique:ministries,name,' . $id,
            'description' => 'nullable|string',
            'leader_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'meeting_schedule' => 'nullable|string',
            'is_active' => 'boolean',
            'leader_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('media', 'title')->ignore($this->route('media'))],
            'slug' => ['required', 'string', 'max:255', Rule::unique('media', 'slug')->ignore($this->route('media'))],
            'type' => ['required', 'in:film,series,anime'],
            'studio_id' => ['nullable', 'exists:studios,id'],
            'synopsis' => ['nullable', 'string', 'max:2000'],
            'release_year' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'poster' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'genres' => ['nullable', 'array'],
            'genres.*' => ['exists:genres,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }
}
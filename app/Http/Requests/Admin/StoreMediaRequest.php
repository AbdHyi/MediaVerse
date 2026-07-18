<?php
// app/Http/Requests/Admin/StoreMediaRequest.php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // otorisasi role sudah dijamin middleware di route
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:media,title'],
            'slug' => ['required', 'string', 'max:255', 'unique:media,slug'],
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
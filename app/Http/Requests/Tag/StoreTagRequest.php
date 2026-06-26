<?php

namespace App\Http\Requests\Tag;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:tags,name',
            'color' => 'nullable|string|max:20',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'The tag name is required.',
            'name.max' => 'The tag name may not be greater than 255 characters.',
            'name.unique' => 'This tag name already exists.',
        ];
    }
}

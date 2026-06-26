<?php

namespace App\Http\Requests\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The project name is required.',
            'name.string' => 'The project name must be text.',
            'name.max' => 'The project name may not be greater than 255 characters.',

            'description.required' => 'The project description is required.',

            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',

            'deadline.required' => 'The deadline is required.',
            'deadline.date' => 'The deadline must be a valid date.',
            'deadline.after_or_equal' => 'The deadline cannot be before the start date.',
        ];
    }
}

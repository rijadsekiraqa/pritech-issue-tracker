<?php

namespace App\Http\Requests\Issue;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreIssueRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string',
            'description' => 'required',

            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',

            'due_date' => 'nullable|date',

        ];
    }


    public function messages(): array
    {
        return [
            'project_id.required' => 'The project is required.',
            'project_id.exists' => 'The selected project does not exist.',

            'title.required' => 'The issue title is required.',
            'title.string' => 'The issue title must be text.',

            'description.required' => 'The issue description is required.',

            'status.required' => 'The issue status is required.',
            'status.in' => 'The selected status is invalid.',

            'priority.required' => 'The issue priority is required.',
            'priority.in' => 'The selected priority is invalid.',

            'due_date.date' => 'The due date must be a valid date.',

            
        ];
    }
}

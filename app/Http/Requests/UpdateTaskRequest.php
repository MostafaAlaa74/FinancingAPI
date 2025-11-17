<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'due_date' => 'sometimes|nullable|date',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
            'periority' => 'sometimes|required|in:low,medium,high',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'due_date.date' => 'The due date must be a valid date.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid. Allowed values are: pending, in_progress, completed.',
            'periority.required' => 'The periority field is required.',
            'periority.in' => 'The selected periority is invalid. Allowed values are: low, medium, high.',
        ];
    }
}

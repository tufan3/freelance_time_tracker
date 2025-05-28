<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TimeLogRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'Project ID is required',
            'project_id.exists' => 'Project ID is not valid',
            'description.string' => 'Description must be a string',
        ];
    }
}

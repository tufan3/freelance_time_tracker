<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProjectRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed',
            'deadline' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'Client ID is required',
            'client_id.exists' => 'Client ID is not valid',
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must be less than 255 characters',
            'description.string' => 'Description must be a string',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be active or completed',
            'deadline.date' => 'Deadline must be a date',
        ];
    }
}

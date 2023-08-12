<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateListingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'company' => ['required'],
            'location' => ['required'],
            'email' => ['required', 'email'],
            'website' => ['required'],
            'description' => ['required'],
            'tags.*' => ['required', 'string'],
            'tags.new' => ['nullable', 'string']
        ];
    }
}

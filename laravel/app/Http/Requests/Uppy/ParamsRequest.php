<?php

namespace App\Http\Requests\Uppy;

use Illuminate\Foundation\Http\FormRequest;

class ParamsRequest extends FormRequest
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
            'filename' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'metadata' => 'required|array',
            'metadata.upload_type' => 'required|string|max:255',
        ];
    }
}

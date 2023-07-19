<?php

namespace App\Http\Requests\V1\my\Team;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'logo' => ['nullable', 'string'],
            'cover' => ['nullable', 'string'],
            'aum_amount' => ['nullable', 'string'],
            'aum_currency' => ['nullable', 'string'],
            'is_hireable' => ['nullable', 'boolean'],
            'is_public' => ['nullable', 'boolean'],
            'status' => ['nullable', 'integer'],
            'synced_at' => ['nullable', 'date']
        ];
    }
}

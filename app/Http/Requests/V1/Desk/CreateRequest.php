<?php

namespace App\Http\Requests\V1\Desk;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string', 'max:255'],
            'content'         => ['nullable', 'string'],
            'logo'            => ['nullable', 'image', 'mimes:jpeg,png', 'max:100'],
            'cover'           => ['nullable', 'image', 'mimes:jpeg,png', 'max:100'],
            'aum_amount'      => ['nullable', 'string', 'max:255'],
            'aum_currency'    => ['nullable', 'string', 'max:255'],
            'is_public'       => ['nullable', 'boolean'],
        ];
    }
}

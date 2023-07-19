<?php

namespace App\Http\Requests\V1\Desk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'           => ['nullable', 'string', 'max:255'],
            'description'     => ['nullable', 'string', 'max:255'],
            'content'         => ['nullable', 'string'],
            'logo'            => ['nullable', 'string', 'max:255'],
            'cover'           => ['nullable', 'string', 'max:255'],
            'aum_amount'      => ['nullable', 'string', 'max:255'],
            'aum_currency'    => ['nullable', 'string', 'max:255'],
            'is_public'       => ['nullable', 'boolean'],
        ];
    }
}

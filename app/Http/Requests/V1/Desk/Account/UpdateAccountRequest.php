<?php

namespace App\Http\Requests\V1\Desk\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'desk_id'             => 'nullable|exists:desks,id',
            'trading_account_id'  => 'nullable|uuid',
            'risk_management_id'  => 'nullable|uuid',
            'money_management_id' => 'nullable|uuid',
            'title'               => 'nullable|string',
            'is_public'           => 'nullable|boolean',
        ];
    }
}

<?php

namespace App\Http\Requests\V1\Desk\Account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'desk_id'             => 'required|exists:desks,id',
            'trading_account_id'  => 'required|uuid',
            'risk_management_id'  => 'required|uuid',
            'money_management_id' => 'required|uuid',
            'user_id'             => 'nullable|uuid',
            'title'               => 'nullable|string',
            'is_public'           => 'nullable|boolean',
        ];
    }
}

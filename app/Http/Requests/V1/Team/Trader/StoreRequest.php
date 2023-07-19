<?php

namespace App\Http\Requests\V1\Team\Trader;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [

                     'team_id'      => ['required',Rule::exists('teams','id')],
                     'content'      => ['nullable','string'],
                     'share'        =>  ['required','numeric','min:0','max:100'],
                     'profits'      => ['nullable','string'],
                     'harvestable'  => ['nullable','string'],
                     'harvested'    => ['nullable','string'],
                     'priority'     => ['nullable','integer'],
                     'aum_amount'   => ['nullable','string'],
                     'aum_currency' => ['nullable','string'],
                     'is_hireable'  => ['nullable','boolean'],
                     'is_public'    => ['nullable','boolean'],
                     'type'         => ['nullable','integer'],
                     'status'       => ['nullable','integer'],
                     'synced_at'    => ['nullable','date_format:Y-m-d H:i:s']
        ];
    }
}


<?php

namespace App\Http\Requests\V1\Contract;

use App\Models\DalanCapital\V1\Desk;
use App\Models\DalanCapital\V1\DeskAccount;
use App\Models\DalanCapital\V1\TeamTrader;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\DalanCapital\V1\Team;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'team_id'          => ['required' , Rule::exists(Team::TABLE , 'id')],
            'team_trader_id'   => ['required' , Rule::exists(TeamTrader::TABLE , 'id')],
            'desk_id'          => ['required' , Rule::exists(Desk::TABLE , 'id')],
            'desk_account_id'  => ['required' , Rule::exists(DeskAccount::TABLE , 'id')],
            'title'            => ['nullable', 'string', 'max:255'],
            'description'      => ['nullable', 'string', 'max:255'],
            'number'           => ['required', 'string','unique:contracts,number'],
            'share'            => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'start_balance'    => ['required', 'string', 'max:255'],
            'current_balance'  => ['required', 'string', 'max:255'],
            'currency'         => ['nullable', 'string', 'max:255'],
            'profits'           => ['nullable', 'string', 'max:255'],
            'harvestable'      => ['nullable', 'string', 'max:255'],
            'harvested'        => ['nullable', 'string', 'max:255'],
            'scale_up_amount'  => ['nullable', 'string', 'max:255'],
            'scaled_up_times'  => ['nullable' , 'integer'],
            'scaled_up_at'     => ['nullable','string','date_format:Y-m-d H:i:s'],
            'target'           => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'synced_at'        => ['nullable','string','date_format:Y-m-d H:i:s'],
            'is_public'        => ['nullable', 'boolean'],
        ];
    }
}

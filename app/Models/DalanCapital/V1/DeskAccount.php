<?php

namespace App\Models\DalanCapital\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeskAccount extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'desk_accounts';

    const TABLE = 'desk_accounts';

    protected $fillable = [
        'desk_id', 'trading_account_id', 'risk_management_id', 'money_management_id', 'title', 'user_id', 'priority', 'is_public', 'type', 'status'
    ];

    protected $casts = [
        'is_public' => 'boolean'
    ];

    public function desk() : BelongsTo
    {
        return $this->belongsTo(Desk::class , 'desk_id' , 'id');
    }

    public function contract() : HasMany
    {
        return $this->hasMany(Contract::class);
    }
    public function scopePublic(Builder $query)
    {
        $query->whereIsPublic(true);
    }
}

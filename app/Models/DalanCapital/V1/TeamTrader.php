<?php

namespace App\Models\DalanCapital\V1;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamTrader extends Model
{

    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'team_traders';
    const USER_ID = 'user_id';

    const TABLE = 'team_traders';

    protected $fillable = [
        'team_id', 'content', 'share', 'profits', 'harvestable', 'harvested',
        'priority', 'aum_amount', 'aum_currency', 'is_hireable', 'is_public',
        'type', 'status', 'synced_at', 'user_id',
    ];

    protected $casts = [
        'aum_amount' => 'double',
        'is_hireable' => 'boolean',
        'is_public' => 'boolean',
        'synced_at' => 'datetime'
    ];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function contract() : HasMany
    {
        return $this->hasMany(Contract::class);
    }
}

<?php

namespace App\Repositories\V1\Contract;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use App\Models\DalanCapital\V1\Contract;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class ContractRepository extends AbstractRepository implements IContractRepository
{
    public function index( array $attributes)
    {
        if (empty($attributes)) {
            return $this->model->withRelational()->where('is_public' , true)->paginate();
        } else {
            return EloquentBuilder::to($this->model, $attributes)->with([
                'desk' => function($desk){
                    return $desk->select(['id','title']);
                },
                'team' => function($team){
                    return $team->select(['id','title']);
                },
                'teamTrader'=> function($teamTraders){
                    return $teamTraders->select(['id','team_id','content'])->with([
                        'team' => function($team){
                            return $team ;
                        }
                    ]);
                },
                'deskAccount' => function($deskAccounts){
                    return $deskAccounts->select(['id','title','desk_id','trading_account_id','risk_management_id','money_management_id'])->with([
                        'desk' => function($desk){
                            return $desk ;
                        }
                    ]);
                },
            ])->where('is_public' , true)->paginate();
        }
    }

    public function show($uuid) : Model
    {
        return $this->findOrFail($uuid);
    }

    public function store(array $attributes = []) : Model
    {
        return $this->create($attributes);
    }

    public function update($id, array $attributes): Model
    {
        $model = $this->findOrFail($id);

        return $this->updateModel($model, $attributes);
    }


    public function destroy($uuid): ?string
    {
        return $this->delete($uuid);
    }


    protected function instance(array $attributes = []): Model
    {
        return new Contract();
    }
}

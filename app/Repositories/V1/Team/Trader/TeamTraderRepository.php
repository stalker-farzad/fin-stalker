<?php
namespace App\Repositories\V1\Team\Trader;
use App\Models\DalanCapital\V1\TeamTrader;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class TeamTraderRepository extends AbstractRepository implements ITeamTraderRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new TeamTrader();
    }

    public function list($data)
    {
        $query = $this->model;
        if (!empty($data)) {
             $query = EloquentBuilder::to($query, $data);
        }
        $query = $query->where('is_public', true);
        return $query->paginate();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }
    public function show(string $uuid)
    {
        $model = $this->model->find($uuid);
        if ($model->is_public)
        {
            return $model;
        }
    }

    public function update($uuid, array $data): Model
    {
        $teamTrader = $this->model->where('id', $uuid)->firstOrFail();
        $teamTrader->update($data);
        return $teamTrader;
    }
    public function delete($uuid): ?bool
    {
        return $this->model->delete($uuid);
    }


}

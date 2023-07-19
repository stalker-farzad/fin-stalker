<?php
namespace App\Repositories\V1\my\TeamTrader;

use App\Models\DalanCapital\V1\TeamTrader;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder ;

class MyTeamTraderRepository extends AbstractRepository implements IMyTeamTraderRepository
{
    public function index(string $user_id, array $attributes)
    {
        $query = $this->model->where('user_id', $user_id);

        if (!empty($attributes)) {
            $query = EloquentBuilder::to($query, $attributes);
        }

        return $query->paginate();
    }

    public function show(string $uuid, string $user_id)
    {
        return $this->model->where('id', $uuid)
            ->where('user_id', $user_id)
            ->firstOrFail();
    }


    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($uuid, array $attributes): Model
    {
        $model = $this->findOrFail($uuid);

        return $this->updateModel($model, $attributes);
    }


    public function destroy($uuid): ?bool
    {
        return $this->delete($uuid);
    }

    protected function instance(array $attributes = []): Model
    {
        return new TeamTrader();
    }
}

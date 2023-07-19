<?php

namespace App\Repositories\V1\my\Team;

use App\Models\DalanCapital\V1\Team;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Fouladgar\EloquentBuilder\EloquentBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeamRepository extends AbstractRepository implements ITeamRepository
{
    public function indexByUserUuid(string $userUuid, array $data) : LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->where('user_id', $userUuid)->paginate();
        }
        return EloquentBuilder::to($this->model, $data)
            ->where('user_id', $userUuid)->paginate();
    }

    public function singleByUserUuid($uuid, $userUuid) : Model
    {
        return $this->model->where(['user_id' => $userUuid, 'id' => $uuid])->firstOrFail();
    }

    public function SingleByUuid(string $uuid): Model
    {
        return $this->findOrFail($uuid);
    }

    public function store(array $data = []) : Model
    {
        return $this->create($data);
    }

    public function update($uuid, array $data): Model
    {
        $model = $this->findOrFail($uuid);

        return $this->updateModel($model, $data);
    }


    public function destroy($uuid): ?bool
    {
        return $this->delete($uuid);
    }


    protected function instance(array $attributes = []): Model
    {
        return new Team();
    }

}

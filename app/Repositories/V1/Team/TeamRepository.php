<?php

namespace App\Repositories\V1\Team;

use App\Models\DalanCapital\V1\Team;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Fouladgar\EloquentBuilder\EloquentBuilder;
use Fouladgar\EloquentBuilder\Exceptions\NotFoundFilterException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TeamRepository extends AbstractRepository implements ITeamRepository
{

    /**
     * @throws NotFoundFilterException
     */
    public function index(array $data): LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->query()->where('is_public', true)->paginate();
        }else{
            return EloquentBuilder::to($this->model, $data)->paginate();
        }
    }

    public function singleByUuid(string $uuid): ?Model
    {
        return $this->findOrFail($uuid);
    }

    public function updateByUuid($data, $uuid): Model
    {
        $model = $this->findOrFail($uuid);

        return $this->updateModel($model, $data);
    }

    protected function instance(array $attributes = []): Model
    {
        return new Team();
    }

    public function deleteByUuid(string $uuid): ?bool
    {
        return $this->delete($uuid);
    }
}

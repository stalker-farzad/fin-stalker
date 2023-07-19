<?php

namespace App\Repositories\V1\Desk;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use App\Models\DalanCapital\V1\Desk;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class DeskRepository extends AbstractRepository implements IDeskRepository
{
    public function index( array $attributes)
    {
        if (empty($attributes)) {
            return $this->model->where('is_public' , true)->paginate();
        } else {
            return EloquentBuilder::to($this->model, $attributes)->where('is_public' , true)->paginate();
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
        return new Desk();
    }
}

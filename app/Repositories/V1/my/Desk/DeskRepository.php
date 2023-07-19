<?php

namespace App\Repositories\V1\my\Desk;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\Models\DalanCapital\V1\Desk;
use EloquentBuilder ;

class DeskRepository extends AbstractRepository implements IDeskRepository
{
    public function index(string $userId, array $attributes) : LengthAwarePaginator
    {
        if (empty($attributes)) {
            return $this->model->where('user_id' , $userId)->paginate();

        } else {
            return EloquentBuilder::to($this->model, $attributes)
                ->where('user_id' , $userId)->paginate();
        }
    }

    public function show($uuid , $userId)
    {
        return $this->model->where(['id' => $uuid, 'user_id' => $userId])->firstOrFail();
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

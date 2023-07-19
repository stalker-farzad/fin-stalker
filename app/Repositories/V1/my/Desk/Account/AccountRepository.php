<?php

namespace App\Repositories\V1\my\Desk\Account;

use App\Models\DalanCapital\V1\DeskAccount;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountRepository extends AbstractRepository implements IAccountRepository
{
    /**
     * @param string $user_id
     * @param array $attributes
     *
     * @return LengthAwarePaginator
     */
    public function index(string $user_id, array $attributes) : LengthAwarePaginator
    {
        if (empty($attributes)) {
            return $this->model->with([
                'desk' => function($desk){
                    $desk->select(['id' , 'title']);
                }
            ])->where('user_id' , $user_id)->paginate();
        }

        return EloquentBuilder::to($this->model, $attributes)->with([
            'desk' => function($desk){
                $desk->select(['id' , 'title']);
            }
        ])->where('user_id' , $user_id)->paginate();
    }

    /**
     * @param string $uuid
     *
     * @return Model
     */
    public function show(string $uuid) : Model
    {
        return $this->findOrFail($uuid);
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function store(array $attributes = []) : Model
    {
        return $this->create($attributes);
    }

    /**
     * @param string $uuid
     * @param array  $attributes
     *
     * @return Model
     */
    public function update($uuid, array $attributes) : Model
    {
        $model = $this->findOrFail($uuid);
        return $this->updateModel($model, $attributes);
    }

    /**
     * @param string $uuid
     *
     * @return bool|null
     */
    public function destroy(string $uuid) : ?bool
    {
        return $this->delete($uuid);
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    protected function instance(array $attributes = []) : Model
    {
        return new DeskAccount();
    }
}

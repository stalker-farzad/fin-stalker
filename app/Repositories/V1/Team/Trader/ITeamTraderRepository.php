<?php

namespace App\Repositories\V1\Team\Trader;

use Illuminate\Database\Eloquent\Model;


interface ITeamTraderRepository
{
    public function list(array $data);
    public function store(array $data);
    public function show(string $uuid);
    public function update(string $uuid, array $data): Model;
    public function delete(string $uuid);

}

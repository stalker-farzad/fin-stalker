<?php
namespace App\Repositories\V1\my\TeamTrader;

interface IMyTeamTraderRepository
{
    public function index(string $user_id ,array $attributes);

    public function show(string $uuid , string $user_id);

    public function store(array $attributes);

    public function update(string $id, array $attributes);

    public function destroy(string $uuid);

}

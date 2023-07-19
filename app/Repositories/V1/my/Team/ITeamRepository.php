<?php

namespace App\Repositories\V1\my\Team;

interface ITeamRepository
{
    public function indexByUserUuid(string $userUuid ,array $data);

    public function singleByUserUuid(string $uuid , string $userUuid);

    public function SingleByUuid(string $uuid);

    public function store(array $data);

    public function update(string $uuid, array $data);

    public function destroy(string $uuid);

}

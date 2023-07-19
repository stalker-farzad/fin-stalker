<?php

namespace App\Repositories\V1\Team;


interface ITeamRepository
{
    public function index(array $data);

    public function singleByUuid(string $uuid);

    public function updateByUuid(array $data, string $uuid);

    public function deleteByUuid(string $uuid);
}

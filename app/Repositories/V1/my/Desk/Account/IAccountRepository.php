<?php

namespace App\Repositories\V1\my\Desk\Account;

interface IAccountRepository
{
    public function index(string $user_id, array $attributes);

    public function show(string $uuid);

    public function store(array $attributes);

    public function update($uuid, array $attributes);

    public function destroy(string $uuid);
}

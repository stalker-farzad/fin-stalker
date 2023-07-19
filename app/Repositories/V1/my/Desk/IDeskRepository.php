<?php

namespace App\Repositories\V1\my\Desk;

interface IDeskRepository
{
    public function index(string $userId ,array $attributes);

    public function show(string $uuid , string $userId);

    public function store(array $attributes);

    public function update(string $id, array $attributes);

    public function destroy(string $uuid);

}

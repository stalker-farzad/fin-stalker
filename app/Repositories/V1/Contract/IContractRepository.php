<?php

namespace App\Repositories\V1\Contract;

interface IContractRepository
{

    public function index(array $attributes);

    public function show(string $uuid);

    public function store(array $attributes);

    public function update(string $id, array $attributes);

    public function destroy(string $uuid);
}

<?php

namespace App\Repositories;

interface CarRepositoryInterface
{
    public function getAll();
    public function get($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}

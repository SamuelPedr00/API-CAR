<?php

namespace App\Repositories;

use App\Models\Cars;

class CarRepositoryEloquent implements CarRepositoryInterface
{
    public function __construct(
        private Cars $model
    ) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $car = $this->model->find($id);

        if (!$car) {
            return null;
        }

        $car->update($data);
        return $car->fresh(); // Retorna o modelo atualizado
    }

    public function destroy($id)
    {
        $car = $this->model->find($id);

        if (!$car) {
            return false;
        }

        return $car->delete();
    }
}

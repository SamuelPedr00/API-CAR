<?php

namespace App\Services;

use App\Repositories\CarRepositoryInterface;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Validation\ValidationCar;

class CarsService
{
    private $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getAll()
    {
        try {
            $cars = $this->carRepository->getAll();
            return response()->json($cars, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => 'Erro de conexão com o banco de dados'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function get($id)
    {
        try {
            $car = $this->carRepository->get($id);

            if (!$car) {
                return response()->json(
                    ['error' => 'Carro não encontrado'],
                    Response::HTTP_NOT_FOUND
                );
            }

            return response()->json($car, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => 'Erro de conexão com o banco de dados'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ValidationCar::RULE_STORE_CAR, ValidationCar::MESSAGE_STORE_CAR);

        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => 'Erro de validação',
                    'messages' => $validator->errors()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $car = $this->carRepository->store($validator->validated());
            return response()->json($car, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => 'Erro ao criar o carro'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), ValidationCar::RULE_UPDATE_CAR, ValidationCar::MESSAGE_UPDATE_CAR);

        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => 'Erro de validação',
                    'messages' => $validator->errors()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $data =  $validator->validated();
            $car = $this->carRepository->update($id, $data);

            if (!$car) {
                return response()->json(
                    ['error' => 'Carro não encontrado'],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json($car, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => 'Erro ao atualizar o carro'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function destroy($id)
    {
        try {
            $car = $this->carRepository->destroy($id);

            if (!$car) {
                return response()->json(
                    ['error' => 'Carro não encontrado'],
                    Response::HTTP_NOT_FOUND
                );
            }

            return response()->json(
                ['message' => 'Carro deletado com sucesso'],
                Response::HTTP_OK
            );
        } catch (QueryException $exception) {
            return response()->json(
                ['error' => 'Erro ao deletar o carro'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}

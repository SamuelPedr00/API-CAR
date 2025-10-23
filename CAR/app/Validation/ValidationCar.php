<?php

namespace App\Validation;

class ValidationCar
{
    const RULE_STORE_CAR = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'model' => 'required|string|max:100',
        'date' => 'required|date',
    ];
    const MESSAGE_STORE_CAR = [
        'name.required' => 'O nome é obrigatório',
        'name.string' => 'O nome deve ser um texto',
        'name.max' => 'O nome não pode ter mais de 255 caracteres',

        'description.string' => 'A descrição deve ser um texto',
        'description.max' => 'A descrição não pode ter mais de 1000 caracteres',

        'model.required' => 'O modelo é obrigatório',
        'model.string' => 'O modelo deve ser um texto',
        'model.max' => 'O modelo não pode ter mais de 100 caracteres',

        'date.required' => 'A data é obrigatória',
        'date.date' => 'A data deve ser válida',
    ];

    const RULE_UPDATE_CAR = [
        'name' => 'sometimes|string|max:255',
        'description' => 'nullable|string|max:1000',
        'model' => 'sometimes|string|max:100',
        'date' => 'sometimes|date',
    ];
    const MESSAGE_UPDATE_CAR = [
        'name.string' => 'O nome deve ser um texto',
        'name.max' => 'O nome não pode ter mais de 255 caracteres',

        'description.string' => 'A descrição deve ser um texto',
        'description.max' => 'A descrição não pode ter mais de 1000 caracteres',

        'model.string' => 'O modelo deve ser um texto',
        'model.max' => 'O modelo não pode ter mais de 100 caracteres',

        'date.date' => 'A data deve ser válida',
    ];
}

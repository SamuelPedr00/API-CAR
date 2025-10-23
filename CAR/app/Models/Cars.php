<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{

    protected $table = 'car';

    protected $fillable = [
        'name',
        'description',
        'model',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public $timestamps = false;
}

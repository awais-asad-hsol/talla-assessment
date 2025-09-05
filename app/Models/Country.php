<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'countries_db';

    protected $fillable = [
        'name', 'capital', 'area', 'currencies', 'languages',
    ];

    protected $casts = [
        'currencies' => 'array',
        'languages' => 'array',
    ];
}

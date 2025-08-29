<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Spatie / Shield traits
use Spatie\Permission\Traits\HasRoles;
// OR
// use BezhanSalleh\FilamentShield\Traits\HasFilamentShield;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles; 
    // OR use HasFilamentShield;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

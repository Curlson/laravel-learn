<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// 这个我也不知道是干啥的

class UserModel extends Authenticatable  implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
//
    protected $primaryKey = 'id';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}

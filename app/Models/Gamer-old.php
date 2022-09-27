<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Gamer extends Authenticatable {
    protected $guard = 'gamer';

    protected $fillable = [
        'firstname', 'midname', 'lastname', 'email', 'address', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function team() {

        return $this->hasOne( 'App\Models\Teams', 'gamer_id', 'id' );
    }
}

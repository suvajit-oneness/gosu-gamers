<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teams extends Authenticatable {

    public function TeamPlayers() {
        return $this->hasMany( 'App\Models\TeamPlayers', 'team_id', 'id' );
    }

    public function gamer() {
        return $this->belongsTo( 'App\Models\Gamer', 'gamer_id' );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams_tournament extends Model {
    public function TeamPlayers() {
        return $this->hasMany( 'App\Models\TeamPlayers', 'team_id', 'team_id' );
    }

    public function team() {
        return $this->belongsTo( '\App\Models\Teams', 'team_id', 'id' );
    }

    public function tournament() {
        return $this->belongsTo( '\App\Models\Tournaments', 'tournament_id', 'id' );
    }

    public function gamer() {
        return $this->hasOneThrough( 'App\Models\Gamer', 'App\Models\Teams', 'gamer_id', 'id', 'team_id' );
    }
}

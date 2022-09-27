<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use App\Models\Country;
use App\Models\Teams_tournament;
use App\Models\Gamers_tournaments;

class Tournaments extends Model {
    protected $table = 'tournaments';
    protected $primaryKey = 'id';

    public function game_name() {
        return $this->belongsTo( \App\Models\Game::class, 'game_id', 'id' );
    }

    public function get_country() {
        return $this->hasOne( \App\Models\Country::class, 'id', 'country_id' );
    }

    public function teams_tournaments() {
        return $this->belongsTo( \App\Models\Teams_tournament::class, 'tournament_id', 'id' );
    }

    public function gamer_tournaments() {
        return $this->belongsTo( \App\Models\Gamers_tournaments::class, 'tournament_id', 'id' );
    }

    public function Tournament_rooms() {
        return $this->hasOne( \App\Models\Tournament_rooms::class, 'tournament_id', 'id' );

    }
}

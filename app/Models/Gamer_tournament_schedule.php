<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gamer_tournament_schedule extends Model
{
        public function player1_name(){
        return $this->belongsTo(\App\Models\Gamer::class, 'player1', 'id');
    }

    public function player2_name(){
        return $this->belongsTo(\App\Models\Gamer::class, 'player2', 'id');
    }

    public function tournament(){
        return $this->belongsTo(\App\Models\Tournaments::class, 'tournament_id', 'id');
    }

    public function schedule_point()
    {
        return $this->belongsTo(\App\Models\Gamer_tournament_point::class, 'id', 'schedule_id');
    }

    public function gamer_schedule_image()
    {
        return $this->hasMany(\App\Models\Gamer_schedule_image::class, 'schedule_id', 'id');
    }
}

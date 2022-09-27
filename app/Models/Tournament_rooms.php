<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament_rooms extends Model
{
    public function get_tournament()
    {
    	return $this->belongsTo(\App\Models\Tournaments::class, 'tournament_id', 'id');
    }
}

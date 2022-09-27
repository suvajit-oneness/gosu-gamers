<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamPlayers extends Model {
    protected $table = 'team_players';
    protected $primaryKey = 'id';

    public function gamerIdByName( $play_station_name ) {
        $play_station = \DB::table( 'play_station' )->where( 'name', '=', $play_station_name )->first();
        return $play_station->id;
    }

    public function gamerNameByName( $play_station_name ) {
        $play_station = \DB::table( 'play_station' )->where( 'name', '=', $play_station_name )->first();
        $gamer_info = $this->team_playstation_details->where( 'play_station_id', '=', $play_station->id )->first();
        return !empty( $gamer_info->play_station_number ) ? $gamer_info->play_station_number : '';
    }

    public function gamerNameById( $play_station_id ) {
        $gamer_info = $this->team_playstation_details->where( 'play_station_id', '=', $play_station_id )->first();
        return !empty( $gamer_info->play_station_number ) ? $gamer_info->play_station_number : '';
    }

    public function team() {
        return $this->belongsTo( '\App\Models\Teams', 'team_id', 'id' );
    }

    public function team_playstation_details() {
        return $this->hasMany( \App\Models\TeamPlaystationDetails::class, 'team_player_id', 'id' );
    }
}

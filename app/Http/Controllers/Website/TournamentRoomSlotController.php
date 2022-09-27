<?php

namespace App\Http\Controllers\Website;


use App\Http\Controllers\Controller;

use App\Models\TournamentRoomSlot;
use Illuminate\Http\Request;
use App\Models\Tournaments;
use App\Models\Tournament_rooms;
use DB;
use Alert;

class TournamentRoomSlotController extends Controller
 {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function roomwinner( $id ) {

        $tours = TournamentRoomSlot::where( 'tournament_id', $id )
        ->select( 'gamers.id as gid', 'gamers.*', 'tournament_room_slots.*', 'gamers.fname as name' )
        ->join( 'gamers', 'gamers.id', '=', 'tournament_room_slots.gamer_id' )
        ->where ( 'tournament_room_slots.winner', '!=', 'tournament_room_slots.gamer_id' )
        ->where ( 'tournament_room_slots.point', '>', 1 )
        ->get();
        $tournament = Tournaments::where( 'tournaments.id', $id )->first();
        $noofroom = Tournament_rooms::where( 'tournament_id', $id )->count();

        $count = $tours->count();
        if ( $count == 1 ) {

            return view( 'website.tournament.tournament_rooms.winner', compact( 'tours', 'tournament' ) );
        } elseif ( $count == 0 ) {

            return $this->showroom( $id );
        }

    }

    public function showroom( $id )
        {
            $showroomplayers = TournamentRoomSlot::where( 'tournament_id', $id )
            ->select( 'tournament_room_slots.id as trsid', 'gamers.*', 'tournament_room_slots.*', 'gamers.id as gid' )
            ->join( 'gamers', 'gamers.id', '=', 'tournament_room_slots.gamer_id' )
            ->get();
            $noofroom = Tournament_rooms::where( 'tournament_id', $id )->count();
            $rooms = Tournament_rooms::where( 'tournament_id', $id )->get();
            $tournaments = Tournaments::where( 'tournaments.id', $id )->first();
            return view( 'website.tournament.tournament_rooms.showroomplayers', compact( 'showroomplayers', 'tournaments', 'noofroom', 'rooms' ) );
        }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function saveroom( Request $request )
        {

                DB::update( DB::raw( " UPDATE `tournament_room_slots` SET `point`='1',`winner`='0'where 
                `tournament_id`=$request->id
                " ) );
                $winner = $request->winner;

                DB::update( DB::raw( " UPDATE `tournament_room_slots` SET `point`='2',`winner`=$winner  where `gamer_id`=$winner  
                and `tournament_id`=$request->id" ) );
                DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `point`=`point` + 2 WHERE `user_id` =$winner  " ) );

                Alert::Html( 'Success', '<h2> Winner Selected Successfully </h2>', 'success' );
                return redirect( 'show' );
            }

            public function roomteamwinner( $id )
        {
            
                $tours = TournamentRoomSlot::where( 'tournament_id', $id )
                ->select( 'teams.id as gid', 'teams.*', 'tournament_room_slots.*', 'teams.team_name as name' )
                ->join( 'teams', 'teams.id', '=', 'tournament_room_slots.team_id' )
                ->where ( 'tournament_room_slots.winner', '!=', 'tournament_room_slots.team_id' )
                ->where ( 'tournament_room_slots.point', '>', 1 )
                ->get();
                $noofroom = Tournament_rooms::where( 'tournament_id', $id )->count();
                $tournament = Tournaments::where( 'tournaments.id', $id )->first();
                $count = $tours->count();
                if ( $count == $noofroom ) {
                    return view( 'website.tournament.tournament_rooms.winner', compact( 'tours', 'tournament' ) );
                } elseif ( $count == 0 ) {
                    return $this->showteamroom( $id );
                }
            }

            public function showteamroom( $id )
        {

            $noofroom = Tournament_rooms::where( 'tournament_id', $id )->count();
            $rooms = Tournament_rooms::where( 'tournament_id', $id )->get();
            $showroomplayers = TournamentRoomSlot::where( 'tournament_id', $id )
            ->select( 'tournament_room_slots.id as trsid', 'teams.*', 'tournament_room_slots.*', 'teams.id as gid' )
            ->join( 'teams', 'teams.id', '=', 'tournament_room_slots.team_id' )
            ->get();

            $tournaments = Tournaments::where( 'tournaments.id', $id )->first();
            return view( 'website.tournament.tournament_rooms.showroomteam', compact( 'showroomplayers', 'tournaments', 'noofroom', 'rooms' ) );
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function saveteamroom( Request $request )
    {    

        //dd( $request );
        DB::update( DB::raw( " UPDATE `tournament_room_slots` SET `point`='1',`winner`='0'where 
        `tournament_id`=$request->id
         " ) );

        $winner = $request->winner;

        for ( $i = 0; $i<count( $winner );
        $i++ ) {

            $w = $winner[$i];

            DB::update( DB::raw( " UPDATE `tournament_room_slots` SET `point`='2',`winner`='$w' where `team_id`='$w' 
                and `tournament_id`=$request->id" ) );

            DB::update( DB::raw( "UPDATE `teams_tournaments` SET `point`=`point` + 2 WHERE `team_id` = $w " ) );

        }

        Alert::Html( 'Success', '<h2> Winner has been selected Successfully </h2>', 'success' );
        return redirect( 'show' );
    }

}

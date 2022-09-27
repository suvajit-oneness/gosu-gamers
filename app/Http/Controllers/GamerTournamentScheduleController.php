<?php
namespace App\Http\Controllers;

use App\Models\Gamer_tournament_schedule;
use App\Models\Team_tournament_schedule;
use App\Models\Tournaments;
use App\Models\Gamer_tournament_point;
use App\Models\Gamers_tournaments;
use Illuminate\Http\Request;
use Alert;
use DB;

class GamerTournamentScheduleController extends Controller {

    public function index() {
        $gamertournamentschedule = DB::select( DB::raw( "select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
             g3.fname as Player3fname, g3.lname as Player3lname, g3.email as Player3email, tournaments.name as tname
           from gamer_tournament_schedules left join gamers as g1
           on (gamer_tournament_schedules.player1 = g1.id)
           left join gamers as g2
           on (gamer_tournament_schedules.player2 = g2.id) 
           left join gamers as g3
           on (gamer_tournament_schedules.winner = g3.id) 
           left join tournaments
           on (gamer_tournament_schedules.tournament_id = tournaments.id)" ) );

        return view( 'admin.gamer_tournament_schedule.index', compact( 'gamertournamentschedule' ) );
    }

    public function details( $id ) {
        $tournaments = Tournaments::find( $id );
        if ( $tournaments->user_type == 1 ) {

            $gamertournamentschedule = DB::select( DB::raw( "select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
             g3.fname as Player3fname, g3.lname as Player3lname, g3.email as Player3email, tournaments.name as tname
           from gamer_tournament_schedules left join gamers as g1
           on (gamer_tournament_schedules.player1 = g1.id)
           left join gamers as g2
           on (gamer_tournament_schedules.player2 = g2.id) 
           left join gamers as g3
           on (gamer_tournament_schedules.winner = g3.id) 
           left join tournaments
           on (gamer_tournament_schedules.tournament_id = tournaments.id)
           where gamer_tournament_schedules.tournament_id=$id" ) );
            return view( 'admin.gamer_tournament_schedule.details', compact( 'gamertournamentschedule' ) );
        } elseif ( $tournaments->user_type == 2 ) {
            $teamtournamentschedule = DB::select( DB::raw( "select team_tournament_schedules.*, t1.team_name  as Team1name, t2.team_name  as Team2name,t3.team_name as Team3name,tournaments.name as tname
           from team_tournament_schedules left join teams as t1
           on (team_tournament_schedules.team1 = t1.id)
           left join teams as t2
           on (team_tournament_schedules.team2 = t2.id) 
           left join teams as t3
           on (team_tournament_schedules.winner = t3.id) 
           left join tournaments
           on (team_tournament_schedules.tournament_id = tournaments.id)
            where team_tournament_schedules.tournament_id=$id
           " ) );

            return view( 'admin.team_tournament_schedule.details', compact( 'teamtournamentschedule' ) );
        }
    }

    public function edit( $id ) {

        $player1 = Gamer_tournament_schedule::where( 'gamer_tournament_schedules.id', $id )->select( 'tournaments.name as tname', 'tournaments.id as tid', 'gamers.id as gid', 'gamers.*', 'gamer_tournament_schedules.id as gtsid' )
        ->join( 'tournaments', 'tournaments.id', 'gamer_tournament_schedules.tournament_id' )
        ->join( 'gamers', 'gamers.id', 'gamer_tournament_schedules.player1' )
        ->get();

        $player2 = Gamer_tournament_schedule::where( 'gamer_tournament_schedules.id', $id )->select( 'tournaments.name as tname', 'tournaments.id as tid', 'gamers.id as gid', 'gamers.*', 'gamer_tournament_schedules.id as gtsid' )
        ->join( 'tournaments', 'tournaments.id', 'gamer_tournament_schedules.tournament_id' )
        ->join( 'gamers', 'gamers.id', 'gamer_tournament_schedules.player2' )
        ->get();

        return view( 'admin.gamer_tournament_schedule.edit', compact( 'player2', 'player1' ) );
    }

    public function update1( Request $request ) {

        $gamertournamentschedule = Gamer_tournament_schedule::find( $request->id );
        $gamertournamentschedule->winner = $request->winner;
        if($request->final_winner == 1){
            $gamertournamentschedule->final_winner = $request->winner;
        }
        $gamertournamentschedule->runner = $request->runner;
        $gamertournamentschedule->winner_point = $request->winner_point;
        $gamertournamentschedule->runner_point = $request->runner_point;

        $valid_images = array(
            'png',
            'jpg',
            'jpeg',
            'gif'
        );

        if ( $request->hasFile( 'winner_image' ) && in_array( $request
        ->winner_image
        ->extension(), $valid_images ) ) {

            $profile_image = $request->winner_image;
            $imageName = time() . '.' . $profile_image->getClientOriginalName();
            $profile_image->move( 'new-theme/images/winner/', $imageName );
            $uploadedImage = 'new-theme/images/winner/' . $imageName;
            $gamertournamentschedule->winner_image = $uploadedImage;
        }
        if ( $request->hasFile( 'runner_image' ) && in_array( $request
        ->runner_image
        ->extension(), $valid_images ) ) {

            $profile_image = $request->runner_image;
            $imageName = time() . '.' . $profile_image->getClientOriginalName();
            $profile_image->move( 'new-theme/images/runner/', $imageName );
            $uploadedImage = 'new-theme/images/runner/' . $imageName;
            $gamertournamentschedule->runner_image = $uploadedImage;
        }

        $gamertournamentschedule->save();

        DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `point`=`point` + 2 WHERE `user_id` =$request->winner " ) );

        $points = Gamer_tournament_schedule::find( $request->id );
        if ( $points->player1 == $points->winner ) {
            $player1_point = $points->winner_point;
        } else {
            $player1_point = $points->runner_point;
        }

        if ( $points->player2 == $points->winner ) {
            $player2_point = $points->winner_point;
        } else {
            $player2_point = $points->runner_point;
        }
        $pointcheck = Gamer_tournament_point::where( 'schedule_id', $request->id )
        ->first();

        if ( $pointcheck ) {
            $pointupdate = Gamer_tournament_point::where( 'schedule_id', $request->id )
            ->first();

            $pointupdate->schedule_id = $request->id;
            $pointupdate->player1_score = $request->player1_score ? $request->player1_score : 0;
            $pointupdate->player2_score = ( isset( $request->player2_score ) && $request->player2_score != '' ) ? $request->player2_score : 0;
            $pointupdate->player1_point = $player1_point;
            $pointupdate->player2_point = $player2_point;
            $pointupdate->winner = $request->winner;
            $pointupdate->save();
        } else {
            $pointupdate = new Gamer_tournament_point;
            $pointupdate->schedule_id = $request->id;
            $pointupdate->player1_score = $request->player1_score ? $request->player1_score : 0;
            $pointupdate->player2_score = ( isset( $request->player2_score ) && $request->player2_score != '' ) ? $request->player2_score : 0;
            $pointupdate->player1_point = $player1_point;
            $pointupdate->player2_point = $player2_point;
            $pointupdate->winner = $request->winner;
            $pointupdate->save();
        }
        Alert::Html( 'Success', '<h2> Gamer Tournament Schedule Updated Successfully </h2>', 'success' );
        $tournament_id = $gamertournamentschedule->tournament_id;
        $laststage = Gamer_tournament_schedule::where( 'tournament_id', $tournament_id )->orderBy( 'stage', 'DESC' )
        ->first();
        $stage = Gamer_tournament_schedule::where( 'tournament_id', $tournament_id )->where( 'stage', $laststage->stage )
        ->count();
        $winnercount = Gamer_tournament_schedule::where( 'tournament_id', $tournament_id )->where( 'stage', $laststage->stage )
        ->where( 'winner', '!=', '0' )
        ->count();
        $id = $tournament_id;
        if ( $stage == $winnercount ) {
            return $this->tournamentschedulesingle( $id );
        }
        return redirect( 'gamertournamentschedule-details/' . $request->tournament_id );
    }

    public function addSchedule( $id ) {

        $tournament = Tournaments::find( $id );
        $stage = Gamer_tournament_schedule::where( 'tournament_id', $id )->orderBy( 'stage', 'desc' )
        ->first();

        $tours = Gamer_tournament_schedule::where( 'tournament_id', $id )->select( 'gamers.id as gamer_id', 'gamers.fname as fname', 'gamers.lname as lname', 'gamer_tournament_schedules.*' )
        ->join( 'gamers', 'gamers.id', 'gamer_tournament_schedules.winner' )
        ->where( 'gamer_tournament_schedules.stage', $stage->stage )
        ->get();

        $count = $tours->count();
        if ( $count == 1 ) {

            return view( 'admin.gamer_tournament_schedule.winner', compact( 'tours', 'tournament' ) );
        } elseif ( $count == 0 ) {
            return redirect( 'gamertournamentschedule-details/' . $id );
        } else {
            return view( 'admin.gamer_tournament_schedule.add_schedule', compact( 'count', 'tours', 'tournament' ) );
        }
    }

    public function tournamentschedule( Request $request ) {

        $player1 = $request['player1'];
        $player2 = $request['player2'];
        $totalplayer = '';
        $totalplayers = array();
        $count = count( $player1 );
        for ( $i = 0; $i < $count; $i++ ) {
            if ( $request->player1[$i] == null ) {
                return redirect( 'tournaments' );
            }
            $p1 = ( isset( $request->player1[$i] ) && $request->player1[$i] != '' ) ? $request->player1[$i] : 0;
            $p2 = ( isset( $request->player2[$i] ) && $request->player2[$i] != '' ) ? $request->player2[$i] : 0;
            if ( $p1 != 0 ) {
                array_push( $totalplayers, $p1 );
            }
            if ( $p2 != 0 ) {
                array_push( $totalplayers, $p2 );
            }
            $totalplayer = implode( ',', $totalplayers );
            $gamertournamentschedule = new Gamer_tournament_schedule;
            $gamertournamentschedule->tournament_id = $request->tournament_id;
            $gamertournamentschedule->player1 = $p1;
            $gamertournamentschedule->player2 = $p2;
            $gamertournamentschedule->start_time = $request->start_time;
            $gamertournamentschedule->end_time = $request->end_time;
            $gamertournamentschedule->start_date = $request->start_date;
            $gamertournamentschedule->end_date = $request->end_date;
            $gamertournamentschedule->stage = $request->stage;
            $gamertournamentschedule->save();
        }

        DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `point`=`point` + 1 WHERE  user_id in ($totalplayer)" ) );

        return redirect( 'tournaments' );
    }

    public function tournamentschedulesinglego( $id ) {
        $tournament = Tournaments::find( $id );
        $maxplayer = $tournament->max_players;
        $count = $maxplayer / 2;
        $stage = Gamer_tournament_schedule::where( 'tournament_id', $id )->where( 'stage', '1' )
        ->get();
        $playerscount = Gamer_tournament_schedule::Where( 'player2', '0' )->where( 'tournament_id', $id )->count();

        if ( $stage->count() == $count ) {
            if ( $playerscount > 0 ) {
                return $this->player2update( $id );
            }
            return redirect()->back();
        }
        $tour = Tournaments::with( 'Tournament_rooms' )->where( 'id', '=', $id )->first();
        $roomname = $tour
        ->Tournament_rooms->room_code;
        $gamerstournaments = Gamers_tournaments::where( 'is_deleted', 0 )->select( 'gamers_tournaments.*' )
        ->where( 'room_code', '0' )
        ->where( 'tournament_id', $id )->orderBy( 'gamers_tournaments.id', 'ASC' )
        ->get();
        if ( count( $gamerstournaments )< $count ) {
            $count = count( $gamerstournaments );
        }

        for ( $i = 0; $i < $count; $i++ ) {

            $p1 = ( isset( $gamerstournaments[$i]->user_id ) && $gamerstournaments[$i]->user_id != '' ) ? $gamerstournaments[$i]->user_id : 0;
            DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `point`=`point` + 1, `room_code`='$roomname' WHERE  `user_id` = $p1" ) );
            $gamertournamentschedule = new Gamer_tournament_schedule;
            $gamertournamentschedule->tournament_id = $id;
            $gamertournamentschedule->player1 = $p1;
            $gamertournamentschedule->stage = 1;
            $gamertournamentschedule->start_time = $tournament->start_time;
            $gamertournamentschedule->end_time = $tournament->end_time;
            $gamertournamentschedule->start_date = $tournament->start_date;
            $gamertournamentschedule->end_date = $tournament->end_date;
            $gamertournamentschedule->save();

        }

        return $this->player2update( $id );
    }

    public function player2update( $id ) {

        $tour = Tournaments::with( 'Tournament_rooms' )->where( 'id', '=', $id )->first();
        $roomname = $tour
        ->Tournament_rooms->room_code;
        $gamerstournaments = Gamers_tournaments::where( 'is_deleted', 0 )->select( 'gamers_tournaments.*' )
        ->where( 'room_code', '0' )
        ->where( 'tournament_id', $id )->get();
        $leftgamercount = count( $gamerstournaments );
        for ( $i = 0; $i < $leftgamercount; $i++ ) {
            $p2 = $gamerstournaments[$i]->user_id;
            $gamertournamentschedule = Gamer_tournament_schedule::Where( 'player2', '0' )->where( 'tournament_id', $id )->orderBy( 'id', 'ASC' )
            ->first();
            $gamertournamentschedule->player2 = $p2;
            $gamertournamentschedule->save();
            DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `point`=`point` + 1,`room_code`='$roomname' WHERE  user_id = $p2" ) );

        }
        return redirect( 'tournaments' );

    }

    public function tournamentschedulesingle( $id ) {

        $tournament = Tournaments::find( $id );

        $stage = Gamer_tournament_schedule::where( 'tournament_id', $id )->orderBy( 'stage', 'desc' )
        ->first();

        $tours = Gamer_tournament_schedule::where( 'tournament_id', $id )->select( 'gamers.id as gamer_id' )
        ->leftjoin( 'gamers', 'gamers.id', 'gamer_tournament_schedules.winner' )
        ->where( 'gamer_tournament_schedules.stage', $stage->stage )
        ->get();
        if ( count( $tours ) == 1 ) {
            return redirect( 'tournaments' );
        }
        $totalplayer = $tours->implode( 'gamer_id', ', ' );
        $count = count( $tours );
        for ( $i = 0; $i < $count; $i += 2 ) {

            $p1 = $tours[$i]->gamer_id;
            $p2 = $tours[$i + 1]->gamer_id ?? '0';

            $gamertournamentschedule = new Gamer_tournament_schedule;
            $gamertournamentschedule->tournament_id = $id;
            $gamertournamentschedule->player1 = $p1;
            $gamertournamentschedule->player2 = $p2;
            $gamertournamentschedule->start_time = $tournament->start_time;
            $gamertournamentschedule->end_time = $tournament->end_time;
            $gamertournamentschedule->start_date = $tournament->start_date;
            $gamertournamentschedule->end_date = $tournament->end_date;
            $gamertournamentschedule->stage = $stage->stage + 1;
            $gamertournamentschedule->save();
        }

        DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `point`=`point` + 1 WHERE  user_id in ($totalplayer)" ) );

        return redirect( 'tournaments' );
    }


    public function deleteFixture($id, $stage){
        // echo "welcome"; 
        $fixtureData = Team_tournament_schedule::where('tournament_id', $id)->where('stage', $stage)->get();
        foreach($fixtureData as $key => $data){
            Team_tournament_schedule::find($data->id)->delete();
        }
        return redirect( 'tournament_user_list/' . $id );
    }
}


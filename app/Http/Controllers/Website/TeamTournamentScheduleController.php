<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Tournaments;
use App\Models\Team_tournament_schedule;
use App\Models\Team_tournament_point;
use App\Models\Teams_tournament;
use Illuminate\Http\Request;
use Auth;
use Alert;
use DB;

class TeamTournamentScheduleController extends Controller {

    public function index() {
        $teamtournamentschedule = DB::select( DB::raw( "select team_tournament_schedules.*, t1.team_name  as Team1name, t2.team_name  as Team2name,t3.team_name as Team3name,tournaments.name as tname
           from team_tournament_schedules left join teams as t1
           on (team_tournament_schedules.team1 = t1.id)
           left join teams as t2
           on (team_tournament_schedules.team2 = t2.id) 
           left join teams as t3
           on (team_tournament_schedules.winner = t3.id) 
           left join tournaments
           on (team_tournament_schedules.tournament_id = tournaments.id)" ) );

        return view( 'website.tournament.team_tournament_schedule.index', compact( 'teamtournamentschedule' ) );
    }

    public function create() {
        $tournaments = Tournaments::all();
        return view( 'website.tournament.team_tournament_schedule.create', compact( 'tournaments' ) );
    }

    public function show( $id ) {

        $teamtournamentschedule = Team_tournament_schedule::find( $id );
        return view( 'website.tournament.team_tournament_schedule.show', compact( 'teamtournamentschedule' ) );
    }

    public function edit( $id ) {
        $team1 = Team_tournament_schedule::where( 'team_tournament_schedules.id', $id )->select( 'tournaments.name as tname', 'tournaments.id as tid', 'teams.id as gid', 'teams.*', 'team_tournament_schedules.id as gtsid' )
        ->join( 'tournaments', 'tournaments.id', 'team_tournament_schedules.tournament_id' )
        ->join( 'teams', 'teams.id', 'team_tournament_schedules.team1' )
        ->get();

        $team2 = Team_tournament_schedule::where( 'team_tournament_schedules.id', $id )->select( 'tournaments.name as tname', 'tournaments.id as tid', 'teams.id as gid', 'teams.*', 'team_tournament_schedules.id as gtsid' )
        ->join( 'tournaments', 'tournaments.id', 'team_tournament_schedules.tournament_id' )
        ->join( 'teams', 'teams.id', 'team_tournament_schedules.team2' )
        ->get();

        return view( 'website.tournament.team_tournament_schedule.edit', compact( 'team1', 'team2' ) );
    }

    public function update1( Request $request ) {

        $teamtournamentschedule = Team_tournament_schedule::find( $request->id );
        $teamtournamentschedule->tournament_id = $request->tournament_id;
        $teamtournamentschedule->winner = $request->winner;
        $teamtournamentschedule->runner = $request->runner;
        $teamtournamentschedule->winner_point = $request->winner_point;
        $teamtournamentschedule->runner_point = $request->runner_point;
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
            $teamtournamentschedule->winner_image = $uploadedImage;
        }
        if ( $request->hasFile( 'runner_image' ) && in_array( $request
        ->runner_image
        ->extension(), $valid_images ) ) {

            $profile_image = $request->runner_image;
            $imageName = time() . '.' . $profile_image->getClientOriginalName();
            $profile_image->move( 'new-theme/images/runner/', $imageName );
            $uploadedImage = 'new-theme/images/runner/' . $imageName;
            $teamtournamentschedule->runner_image = $uploadedImage;
        }
        $teamtournamentschedule->save();
        DB::update( DB::raw( "UPDATE `teams_tournaments` SET `point`=`point` + 2 WHERE `team_id` =$request->winner " ) );

        $points = Team_tournament_schedule::find( $request->id );
        if ( $points->team1 == $points->winner ) {
            $team1_point = $points->winner_point;
        } else {
            $team1_point = $points->runner_point;
        }
        if ( $points->team2 == $points->winner ) {
            $team2_point = $points->winner_point;
        } else {
            $team2_point = $points->runner_point;
        }
        $pointcheck = Team_tournament_point::where( 'team_schedule_id', $request->id )
        ->first();

        if ( $pointcheck ) {
            $pointupdate = Team_tournament_point::where( 'team_schedule_id', $request->id )
            ->first();

            $pointupdate->team_schedule_id = $request->id;
            $pointupdate->team1_score = $request->team1_score;
            $pointupdate->team2_score = $request->team2_score;
            $pointupdate->team1_point = $team1_point;
            $pointupdate->team2_point = $team2_point;
            $pointupdate->winner = $request->winner;
            $pointupdate->save();
        } else {
            $pointupdate = new Team_tournament_point;
            $pointupdate->team_schedule_id = $request->id;
            $pointupdate->team1_score = $request->team1_score;
            $pointupdate->team2_score = $request->team2_score;
            $pointupdate->team1_point = $team1_point;
            $pointupdate->team2_point = $team2_point;
            $pointupdate->winner = $request->winner;
            $pointupdate->save();
        }
        Alert::Html( 'Success', '<h2> Team Tournament Schedule Updated Successfully </h2>', 'success' );

        $tournament_id = $teamtournamentschedule->tournament_id;
        $laststage = Team_tournament_schedule::where( 'tournament_id', $tournament_id )->orderBy( 'stage', 'DESC' )
        ->first();
        $stage = Team_tournament_schedule::where( 'tournament_id', $tournament_id )->where( 'stage', $laststage->stage )
        ->count();
        $winnercount = Team_tournament_schedule::where( 'tournament_id', $tournament_id )->where( 'stage', $laststage->stage )
        ->where( 'winner', '!=', '0' )
        ->count();
        $id = $tournament_id;
        if ( $stage == $winnercount ) {
            return $this->tournamentschedulesingle( $id );
        }
        return redirect( '/gamer/tournaments/schedule-details/' . $request->tournament_id );
    }

    public function add_teamschedule( $id ) {
        $tournament = Tournaments::where( 'id', $id )->first();
        $stage = Team_tournament_schedule::where( 'tournament_id', $id )->orderBy( 'stage', 'desc' )
        ->take( 1 )
        ->get();
        $tours = Team_tournament_schedule::where( 'tournament_id', $id )->select( 'teams.id as team_id', 'teams.team_name as teamname', 'team_tournament_schedules.*' )
        ->join( 'teams', 'teams.id', 'team_tournament_schedules.winner' )
        ->where( 'team_tournament_schedules.stage', $stage[0]->stage )
        ->get();
        $count = $tours->count();
        if ( $count == 1 ) {

            return view( 'website.tournament.team_tournament_schedule.winner', compact( 'tours', 'tournament' ) );
        } elseif ( $count == 0 ) {
            return redirect( '/gamer/tournaments/schedule-details/' . $id );
        } else {
            return view( 'website.tournament.team_tournament_schedule.add_schedule', compact( 'count', 'tours', 'tournament' ) );
        }
    }

    public function tournamentschedule( Request $request ) {
    
        $user_id = $request['user_id'];
        $player1 = $request['player1'];
        $player2 = $request['player2'];
        $totalplayer = '';
        $totalplayers = array();
        $count = count( $player1 );
        for ( $i = 0; $i < $count; $i++ ) {
            if ( $request->player1[$i] == null ) {
                return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
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
            $Team_tournament_schedule = new Team_tournament_schedule;
            $Team_tournament_schedule->tournament_id = $request->tournament_id;
            $Team_tournament_schedule->team1 = $request->player1[$i];
            $Team_tournament_schedule->team2 = $request->player2[$i];
            $Team_tournament_schedule->start_time = $request->start_time;
            $Team_tournament_schedule->end_time = $request->end_time;
            $Team_tournament_schedule->start_date = $request->start_date;
            $Team_tournament_schedule->end_date = $request->end_date;
            $Team_tournament_schedule->stage = $request->stage;
            $Team_tournament_schedule->save();
        }
        DB::update( DB::raw( "UPDATE `teams_tournaments` SET `point`=`point` + 1 WHERE  team_id in ($totalplayer) " ) );
        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
    }

    public function tournamentschedulesinglego( $id ) {
        $tournament = Tournaments::find( $id );

        $maxplayer = $tournament->max_players;
        $count = $maxplayer / 2;
        $stage = Team_tournament_schedule::where( 'tournament_id', $id )->where( 'stage', '1' )
        ->get();
        $playerscount = Team_tournament_schedule::Where( 'team2', '0' )->where( 'tournament_id', $id )->count();

        if ( $stage->count() == $count ) {
            if ( $playerscount > 0 ) {
                return $this->player2update( $id );
            }
            return redirect()->back();
        }
        $tour = Tournaments::with( 'Tournament_rooms' )->where( 'id', '=', $id )->first();
        $roomname = $tour
        ->Tournament_rooms->room_code;
        $teamstournaments = Teams_tournament::where( 'is_deleted', 0 )->select( 'teams_tournaments.*' )
        ->where( 'room_code', '0' )
        ->where( 'tournament_id', $id )->orderBy( 'teams_tournaments.id', 'ASC' )
        ->get();

        for ( $i = 0; $i < $count; $i++ ) {

            $p1 = ( isset( $teamstournaments[$i]->team_id ) && $teamstournaments[$i]->team_id != '' ) ? $teamstournaments[$i]->team_id : 0;

            $teamstournamentsschedule = new Team_tournament_schedule;
            $teamstournamentsschedule->tournament_id = $id;
            $teamstournamentsschedule->team1 = $p1;
            $teamstournamentsschedule->stage = 1;
            $teamstournamentsschedule->start_time = $tournament->start_time;
            $teamstournamentsschedule->end_time = $tournament->end_time;
            $teamstournamentsschedule->start_date = $tournament->start_date;
            $teamstournamentsschedule->end_date = $tournament->end_date;
            $teamstournamentsschedule->save();
            DB::update( DB::raw( "UPDATE `teams_tournaments` SET `point`=`point` + 1, `room_code`='$roomname' WHERE  `team_id` = $p1" ) );
        }

        return $this->player2update( $id );
    }

    public function player2update( $id ) {

        $tour = Tournaments::with( 'Tournament_rooms' )->where( 'id', '=', $id )->first();
        $roomname = $tour
        ->Tournament_rooms->room_code;
        $teamstournaments = Teams_tournament::where( 'is_deleted', 0 )->select( 'teams_tournaments.*' )
        ->where( 'room_code', '0' )
        ->where( 'tournament_id', $id )->get();

        $leftgamercount = count( $teamstournaments );
        for ( $i = 0; $i < $leftgamercount; $i++ ) {
            $p2 = $teamstournaments[$i]->team_id;
            $teamstournamentsschedule = Team_tournament_schedule::Where( 'team2', '0' )->where( 'tournament_id', $id )->orderBy( 'id', 'ASC' )
            ->first();
            $teamstournamentsschedule->team2 = $p2;
            $teamstournamentsschedule->save();
            DB::update( DB::raw( "UPDATE `teams_tournaments` SET `point`=`point` + 1,`room_code`='$roomname' WHERE  team_id = $p2" ) );

        }
        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);

    }

    public function tournamentschedulesingle( $id ) {

        $tournament = Tournaments::find( $id );

        $stage = Team_tournament_schedule::where( 'tournament_id', $id )->orderBy( 'stage', 'desc' )
        ->first();

        $tours = Team_tournament_schedule::where( 'tournament_id', $id )->select( 'teams.id as team_id' )
        ->leftjoin( 'teams', 'teams.id', 'team_tournament_schedules.winner' )
        ->where( 'team_tournament_schedules.stage', $stage->stage )
        ->get();

        if ( count( $tours ) == 1 ) {
            return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
        }
        $totalplayer = $tours->implode( 'team_id', ', ' );
        $count = count( $tours );
        for ( $i = 0; $i < $count; $i += 2 ) {
            $p1 = $tours[$i]->team_id;
            $p2 = $tours[$i + 1]->team_id ?? '0';

            $gamertournamentschedule = new Team_tournament_schedule;
            $gamertournamentschedule->tournament_id = $id;
            $gamertournamentschedule->team1 = $p1;
            $gamertournamentschedule->team2 = $p2;
            $gamertournamentschedule->start_time = $tournament->start_time;
            $gamertournamentschedule->end_time = $tournament->end_time;
            $gamertournamentschedule->start_date = $tournament->start_date;
            $gamertournamentschedule->end_date = $tournament->end_date;
            $gamertournamentschedule->stage = $stage->stage + 1;
            $gamertournamentschedule->save();
        }

        DB::update( DB::raw( "UPDATE `teams_tournaments` SET `point`=`point` + 1 WHERE  `team_id` in ($totalplayer)" ) );

        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
    }

}


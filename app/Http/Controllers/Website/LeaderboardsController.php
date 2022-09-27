<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use App\Models\Game;
Use App\Models\Tournaments;
Use Auth;

class LeaderboardsController extends Controller
 {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $games = Game::where( 'is_active', 1 )->where( 'is_deleted', 0 )->get();
        $leaderboard = DB::table( 'gamers_tournaments' )
        ->select( 'gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name', DB::raw( 'SUM(gamers_tournaments.point) as user_point' ) )
        ->join( 'tournaments', 'gamers_tournaments.tournament_id', '=', 'tournaments.id' )
        ->join( 'games', 'games.id', '=', 'tournaments.game_id' )
        ->join( 'gamers', 'gamers.id', '=', 'gamers_tournaments.user_id' )
        ->join( 'countries', 'countries.id', '=', 'gamers.country_id' )
        ->where( 'tournaments.status', '=', '1' )
        ->groupBy( 'gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name' )
        ->orderBy( 'user_point', 'desc' )
        ->get()
        ->toArray();
        $today = date( 'Y-m-d' );
        $upcoming_tournaments = DB::table( 'tournaments' )
        ->join( 'games', 'tournaments.game_id', '=', 'games.id' )
        ->select( 'tournaments.*', 'games.name as game_name' )
        ->where( 'tournaments.is_active', 1 )
        ->where( 'tournaments.is_deleted', 0 )
        ->where( 'tournaments.start_date', '>', $today )
        ->get();
        $game_name = 'All Games';

        return view ( 'website.leadboard.index', compact( 'leaderboard', 'upcoming_tournaments', 'games', 'game_name' ) );
    }

    public function game_wise_leaderboard( $game_id, $url ) {
        $games = Game::where( 'is_active', 1 )->where( 'is_deleted', 0 )->get();
        $games1 = Game::where( 'is_active', 1 )->where( 'is_deleted', 0 )->where( 'id', $game_id )->get();
        $game_name = $games1[0]->name;
        $leaderboard = DB::table( 'gamers_tournaments' )
        ->select( 'gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name', DB::raw( 'SUM(gamers_tournaments.point) as user_point' ) )
        ->join( 'tournaments', 'gamers_tournaments.tournament_id', '=', 'tournaments.id' )
        ->join( 'games', 'games.id', '=', 'tournaments.game_id' )
        ->join( 'gamers', 'gamers.id', '=', 'gamers_tournaments.user_id' )
        ->join( 'countries', 'countries.id', '=', 'gamers.country_id' )
        ->where( 'tournaments.status', '=', '1' )
        ->where( 'tournaments.game_id', '=', $game_id )
        ->groupBy( 'gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name' )
        ->orderBy( 'user_point', 'desc' )
        ->get()
        ->toArray();
        $today = date( 'Y-m-d' );
        $upcoming_tournaments = DB::table( 'tournaments' )
        ->join( 'games', 'tournaments.game_id', '=', 'games.id' )
        ->select( 'tournaments.*', 'games.name as game_name' )
        ->where( 'tournaments.is_active', 1 )
        ->where( 'tournaments.is_deleted', 0 )
        ->where( 'tournaments.start_date', '>', $today )
        ->get();

        return view ( 'website.leadboard.index', compact( 'leaderboard', 'upcoming_tournaments', 'games', 'game_name' ) );
    }

    public function mytransactions( $id ) {

        $games = Game::where( 'is_active', 1 )->where( 'is_deleted', 0 )->get();
        $gamers = DB::table( 'gamer_tournament_payments' )->select( 'tournaments.name as tournaments', 'tournaments.part_amount as amount', 'currencies.currency_name as cname', 'gamers.*', 'gamer_tournament_payments.*', DB::raw( "CONCAT(gamers.fname,' ',gamers.lname) as name" ) )
        ->leftjoin( 'tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id' )
        ->leftjoin( 'gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id' )
        ->leftjoin( 'currencies', 'tournaments.part_currency', '=', 'currencies.id' )
        ->where( 'gamers.id', $id );
        $teams = DB::table( 'team_tournament_payments' )->select( 'tournaments.name as tournaments', 'tournaments.part_amount as amount', 'currencies.currency_name as cname', 'gamers.*', 'team_tournament_payments.*', 'teams.team_name as name' )
        ->leftjoin( 'tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id' )
        ->leftjoin( 'teams', 'team_tournament_payments.team_id', '=', 'teams.id' )
        ->leftjoin( 'gamers', 'teams.gamer_id', '=', 'gamers.id' )
        ->leftjoin( 'currencies', 'tournaments.part_currency', '=', 'currencies.id' )
        ->where( 'gamers.id', $id )
        ->union( $gamers )->get();
        $today = date( 'Y-m-d' );
        $upcoming_tournaments = DB::table( 'tournaments' )
        ->join( 'games', 'tournaments.game_id', '=', 'games.id' )
        ->select( 'tournaments.*', 'games.name as game_name' )
        ->where( 'tournaments.is_active', 1 )
        ->where( 'tournaments.is_deleted', 0 )
        ->where( 'tournaments.start_date', '>', $today )
        ->get();
        $game_name = 'All Games';

        return view ( 'website.leadboard.transactions', compact( 'teams', 'upcoming_tournaments', 'games', 'game_name' ) );

    }

    public function tournamentwon( $id ) {


        //dd( $id );
//        $team_id = Auth::guard( 'gamer' )->user()->team->id;
//        $team_id = $team_id ??'0';
        //dd( $team_id );

        // patch by Nir
        $team_id = Auth::guard( 'gamer' )->user()->team->id ?? 0;



        $tournamentDatas = Tournaments::select( 'id' )->where( 'is_active', 1 )->where( 'is_deleted', 0 )->where( 'stop_joining', 1 )->orderby( 'id', 'desc' )->get();
        $tournament_id = DB::table( 'gamer_tournament_schedules' )->orderBy( 'stage', 'desc' )->get();
        $tournament_id = $tournament_id->unique( 'tournament_id' )->values()->all();
        foreach ( $tournament_id as $tid ) {
            $tournament_ids[] = $tid->id;
        }
        $tournament_ids = implode( ',', $tournament_ids );
        $winner1 = DB::select( DB::raw( "select gamers.*,tournaments.* from gamer_tournament_schedules left join gamers on(gamer_tournament_schedules.winner = gamers.id) left join tournaments on(gamer_tournament_schedules.tournament_id = tournaments.id) where gamer_tournament_schedules.id in ($tournament_ids) and gamer_tournament_schedules.winner = $id " ) );
        $tournament_team = DB::table( 'team_tournament_schedules' )->orderBy( 'stage', 'desc' )->get();

        $tournament_team = $tournament_team->unique( 'tournament_id' )->values()->all();
        foreach ( $tournament_team as $tid ) {
            $tournament_teams[] = $tid->id;
        }
        // $tournament_teams = implode( ',', $tournament_teams );
        // $winner2 = DB::select( DB::raw( "select gamers.*,tournaments.* from team_tournament_schedules left join teams on(team_tournament_schedules.winner = teams.id) left join gamers on(teams.gamer_id = gamers.id) left join tournaments on(team_tournament_schedules.tournament_id = tournaments.id) where team_tournament_schedules.id in ($tournament_teams) and team_tournament_schedules.winner = $team_id " ) );
        // $winner3 = DB::select( DB::raw( "select gamers.*,tournaments.* from gamer_positions left join teams on(gamer_positions.team_id = teams.id) left join gamers on(teams.gamer_id = gamers.id) left join tournaments on(gamer_positions.tournament_id = tournaments.id) where position = 1  and team_id = $team_id " ) );
        // $winner4 = DB::select( DB::raw( "select gamers.*,tournaments.*,gamer_positions.* from gamer_positions left join gamers on(gamer_positions.gamer_id = gamers.id) left join tournaments on(gamer_positions.tournament_id = tournaments.id) where position = 1 and gamer_id = $id " ) );

        // $winner = array_merge( $winner1, $winner2, $winner3, $winner4 );
        //dd( $winner );
        return view ( 'website.leadboard.tournamentwon' );

    }
}
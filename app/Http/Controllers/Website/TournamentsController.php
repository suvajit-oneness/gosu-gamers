<?php

namespace App\Http\Controllers\Website;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tournaments;
Use App\Models\Game;
Use App\Models\TournamentChat;
Use App\Models\Gamer;
use App\Models\Gamer_tournament_point;
use App\Models\TournamentRoomSlot;
use App\Models\Gamer_tournament_schedule;
use App\Models\Team_tournament_schedule;
use App\Models\Tournament_rooms;
use App\Models\Gamers_tournaments;
use App\Models\Teams_tournament;
use App\Models\Region;
use App\Models\Country;
use Validator;
use DB;
use Alert;
use Auth;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = (isset($_GET['date']) && $_GET['date'] != '') ? $_GET['date'] : date("Y-m-d");
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';
        $state_date = $request['date']?? "";
        $game = $request['game']?? "";
        if ($state_date != "" || $game != "") {
            $tournaments = array();
            $tournamentDatas = Tournaments::where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('partner', "Gosu")
            ->where('start_date', 'LIKE', "%$state_date%")
            ->where('gamer_id', NULL)
            ->orWhere('game_id', $game)
            ->orderby('start_date', 'ASC')
            ->get();

            foreach ($tournamentDatas as $tournament) {
                $tournament_id = $tournament->id;
                $tournament_type = $tournament->user_type;
    
                if ($tournament_type == '1') {
                    $gamerplayerjoined = DB::select(DB::raw("SELECT COUNT(*)as count FROM `gamers_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($gamerplayerjoined) > 0) {
                        $tournament->player_joined = $gamerplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                } else {
                    $teamsplayerjoined = DB::select(DB::raw("SELECT COUNT(*) as count FROM `teams_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($teamsplayerjoined) > 0) {
                        $tournament->player_joined = $teamsplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                }
                array_push($tournaments, $tournament);
            }
        } else {
            $tournaments = array();
            if ($game_id != '') {
            //            $tournamentDatas = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->where('game_id', $game_id)->orderby('id', 'desc')->get();
                $tournamentDatas = Tournaments::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('partner', "Gosu")
                    ->where('reg_start_date', '<=', $date)
                    ->where('gamer_id', NULL)
                    ->where('end_date', '>=', $date)
                    ->where('game_id', $game_id)
                    // ->orderby('id', 'desc')
                    ->orderby('start_date', 'ASC')
                    ->get();
    
                // echo "query : ".$tournamentDatas->toSql();
                // die("xyz");
            } else {
                //            $tournamentDatas = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->orderby('id', 'desc')->get();
                $tournamentDatas = Tournaments::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('partner', "Gosu")
                    ->where('reg_start_date', '<=', $date)
                    ->where('gamer_id', NULL)
                    ->where('end_date', '>=', $date)
                    ->orderby('start_date', 'ASC')
                    ->get();
            }
    
            foreach ($tournamentDatas as $tournament) {
                $tournament_id = $tournament->id;
                $tournament_type = $tournament->user_type;
    
                if ($tournament_type == '1') {
                    $gamerplayerjoined = DB::select(DB::raw("SELECT COUNT(*)as count FROM `gamers_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($gamerplayerjoined) > 0) {
                        $tournament->player_joined = $gamerplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                } else {
                    $teamsplayerjoined = DB::select(DB::raw("SELECT COUNT(*) as count FROM `teams_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($teamsplayerjoined) > 0) {
                        $tournament->player_joined = $teamsplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                }
                array_push($tournaments, $tournament);
            }
        }
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.tournament.index', compact('tournaments', 'games'));
    }

    public function user_created_tournaments(){
        $date = (isset($_GET['date']) && $_GET['date'] != '') ? $_GET['date'] : date("Y-m-d");
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';
        $state_date = $request['date']?? "";
        $game = $request['game']?? "";
        
        if ($state_date != "" || $game != "") {
            $tournaments = array();
            $tournamentDatas = Tournaments::where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('partner', "Gosu")
            ->whereNotNull('gamer_id')
            ->where('start_date', 'LIKE', "%$state_date%")
            ->orWhere('game_id', $game)
            ->orderby('start_date', 'ASC')
            ->get();

            foreach ($tournamentDatas as $tournament) {
                $tournament_id = $tournament->id;
                $tournament_type = $tournament->user_type;
    
                if ($tournament_type == '1') {
                    $gamerplayerjoined = DB::select(DB::raw("SELECT COUNT(*)as count FROM `gamers_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($gamerplayerjoined) > 0) {
                        $tournament->player_joined = $gamerplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                } else {
                    $teamsplayerjoined = DB::select(DB::raw("SELECT COUNT(*) as count FROM `teams_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($teamsplayerjoined) > 0) {
                        $tournament->player_joined = $teamsplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                }
                array_push($tournaments, $tournament);
            }
        } else {
            $tournaments = array();
            if ($game_id != '') {
            //            $tournamentDatas = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->where('game_id', $game_id)->orderby('id', 'desc')->get();
                $tournamentDatas = Tournaments::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('partner', "Gosu")
                    ->whereNotNull('gamer_id')
                    ->where('reg_start_date', '<=', $date)
                    ->where('end_date', '>=', $date)
                    ->where('game_id', $game_id)
                    // ->orderby('id', 'desc')
                    ->orderby('start_date', 'ASC')
                    ->get();
            } else {
                $tournamentDatas = Tournaments::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('partner', "Gosu")
                    ->whereNotNull('gamer_id')
                    ->where('reg_start_date', '<=', $date)
                    ->where('end_date', '>=', $date)
                    ->orderby('start_date', 'ASC')
                    ->get();
            }
    
            foreach ($tournamentDatas as $tournament) {
                $tournament_id = $tournament->id;
                $tournament_type = $tournament->user_type;
    
                if ($tournament_type == '1') {
                    $gamerplayerjoined = DB::select(DB::raw("SELECT COUNT(*)as count FROM `gamers_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($gamerplayerjoined) > 0) {
                        $tournament->player_joined = $gamerplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                } else {
                    $teamsplayerjoined = DB::select(DB::raw("SELECT COUNT(*) as count FROM `teams_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));
    
                    if (count($teamsplayerjoined) > 0) {
                        $tournament->player_joined = $teamsplayerjoined[0]->count;
                    } else {
                        $tournament->player_joined = 0;
                    }
                }
                array_push($tournaments, $tournament);
            }
        }
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.tournament.user_index', compact('tournaments', 'games'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';

        $tournaments = array();
        $curent_data = date('Y-m-d');
        $curent_time = date("h:i:s");
        // dd($curent_time);
        if ($game_id != '') {
            $tournaments = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
        //                ->where('partner', "Gosu")
                // ->where('stop_joining', 0)
                ->where('end_date', '<', $curent_data)
                // ->where('end_time', '<', $curent_time)
                ->where('game_id', $game_id)
                ->orderby('end_date', 'desc')->paginate(16);
        } else {
            $tournaments = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
        //                ->where('partner', "Gosu")
                // ->where('stop_joining', 0)
                ->where('end_date', '<', $curent_data)
                // ->where('end_time', '<', $curent_time)
                ->orderby('end_date', 'desc')->paginate(16);
        }

        // $tournaments_player_joined = array();

        foreach ($tournaments as $tournament) {
            $tournament_id = $tournament->id;
            $tournament_type = $tournament->user_type;

            // if ($tournament_type == '1') {
            //     $joined_qry = DB::select(DB::raw("SELECT COUNT(id) as count FROM `gamers_tournaments` where tournament_id='$tournament_id'"));
            // } else {
            //     $joined_qry = DB::select(DB::raw("SELECT COUNT(id) as count FROM `teams_tournaments` where tournament_id='$tournament_id'"));
            // }
            // if (count($joined_qry) > 0) {
            //     $tournaments_player_joined[$tournament_id] = $joined_qry[0]->count;
            // } else {
            //     $tournaments_player_joined[$tournament_id] = "?";
            // }
            if ($tournament_type == '1') {
                $gamerplayerjoined = DB::select(DB::raw("SELECT COUNT(*)as count FROM `gamers_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));

                if (count($gamerplayerjoined) > 0) {
                    $tournament->player_joined = $gamerplayerjoined[0]->count;
                } else {
                    $tournament->player_joined = 0;
                }
            } else {
                $teamsplayerjoined = DB::select(DB::raw("SELECT COUNT(*) as count FROM `teams_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));

                if (count($teamsplayerjoined) > 0) {
                    $tournament->player_joined = $teamsplayerjoined[0]->count;
                } else {
                    $tournament->player_joined = 0;
                }
            }

           
        }

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('website.tournament.complete', compact('tournaments', 'games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id, $slug)
    {
        // dd($id);

        $tour_id = $id;
        $stage = Gamer_tournament_schedule::where('tournament_id', $id)->orderBy('stage', 'desc')->take(1)->get();
        $tournaments = Tournaments::find($id);
        $tournamentspaid = Tournaments::where(['id' => $id, 'is_free' => '0'])->first();
        $leaderboard = DB::table('gamers_tournaments')
            ->select('gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name', 'gamers_tournaments.tournament_id', DB::raw("SUM(gamers_tournaments.point) as user_point"))
            ->join('tournaments', 'gamers_tournaments.tournament_id', '=', 'tournaments.id')
            ->join('games', 'games.id', '=', 'tournaments.game_id')
            ->join('gamers', 'gamers.id', '=', 'gamers_tournaments.user_id')
            ->join('countries', 'countries.id', '=', 'gamers.country_id')
            ->where('tournaments.status', '=', '1')
            ->where('gamers_tournaments.tournament_id', $tour_id)
            ->where('gamers_tournaments.is_deleted', 0)
            ->groupBy('gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name',
                'gamers_tournaments.tournament_id')
            ->orderBy('user_point', 'desc')
            ->get()
            ->toArray();

        $teamleaderboard = DB::table('teams_tournaments')
            ->select('teams_tournaments.team_id', 'teams.team_name', 'teams_tournaments.tournament_id', DB::raw("SUM(teams_tournaments.point) as user_point"))
            ->join('tournaments', 'teams_tournaments.tournament_id', '=', 'tournaments.id')
            ->join('games', 'games.id', '=', 'tournaments.game_id')
            ->join('teams', 'teams.id', '=', 'teams_tournaments.team_id')
            ->where('tournaments.status', '=', '1')
            ->where('teams_tournaments.tournament_id', $tour_id)
            ->where('teams_tournaments.is_deleted', 0)
            ->groupBy('teams_tournaments.team_id', 'teams.team_name',
                'teams_tournaments.tournament_id')
            ->orderBy('user_point', 'desc')
            ->get()
            ->toArray();
            // dd($teamleaderboard);

        if (Auth::guard('gamer')->check()) {
            $authgamer_id = Auth::guard('gamer')->user()->id;
        } else {
            $authgamer_id = null;
        }

        $teamplayers = DB::table('team_players')
            ->select('team_players.*', 'team_players.id as tpid', 'gamers.id as gamer_id', 'teams.id as team_id')
            ->leftjoin('teams', 'team_players.team_id', 'teams.id')
            ->leftjoin('gamers', 'teams.gamer_id', 'gamers.id')
            ->where('team_players.is_deleted', 0)
            ->where('gamers.id', $authgamer_id)
            ->get();

        if ($tournaments->user_type == 1) {
            $playerjoined = DB::select(DB::raw("SELECT COUNT(*) tournament_id FROM `gamers_tournaments` WHERE `tournament_id`=$tour_id and is_deleted=0"));
        } else {
            $playerjoined = DB::select(DB::raw("SELECT COUNT(*) tournament_id FROM `teams_tournaments` WHERE `tournament_id`=$tour_id and is_deleted=0"));
        }
        if ($tournaments->tournament_type == 1) {
            if ($tournaments->user_type == 1) {
                $winner = TournamentRoomSlot::where('tournament_room_slots.tournament_id', $id)
                    ->where('tournament_room_slots.winner', '!=', 0)
                    ->SELECT('gamers.fname as name', 'tournament_room_slots.room_code')
                    ->leftjoin('gamers', 'gamers.id', 'tournament_room_slots.winner')
                    ->get();

                $count = $winner->count();
                if ($count >= 1) {
                    $winner = $winner;
                } else {
                    $winner = '';
                }
            } elseif ($tournaments->user_type == 2) {

                $winner = TournamentRoomSlot::where('tournament_room_slots.tournament_id', $id)
                    ->where('tournament_room_slots.winner', '!=', 0)
                    ->SELECT('teams.team_name as name', 'tournament_room_slots.room_code')
                    ->leftjoin('teams', 'teams.id', 'tournament_room_slots.winner')
                    ->get();
                $count = $winner->count();
                if ($count >= 1) {
                    $winner = $winner;
                } else {
                    $winner = '';
                }
            }
        } elseif ($tournaments->tournament_type == 2) {
            if ($tournaments->user_type == 1) {
                $stage = Gamer_tournament_schedule::where('tournament_id', $id)->orderBy('stage', 'desc')->get();
                if (count($stage) > 0) {
                    $winner = Gamer_tournament_schedule::where('tournament_id', $id)
                        ->select('gamers.fname as name')
                        ->join('gamers', 'gamers.id', 'gamer_tournament_schedules.winner')
                        ->where('gamer_tournament_schedules.stage', $stage[0]->stage)
                        ->get();
                    $count = $winner->count();
                    if ($count == 1) {
                        $winner = $winner;
                    } else {
                        $winner = '';
                    }
                } else {
                    $winner = '';
                }

            } elseif ($tournaments->user_type == 2) {
                $stage = Team_tournament_schedule::where('tournament_id', $id)->orderBy('stage', 'desc')->get();
                if (count($stage) > 0) {
                    $winner = Team_tournament_schedule::where('tournament_id', $id)
                        ->select('teams.team_name as name')
                        ->join('teams', 'teams.id', 'team_tournament_schedules.winner')
                        ->where('team_tournament_schedules.stage', $stage[0]->stage)
                        ->get();

                    $count = $winner->count();
                    if ($count == 1) {
                        $winner = $winner;
                    } else {
                        $winner = '';
                    }
                } else {
                    $winner = '';
                }
            }
        }

        $psnumber = $tournaments->ps_number;
        $platform = DB::select(DB::raw("SELECT * FROM `platforms` WHERE `id` in ($psnumber); "));
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        if ($tournaments->is_free == 1) {
            return view('website.tournament.detail', compact('games', 'teamleaderboard',
                'tournaments', 'platform', 'leaderboard', 'playerjoined', 'teamplayers', 'winner'));
        } else {

            return view('website.tournament.paiddetail', compact('games', 'teamleaderboard',
                'tournamentspaid', 'platform', 'leaderboard', 'playerjoined', 'teamplayers', 'winner'));
        }

    }

    public function tournamentSorting($id, $slug)
    {
        $tournaments = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('game_id', $id)->orderby('id', 'desc')->get();
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.tournament.index', compact('tournaments', 'games'));
    }


    public function completetournamentSorting($id, $slug)
    {
        $tournaments = Tournaments::where(['is_active' => 1, 'stop_joining' => 1])
            ->where('is_deleted', 0)
            ->where('game_id', $id)
            ->orderby('id', 'desc')
            ->get();
        $games = Game::where('is_active', 1)
            ->where('is_deleted', 0)
            ->get();
        return view('website.tournament.complete', compact('tournaments', 'games'));
    }

    public function mygame($id)
    {
        $gamertype = Gamer::find($id);
        $gamertype = $gamertype->gamer_type;
        if ($gamertype == 1) {
            $tournaments = Gamer::where('gamers.id', $id)
                ->join('gamers_tournaments', 'gamers_tournaments.user_id', '=', 'gamers.id')
                ->join('tournaments', 'gamers_tournaments.tournament_id', '=', 'tournaments.id')
                ->select('tournaments.*')
                ->where('tournaments.is_active', 1)->where('tournaments.is_deleted', 0)
                ->get();
        } else {
            $tournaments = Gamer::where('gamers.id', $id)
                ->leftjoin('teams', 'teams.gamer_id', 'gamers.id')
                ->leftjoin('teams_tournaments', 'teams_tournaments.team_id', '=', 'teams.id')
                ->leftjoin('tournaments', 'teams_tournaments.tournament_id', '=', 'tournaments.id')
                ->select('tournaments.*')
                ->where('tournaments.is_active', 1)->where('tournaments.is_deleted', 0)
                ->get();
        }

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.tournament.mytournament',
            compact('tournaments', 'games'));
    }


                //         public function fixture($id){
                //             $tournaments= Tournaments::find($id);
                //            $stage1=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
                //             tournaments.name as tname,gamer_tournament_points.*,
                //             gt1.in_game_id as player1_psn,gt2.in_game_id as player2_psn
                //          from gamer_tournament_schedules left join gamers as g1
                //          on (gamer_tournament_schedules.player1 = g1.id)
                //          left join gamers as g2
                //          on (gamer_tournament_schedules.player2 = g2.id) 
                //          left join tournaments
                //          on (gamer_tournament_schedules.tournament_id = tournaments.id)
                //          left join gamer_tournament_points
                //          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
                //          left join gamers_tournaments as gt1
                //          on (gt1.user_id=gamer_tournament_schedules.player1)
                //          left join gamers_tournaments as gt2
                //          on (gt2.user_id=gamer_tournament_schedules.player2)
                //          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 1 "));
                //             $count1=count($stage1); 

                //             $stage2=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
                //             tournaments.name as tname,gamer_tournament_points.*
                //          from gamer_tournament_schedules left join gamers as g1
                //          on (gamer_tournament_schedules.player1 = g1.id)
                //          left join gamers as g2
                //          on (gamer_tournament_schedules.player2 = g2.id) 
                //          left join tournaments
                //          on (gamer_tournament_schedules.tournament_id = tournaments.id)
                //          left join gamer_tournament_points
                //          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
                //          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 2 "));
                //             $count2=count($stage2);            
                //             $stage3=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
                //             tournaments.name as tname,gamer_tournament_points.*
                //          from gamer_tournament_schedules left join gamers as g1
                //          on (gamer_tournament_schedules.player1 = g1.id)
                //          left join gamers as g2
                //          on (gamer_tournament_schedules.player2 = g2.id) 
                //          left join tournaments
                //          on (gamer_tournament_schedules.tournament_id = tournaments.id)
                //          left join gamer_tournament_points
                //          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
                //          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 3"));
                //             $count3=count($stage3);
                //             $stage4=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
                //             tournaments.name as tname,gamer_tournament_points.*
                //          from gamer_tournament_schedules left join gamers as g1
                //          on (gamer_tournament_schedules.player1 = g1.id)
                //          left join gamers as g2
                //          on (gamer_tournament_schedules.player2 = g2.id) 
                //          left join tournaments
                //          on (gamer_tournament_schedules.tournament_id = tournaments.id)
                //          left join gamer_tournament_points
                //          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
                //          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 4"));
                //             $count4=count($stage4);

                // $stage=Gamer_tournament_schedule::where('tournament_id',$id)->orderBy('stage','desc')->take(1)->get();        
                //             if(count($stage)>0){
                //              $winner=Gamer_tournament_schedule::where ('tournament_id',$id)
                //                     ->select ('gamers.fname as name')
                //                     ->join('gamers','gamers.id','gamer_tournament_schedules.winner')
                //                     ->where ('gamer_tournament_schedules.stage',$stage[0]->stage)
                //                     ->get();        
                //                     $count = $winner->count();if($count==1){$winner=$winner;}else{$winner='';}
                //                         }else{$winner = '';}

                //             return view('website.tournament.fixture',
                //                 compact('tournaments','stage1','count1','stage2','count2','stage3','count3','stage4','count4','winner'));

                //         }


    public function fixture($id)
    {
        $stages = array();

        $stageDatas = DB::select(DB::raw("select DISTINCT stage from gamer_tournament_schedules where tournament_id=$id"));

        foreach ($stageDatas as $stage) {
            $stage_no = $stage->stage;

            $schedules = array();

            // $schedulesDatas = DB::select(DB::raw("select gamer_tournament_schedules.player1, gamer_tournament_schedules.player2, gamer_tournament_schedules.start_date, gamer_tournament_schedules.start_time, gamer_tournament_points.player1_score, gamer_tournament_points.player2_score
            //     from gamer_tournament_schedules left join gamer_tournament_points
            //     on (gamer_tournament_schedules.id=gamer_tournament_points.schedule_id)
            //     where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage=$stage_no"));

            $schedulesDatas = DB::select(DB::raw("select * from gamer_tournament_schedules where tournament_id='$id' and stage='$stage_no' order by id asc"));

            foreach ($schedulesDatas as $schedule) {
                //die("xyz");
                $player1_id = $schedule->player1;

                $schedule_id = $schedule->id;

                $pointResult = DB::select(DB::raw("select * from gamer_tournament_points where schedule_id='$schedule_id' order by id asc"));

                if (count($pointResult) > 0) {
                    $player1_score = $pointResult[0]->player1_score;
                    $player2_score = $pointResult[0]->player2_score;
                } else {
                    $player1_score = '';
                    $player2_score = '';
                }

                $schedule->player1_score = $player1_score;
                $schedule->player2_score = $player2_score;

                $player1Result = DB::select(DB::raw("select gamers.fname, gamers.lname, gamers.email, gamers_tournaments.in_game_id
                    from gamers join gamers_tournaments
                    on (gamers_tournaments.user_id=gamers.id)
                    where gamers.id=$player1_id and gamers_tournaments.tournament_id=$id"));

                $player2_id = $schedule->player2;
                $player2Result = DB::select(DB::raw("select gamers.fname, gamers.lname, gamers.email, gamers_tournaments.in_game_id
                    from gamers join gamers_tournaments
                    on (gamers_tournaments.user_id=gamers.id)
                    where gamers.id=$player2_id and gamers_tournaments.tournament_id=$id"));

                if (count($player1Result) > 0) {
                    $schedule->player1_name = $player1Result[0]->fname;
                    $schedule->player1_psn = $player1Result[0]->in_game_id;
                } else {
                    $schedule->player1_name = '';
                    $schedule->player1_psn = '';
                }

                if (count($player2Result) > 0) {
                    $schedule->player2_name = $player2Result[0]->fname;
                    $schedule->player2_psn = $player2Result[0]->in_game_id;
                } else {
                    $schedule->player2_name = '';
                    $schedule->player2_psn = '';
                }

                array_push($schedules, $schedule);
            }

            $stage->schedules = $schedules;

            // echo "<pre>";
            // print_r($stage->schedules);


            array_push($stages, $stage);
        }

        $tournaments = Tournaments::find($id);

        return view('website.tournament.fixture', compact('stages', 'tournaments'));
    }

    public function team_fixture($id)
    {
        $stages = array();

        $stageDatas = DB::select(DB::raw("select DISTINCT stage from team_tournament_schedules where tournament_id=$id"));

        foreach ($stageDatas as $stage) {
            $stage_no = $stage->stage;

            $schedules = array();

            // $schedulesDatas = DB::select(DB::raw("select team_tournament_schedules.team1, team_tournament_schedules.team2, team_tournament_schedules.start_date, team_tournament_schedules.start_time, team_tournament_points.team1_score, team_tournament_points.team2_score
            //     from team_tournament_schedules left join team_tournament_points
            //     on (team_tournament_schedules.id=team_tournament_points.team_schedule_id)
            //     where team_tournament_schedules.tournament_id=$id and team_tournament_schedules.stage=$stage_no"));
            $schedulesDatas = DB::select(DB::raw("select * from team_tournament_schedules where tournament_id='$id' and stage='$stage_no'"));

            foreach ($schedulesDatas as $schedule) {
                $team1_id = $schedule->team1;
                $schedule_id = $schedule->id;

                $pointResult = DB::select(DB::raw("select * from team_tournament_points where team_schedule_id='$schedule_id' order by id asc"));

                if (count($pointResult) > 0) {
                    $team1_score = $pointResult[0]->team1_score;
                    $team2_score = $pointResult[0]->team2_score;
                } else {
                    $team1_score = '';
                    $team2_score = '';
                }

                $team1Result = DB::select(DB::raw("select * from teams where id='$team1_id'"));

                $team2_id = $schedule->team2;
                $team2Result = DB::select(DB::raw("select * from teams where id='$team2_id'"));

                if (count($team1Result) > 0) {
                    $schedule->team1_name = $team1Result[0]->team_name;
                } else {
                    $schedule->team1_name = '';
                }

                if (count($team2Result) > 0) {
                    $schedule->team2_name = $team2Result[0]->team_name;
                } else {
                    $schedule->team2_name = '';
                }

                $schedule->team1_score = $team1_score;
                $schedule->team2_score = $team2_score;

                array_push($schedules, $schedule);
            }

            $stage->schedules = $schedules;
            array_push($stages, $stage);
        }

        $tournaments = Tournaments::find($id);

        return view('website.tournament.team_fixture', compact('stages', 'tournaments'));
    }

    /* Add tournament */

    public function show(){
    
        $tournam = ( isset( $_GET['tournament'] ) && $_GET['tournament'] != '' ) ? $_GET['tournament'] : '';

            if ( $tournam != '' ) {
                $tournaments = Tournaments::where( 'tournaments.is_deleted', 0 )->where('tournaments.gamer_id', Auth::guard('gamer')->user()->id)->where( 'name', 'like', '%' . $tournam . '%' )->orderBy( DB::raw( 'ABS(DATEDIFF(start_date, NOW()))' ) )
                ->get();
            } else {
                $tournaments = Tournaments::where( 'tournaments.is_deleted', 0 )->where('tournaments.gamer_id', Auth::guard('gamer')->user()->id)->orderBy( DB::raw( 'ABS(DATEDIFF(start_date, NOW()))' ) )
                ->get();
            }

            return view( 'website.tournament.show', compact( 'tournaments' ) );
    }

   
    public function create() {
        // dd("here");
        $regions = Region::all();
        $country = Country::all();
        $game = Game::all();
        $station = DB::table( 'platforms' )->where( 'is_deleted', '=', '0' )
        ->get();
        $currencyList = DB::table( 'currencies' )->where( 'is_deleted', '=', '0' )
        ->distinct()
        ->get( ['id', 'currency_name', 'currency_code'] );
        return view( 'website.tournament.create', compact( 'regions', 'country', 'game', 'station', 'currencyList' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $validator = Validator::make(array(
            'name' => $request->name,
            'game_id' => $request->game_id,
            'country_id' => $request->country_id,
            'region_id' => $request->region_id,
            'user_type' => $request->user_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reg_start_date' => $request->reg_start_date,
            'reg_end_date' => $request->reg_end_date,
            'reg_start_time' => $request->reg_start_time,
            'reg_end_time' => $request->reg_end_time,
            'prize_money' => $request->prize_money,
            'prize_currency' => $request->prize_currency,
            'image' => $request->image,
            'tournament_type' => $request->tournament_type,
            'max_players' => $request->max_players,
            'ps_number' => $request->ps_number
        ), array(
            'name' => 'required|unique:tournaments',
            'game_id' => 'required',
            'country_id' => 'required',
            'region_id' => 'required',
            'user_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'reg_start_date' => 'required',
            'reg_end_date' => 'required',
            'reg_start_time' => 'required',
            'reg_end_time' => 'required',
            'prize_money' => 'required',
            'prize_currency' => 'required',
            "image" => "required|mimes:jpg,jpeg,png,svg,gif,WebP|max:10000000",
            'tournament_type' => 'required',
            'max_players' => 'required',
            'ps_number' => 'required'
        ));
        if ( $validator->fails() ) {
            return redirect()->route('gamer.tournaments.create',Auth::guard('gamer')->user()->id)
            ->withErrors( $validator->errors() )->withInput();
        } else {
            $flag = 0;
            $flag1 = 0;
            // $ps_number = '';
            $region_id = '';
            $country_id = '';
            $Tournaments = new Tournaments;
            $Tournaments->name = trim( $request->tournament_name );
            $Tournaments->game_id = trim( $request->game_id );
            $Tournaments->gamer_id = Auth::guard('gamer')->user()->id;
            $Tournaments->description = trim( $request->description );
            $Tournaments->rulesdescription = trim( $request->rulesdescription );
            $Tournaments->user_type = trim( $request->user_type );
            $Tournaments->slug = trim( $request->slug );
            $Tournaments->prize_money = trim( $request->prize_money );
            $Tournaments->prize_currency = trim( $request->prize_currency );
            $Tournaments->max_players = trim( $request->max_players );
            $Tournaments->status = trim( $request->tournament_status );
            $Tournaments->tournament_type = trim( $request->tournament_type );
            if ( $request->no_user_prize_dist != '' ) {
                $Tournaments->no_user_prize_dist = trim( $request->no_user_prize_dist );
            } else {
                $Tournaments->no_user_prize_dist = 0;
            }
            $Tournaments->meta_title = trim( $request->meta_title );
            $Tournaments->metakeyword = trim( $request->metakeyword );
            $Tournaments->metadescription = trim( $request->metadescription );
            if ( $request->room_size == '' ) {
                $Tournaments->room_size = '1';
            } else {
                $request->room_size = intdiv( $Tournaments->max_players, $request->room_size );
                $Tournaments->room_size = $request->room_size;
            }

            if ( $request->country_id == '' ) {
                $Tournaments->country_id = '0';
            } else {
                $coun = $request->country_id;
                for ( $k = 0; $k < count( $coun );
                $k++ ) {
                    $country_id = $country_id . $coun[$k] . ',';
                }
                $Tournaments->country_id = $country_id;
            }
            if ( $request->region_id == '' ) {
                $Tournaments->region_id = '0';
            } else {
                $regio = $request->region_id;
                for ( $k = 0; $k < count( $regio );
                $k++ ) {
                    $region_id = $region_id . $regio[$k] . ',';
                }
                $Tournaments->region_id = $region_id;
            }

            if ( $request->prize_money == '' ) {
                $Tournaments->prize_money = '0';
                $Tournaments->prize_currency = '0';
            } else {
                $Tournaments->prize_money = $request->prize_money;
                $Tournaments->prize_currency = $request->prize_currency;
            }
            if ( $request->other_reward == '' ) {
                $Tournaments->other_reward = '';
            } else {
                $Tournaments->other_reward = $request->other_reward;
            }
            $free = $request->is_free;
            if ( $free == '0' ) {
                $Tournaments->is_free = '0';
                $Tournaments->part_amount = trim( $request->partcipation_amount );
                $Tournaments->part_currency = $request->part_currency;
            } else {
                $Tournaments->is_free = '1';
                $Tournaments->part_amount = '0';
                $Tournaments->part_currency = '0';
            }
            $ps = $request->ps_number;
            // for ( $k = 0; $k < count( $ps );
            // $k++ ) {
            //     $ps_number = $ps_number . $ps[$k] . ',';
            // }
            $Tournaments->ps_number = $ps;
            $sdate = date_create( trim( $request->start_date ) );
            $edate = date_create( trim( $request->end_date ) );
            $diff = date_diff( $sdate, $edate );
            if ( $diff->d >= 0 && $flag == 0 ) {
                $Tournaments->start_date = date( 'Y-m-d', strtotime( trim( $request->start_date ) ) );
                $Tournaments->end_date = date( 'Y-m-d', strtotime( trim( $request->end_date ) ) );
            } else {
                $flag = 1;
            }
            $start_time = new \DateTime( trim( $request->start_time ) );
            $end_time = new \DateTime( trim( $request->end_time ) );
            $stime = $start_time->format( 'H:i:s' );
            $etime = $end_time->format( 'H:i:s' );
            $st_time = explode( ':', $stime );

            $et_time = explode( ':', $etime );
            if ( ( $et_time[0] >= $st_time[0] ) && ( $flag == 0 ) ) {
                $Tournaments->start_time = $stime;
                $Tournaments->end_time = $etime;
            } else if ( ( $et_time[1] >= $st_time[1] ) && ( $flag == 0 ) ) {
                $Tournaments->start_time = $stime;
                $Tournaments->end_time = $etime;
            } else {
                $flag = 1;
            }
            $srdate = date_create( trim( $request->reg_start_date ) );
            $erdate = date_create( trim( $request->reg_end_date ) );
            $diff1 = date_diff( $srdate, $erdate );
            if ( $diff1->d >= 0 && $flag == 0 ) {
                $Tournaments->reg_start_date = date( 'Y-m-d', strtotime( trim( $request->reg_start_date ) ) );
                $Tournaments->reg_end_date = date( 'Y-m-d', strtotime( trim( $request->reg_end_date ) ) );
            } else {
                $flag = 1;
            }
            $reg_start_time = new \DateTime( trim( $request->reg_start_time ) );
            $reg_end_time = new \DateTime( trim( $request->reg_end_time ) );
            $rstime = $reg_start_time->format( 'H:i:s' );
            $retime = $reg_end_time->format( 'H:i:s' );
            $Tournaments->reg_start_time = $rstime;
            $Tournaments->reg_end_time = $retime;
            $valid_images = array(
                'png',
                'jpg',
                'jpeg',
                'gif'
            );
            if ( $request->hasFile( 'image' ) && in_array( $request
            ->image
            ->extension(), $valid_images ) ) {
                $profile_image = $request->image;
                // $imageName = time() . '.' . $profile_image->getClientOriginalName();
                $imageName = time(). '_' .rand(1000, 9999).'.'. $profile_image->getClientOriginalExtension();
                $profile_image->move( 'new-theme/images/Tournaments/', $imageName );
                $uploadedImage = 'new-theme/images/Tournaments/' . $imageName;
                $Tournaments->image = $uploadedImage;
            }else{
                if($request->game_id == 1){
                    $Tournaments->image = 'uploads/tournaments/default/FIFA.jpg';
                }elseif($request->game_id == 2){
                    $Tournaments->image = 'uploads/tournaments/default/BGMI.jpg';
                }elseif($request->game_id == 3){
                    $Tournaments->image = 'uploads/tournaments/default/Rainbow 6 Siege.jpg';
                }elseif($request->game_id == 4){
                    $Tournaments->image = 'uploads/tournaments/default/COD.jpg';
                }elseif($request->game_id == 5){
                    $Tournaments->image = 'uploads/tournaments/default/FreeFire Max.jpg';
                }elseif($request->game_id == 16){
                    $Tournaments->image = 'uploads/tournaments/default/Mobile Legends.jpg';
                }elseif($request->game_id == 17){
                    $Tournaments->image = 'uploads/tournaments/default/Dota 2.jpg';
                }elseif($request->game_id == 18){
                    $Tournaments->image = 'uploads/tournaments/default/Valorant.jpg';
                }elseif($request->game_id == 19){
                    $Tournaments->image = 'uploads/tournaments/default/Cricket 19.jpg';
                }
            }
            if ( $flag == 0 ) {
                $res = $Tournaments->save();
                $lid = $Tournaments->id;
                if ( $request->has( 'percAmt' ) && count( $request->percAmt ) > 0 ) {
                    $arrx2 = $request->percAmt;
                    $inputArr = array();
                    $rank = 1;
                    for ( $i = 0; $i < count( $request->percAmt );
                    $i++ ) {
                        $arr = array();
                        $arr['tournament_id'] = $Tournaments->id;
                        $arr['percentage_amt'] = $arrx2[$i];
                        $arr['user_rank'] = $rank;
                        array_push( $inputArr, $arr );
                        $rank++;
                    }
                    DB::table( 'tournament_percentage_maps' )->insert( $inputArr );
                }
                if ( $Tournaments->room_size ) {
                    for ( $i = 0; $i < $Tournaments->room_size; $i++ ) {
                        $n2 = str_pad( $i + 1, 4, 0, STR_PAD_LEFT );
                        $Tournament = new Tournament_rooms;
                        $Tournament->tournament_id = $lid;
                        $Tournament->game_room_id = 0;
                        $tour = Tournaments::with( 'game_name' )->where( 'id', '=', $lid )->first();
                        $tournament_name = $tour->name;
                        $game_name = $tour
                        ->game_name->name;
                        $gname = substr( $game_name, 0, 1 );
                        $tname = substr( $tournament_name, 0, 2 );
                        $code = ucwords( $gname ) . '-' . strtoupper( $tname ) . '-' . $lid . '-' . $n2;
                        $Tournament->room_code = $code;
                        $Tournament->save();
                    }
                }
                if ( $res ) {
                    Alert::Html( 'Success', '<h2> Tournament Added Successfully </h2>', 'success' );
                    return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
                } else {
                    Alert::Html( 'Warning', '<h2> Something went wrong </h2>', 'warning' );
                    return redirect()->route('gamer.tournaments.create',Auth::guard('gamer')->user()->id);
                }
            } else {
                Alert::Html( 'Warning', '<h2> Something went wrong </h2>', 'warning' );
                return redirect()->route('gamer.tournaments.create',Auth::guard('gamer')->user()->id);
            }
        }
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Tournaments  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        $game_data = DB::table( 'games' )->get();
        $tour_data = Tournaments::where( 'id', $id )->first();
        $station = DB::table( 'platforms' )->where( 'is_active', '1' )
        ->get();
        $regionList = Region::where( 'is_deleted', 0 )->get();
        $countries = DB::table( 'countries' )->where( 'is_active', '1' )
        ->orderBy( 'name', 'asc' )
        ->get();
        $currencyList = DB::table( 'currencies' )->where( 'is_active', '1' )
        ->distinct()
        ->get( ['id', 'currency_name', 'currency_code'] );
        $percentageBrakeups = DB::table( 'tournament_percentage_maps' )->where( 'tournament_id', $id )->orderBy( 'user_rank', 'asc' )
        ->get();

        return view( 'website.tournament.edit', compact( 'game_data', 'tour_data', 'station', 'countries', 'currencyList', 'regionList', 'percentageBrakeups' ) );
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Tournaments  $tournaments
    * @return \Illuminate\Http\Response
    */

    public function update(Request $request){
        {
            //die("xyz");
            $tid = $request->input('tournament_id');
            $flag = 0;
    
            $valid_images = array(
                'png',
                'jpg',
                'jpeg'
            );
    
            $ck = Tournaments::where('id', '=', $tid)->first();
            // print_r($ck);
            // die();
            if (!empty($ck)) {
                //die("xyz");
                $request->validate(['tournament_name' => 'required', 'game' => 'required', 'user_type' => 'required', 'start_date' => 'required|date', 'end_date' => 'required|date', 'start_time' => 'required', 'end_time' => 'required', 'reg_start_date' => 'required|date', 'reg_end_date' => 'required|date', 'reg_start_time' => 'required', 'reg_end_time' => 'required', 'max_players' => 'required|numeric', 'room_size' => 'required|numeric']);
                $updateData = array();
                $updateData['name'] = trim($request->input('tournament_name'));
                $updateData['slug'] = $request->input('slug');
                $updateData['game_id'] = trim($request->input('game'));
                $updateData['description'] = trim($request->input('description'));
                $updateData['rulesdescription'] = trim($request->input('rulesdescription'));
                $updateData['no_user_prize_dist'] = trim($request->input('no_user_prize_dist'));
                $updateData['tournament_type'] = trim($request->tournament_type);
                $updateData['meta_title'] = trim($request->input('meta_title'));
                $updateData['metakeyword'] = trim($request->input('metakeyword'));
                $updateData['metadescription'] = trim($request->input('metadescription'));
                $ztype = $request->input('zone_type');
    
                if ($ztype == '1') {
                    $updateData['country_id'] = '0';
                } else {
                    $coun = $request->input('country');
                    $country = '';
                    for ($k = 0; $k < count($coun);
                         $k++) {
                        $country = $country . $coun[$k] . ',';
                    }
                    $updateData['country_id'] = $country;
                }
                if ($ztype == '2') {
                    $updateData['region_id'] = '0';
                } else {
                    $regi = $request->input('region');
                    $region = '';
                    for ($k = 0; $k < count($regi);
                         $k++) {
                        $region = $region . $regi[$k] . ',';
                    }
                    $updateData['region_id'] = $region;
                }
    
                if ($request->input('prize_type') == 1) {
                    if ($request->input('prize_money') == '') {
                        $updateData['prize_money'] = '0';
                    } else {
                        $updateData['prize_money'] = $request->input('prize_money');
                        $updateData['prize_currency'] = trim($request->input('prize_currency'));
                        $updateData['other_reward'] = '';
                    }
                } else {
                    if ($request->input('other_reward') == '') {
                        $updateData['other_reward'] = '';
                    } else {
                        $updateData['other_reward'] = $request->input('other_reward');
                        $updateData['prize_money'] = '0';
                        $updateData['prize_currency'] = '0';
                    }
                }
    
                $updateData['user_type'] = trim($request->input('user_type'));
                $updateData['max_players'] = trim($request->input('max_players'));
                $request->room_size = intdiv($updateData['max_players'], $request->room_size);
    
                $updateData['room_size'] = trim($request->room_size);
    
                $free = $request->input('is_free');
    
                if ($free == '0') {
                    $updateData['is_free'] = '0';
                    $updateData['part_amount'] = trim($request->input('partcipation_amount'));
                    $updateData['part_currency'] = $request->input('part_currency');
                } else {
                    $updateData['is_free'] = '1';
                    $updateData['part_amount'] = '0';
                    $updateData['part_currency'] = '0';
                }
                $ps = $request->input('ps_number');
                // $ps_number = '';
                // for ($k = 0; $k < count($ps);
                //      $k++) {
                //     $ps_number = $ps_number . $ps[$k] . ',';
                // }
                $updateData['ps_number'] = $ps;
    
                $sdate = date_create(trim($request->input('start_date')));
                $edate = date_create(trim($request->input('end_date')));
                $diff = date_diff($sdate, $edate);
    
                if ($diff->d >= 0 && $flag == 0) {
                    $updateData['start_date'] = date('Y-m-d', strtotime(trim($request->input('start_date'))));
                    $updateData['end_date'] = date('Y-m-d', strtotime(trim($request->input('end_date'))));
                } else {
                    $flag = 1;
                }
    
                $start_time = new \DateTime(trim($request->input('start_time')));
                $end_time = new \DateTime(trim($request->input('end_time')));
                $stime = $start_time->format('H:i:s');
                $etime = $end_time->format('H:i:s');
                $st_time = explode(':', $stime);
                $et_time = explode(':', $etime);
                //  echo $et_time[1].'////'.$st_time[1];
                //die();
                if (($et_time[0] >= $st_time[0]) && ($flag == 0)) {
                    $updateData['start_time'] = $stime;
                    $updateData['end_time'] = $etime;
                } else if (($et_time[1] >= $st_time[1]) && ($flag == 0)) {
                    $updateData['start_time'] = $stime;
                    $updateData['end_time'] = $etime;
                } else {
                    $flag = 1;
                }
    
                $srdate = date_create(trim($request->input('reg_start_date')));
                $erdate = date_create(trim($request->input('reg_end_date')));
                $diff1 = date_diff($srdate, $erdate);
                if ($diff1->d >= 0 && $flag == 0) {
                    $updateData['reg_start_date'] = date('Y-m-d', strtotime(trim($request->input('reg_start_date'))));
                    $updateData['reg_end_date'] = date('Y-m-d', strtotime(trim($request->input('reg_end_date'))));
                } else {
                    $flag = 1;
                }
                $reg_start_time = new \DateTime(trim($request->input('reg_start_time')));
                $reg_end_time = new \DateTime(trim($request->input('reg_end_time')));
                $rstime = $reg_start_time->format('H:i:s');
                $retime = $reg_end_time->format('H:i:s');
                $rst_time = explode(':', $rstime);
                $ret_time = explode(':', $retime);
                $updateData['reg_start_time'] = $rstime;
                $updateData['reg_end_time'] = $retime;
                // if ( $request->hasFile( 'image' ) ) {
                //     $image = $request->file( 'image' );
                //     $real_path = $image->getRealPath();
                //     $file_orgname = $image->getClientOriginalName();
                //     $file_size = $image->getClientSize();
                //     $file_ext = strtolower( $image->getClientOriginalExtension() );
                //     $file_newname = 'tournament' . '_' . time() . '.' . $file_ext;
                //     $destinationPath = public_path( '/uploads/tournaments' );
                //     $image->move( $destinationPath, $file_newname );
                //     $updateData['image'] = $file_newname;
                //     if ( $ck->image != '' ) {
                //         //unlink( $destinationPath.'/'.$ck->image );
    
                //     }
                // } else {
                //     $updateData['image'] = $ck['image'];
                // }
                if ($request->hasFile('image') && in_array($request
                        ->image
                        ->extension(), $valid_images)) {
    
                    $tournament_old = Tournaments::find($tid);
    
                    $fn = ltrim($tournament_old->image, 'new-theme/images/Tournaments/');
                    $image_full_path = base_path('public') . '/new-theme/images/Tournaments/' . $fn;
    
                    $profile_image = $request->image;
                    // $imageName = time() . '.' . $profile_image->getClientOriginalName();
                    $imageName = time(). '_' .rand(1000, 9999).'.'. $profile_image->getClientOriginalExtension();
                    $profile_image->move('new-theme/images/Tournaments/', $imageName);
                    $uploadedImage = 'new-theme/images/Tournaments/' . $imageName;
                    $updateData['image'] = $uploadedImage;
    
                        // if (File::exists($image_full_path)) {
                        //     File::delete($image_full_path);
                        // }
    
                }
                if ($flag == 0) {
                    $res = Tournaments::where('id', '=', $tid)->update($updateData);
                    /** ARI **/
                    if ($request->has('percAmt') && count($request->input('percAmt')) > 0) {
                        DB::table('tournament_percentage_maps')
                            ->where('tournament_id', '=', $tid)->delete();
                        $arrx2 = $request->input('percAmt');
                        $inputArr = array();
                        $rank = 1;
                        for ($i = 0; $i < count($request->input('percAmt'));
                             $i++) {
                            $arr = array();
                            $arr['tournament_id'] = $tid;
    
                            $arr['percentage_amt'] = $arrx2[$i];
                            $arr['user_rank'] = $rank;
    
                            array_push($inputArr, $arr);
                            $rank++;
                        }
                        DB::table('tournament_percentage_maps')->insert($inputArr);
                    }
                    if ($res) {
                        Alert::Html('Success', '<h2> Tournament Updated Successfully </h2>', 'success');
                        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
                    } else {
    
                        Alert::Html('Warning', '<h2> Something Went Wrong </h2>', 'warning');
                        return redirect()->route('gamer.tournaments.edit',Auth::guard('gamer')->user()->id);
                    }
                } else {
                    Alert::Html('Warning', '<h2> Something Went Wrong </h2>', 'warning');
                    return redirect()->route('gamer.tournaments.edit',Auth::guard('gamer')->user()->id);
                }
            } else {
                Alert::Html('Warning', '<h2> Something Went Wrong </h2>', 'warning');
                return redirect()->route('gamer.tournaments.edit',Auth::guard('gamer')->user()->id);
            }
    
        }
    
    }

    public function destroy( $id ) {
        $tournaments = Tournaments::find( $id );
        $status = $tournaments->is_deleted;
        if ( $status == 0 ) {
            $tournaments->is_deleted = '1';
        } else {
            $tournaments->is_deleted = '0';
        }
        $tournaments->save();
        Alert::Html( 'Success', '<h2> Tournament Deleted Successfully </h2>', 'success' );
        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
    }

    public function changeStatus( $id ) {
        $tournaments = Tournaments::find( $id );
        $status = $tournaments->is_active;
        if ( $status == 1 ) {
            $tournaments->is_active = '0';
        } else {
            $tournaments->is_active = '1';
        }
        $tournaments->save();
        Alert::Html( 'Success', '<h2> Tournament Status Changed </h2>', 'success' );
        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
    }

    public function stopjoining( $id ) {
        $tournaments = Tournaments::find( $id );
        $status = $tournaments->stop_joining;
        if ( $status == 0 ) {
            $tournaments->stop_joining = '1';
        } else {
            $tournaments->stop_joining = '0';
        }
        $tournaments->save();
        Alert::Html( 'Success', '<h2> Tournament Joining Stopped </h2>', 'success' );
        return redirect()->route('gamer.tournaments.show',Auth::guard('gamer')->user()->id);
    }

    public function tournamentUsersList( $id ) {
        $tournament = Tournaments::where( 'id', $id )->first();
        $teamstage = Team_tournament_schedule::where( 'tournament_id', $id )->get();
        $stage = Gamer_tournament_schedule::where( 'tournament_id', $id )->get();
        if ( $stage->count() > 0 and $tournament->user_type == 1 ) {
            // dd('if');
            return redirect()
            ->route( 'gamer.tournaments.add_schedule', [$id] );
        } elseif ( $teamstage->count() > 0 and $tournament->user_type == 2 ) {
            // dd('elseif');
            return redirect()
            ->route( 'gamer.tournaments.add_teamschedule', [$id] );
        } else {
            if ( $tournament->tournament_type == '2' ) {
               
                if ( $tournament->user_type == '1' ) {
                    $tournamentList = Gamers_tournaments::where( 'tournament_id', $id )->select( 'gamers.*', 'gamers.id as gamer_id', 'gamers_tournaments.*' )
                    ->join( 'gamers', 'gamers.id', '=', 'gamers_tournaments.user_id' )
                    ->where( 'gamers_tournaments.room_code', '0' )
                    ->get();
                    $stage = DB::table( 'gamer_tournament_schedules' )->where( 'tournament_id', $id )->get();
                    return view( 'website.tournament.view_gamer_tournament_schedule', compact( 'tournamentList', 'tournament', 'stage' ) );
                } else {
                    $tournamentList = Teams_tournament::where( 'tournament_id', $id )->select( 'teams.*', 'teams.id as team_id', 'teams_tournaments.*' )
                    ->join( 'teams', 'teams.id', '=', 'teams_tournaments.team_id' )
                    ->where( 'teams_tournaments.room_code', '0' )
                    ->get();
                    $stage = DB::table( 'team_tournament_schedules' )->where( 'tournament_id', $id )->get();

                    return view( 'website.tournament.view_team_tournament_schedule', compact( 'tournamentList', 'tournament', 'stage' ) );
                }
            } else {
                if ( $tournament->user_type == '1' ) {
                    $platforms = str_replace( ',', '', $tournament->ps_number );
                    if ( $tournament->is_free == '1' ) {
                        $tournamentList = DB::table( 'orders' )->select( 'gamers.*', 'gamers.id as gamer_id', 'orders.*', 'orders.tournament_id as tournament_id', 'gamers_tournaments.room_code' )
                        ->join( 'gamers', 'gamers.id', '=', 'orders.user_id' )
                        ->join( 'gamers_tournaments', 'gamers_tournaments.user_id', '=', 'gamers.id' )
                        ->where( 'gamers_tournaments.room_code', '0' )
                        ->where( 'gamers_tournaments.tournament_id', $id )->where( 'orders.tournament_id', $id )->get();
                        $room = Tournament_rooms::where( 'tournament_id', $id )->get();
                        $count = $tournamentList->count();
                        if ( $count == 0 ) {
                            return redirect()->route( 'gamer.roomtournamentshow', [$id] );
                        }
                        return view( 'website.tournament.gamer_tournaments', compact( 'tournamentList', 'platforms', 'room', 'tournament' ) );
                    } else {
                        $tournamentList = Gamers_tournaments::where( 'tournament_id', $id )->select( 'gamers.*', 'gamers.id as gamer_id', 'gamers_tournaments.*' )
                        ->join( 'gamers', 'gamers.id', '=', 'gamers_tournaments.user_id' )
                        ->where( 'gamers_tournaments.room_code', '0' )
                        ->get();
                        $room = Tournament_rooms::where( 'tournament_id', $id )->get();
                        $count = $tournamentList->count();
                        if ( $count == 0 ) {
                            return redirect()->route( 'gamer.roomtournamentshow', [$id] );
                        }
                        return view( 'website.tournament.gamer_tournaments_free', compact( 'tournamentList', 'platforms', 'room', 'tournament' ) );
                    }
                } else {
                    $room = Tournament_rooms::where( 'tournament_id', $id )->get();
                    if ( $tournament->is_free == '0' ) {
                        $tournamentList = Teams_tournament::where( 'tournament_id', $id )->where( 'payment_status', '=', '1' )
                        ->select( 'teams.*', 'teams_tournaments.*' )
                        ->where( 'teams_tournaments.room_code', '0' )
                        ->join( 'teams', 'teams.id', '=', 'teams_tournaments.team_id' )
                        ->get();

                    } else {
                        $tournamentList = Teams_tournament::where( 'tournament_id', $id )->select( 'teams.*', 'teams_tournaments.*' )
                        ->join( 'teams', 'teams.id', '=', 'teams_tournaments.team_id' )
                        ->where( 'teams_tournaments.room_code', '0' )
                        ->get();
                    }
                    $count = $tournamentList->count();
                    if ( $count == 0 ) {
                        return redirect()->route( 'gamer.roomtournamentshowteam', [$id] );
                    }
                    $platforms = str_replace( ',', '', $tournament->ps_number );
                    return view( 'website.tournament.team_tournaments', compact( 'tournamentList', 'platforms', 'room', 'tournament' ) );
                }
            }
        }
    }

    public function viewTournamentRoom( $id ) {
        $roomData = Tournament_rooms::with( 'get_tournament.game_name' )->where( 'tournament_id', '=', $id )->get();
        return view( 'website.tournament.view_tournament_room', compact( 'roomData' ) );
    }

    public function autocomplete( Request $request ) {
        $data = Tournaments::select( 'name' )->where( 'name', 'LIKE', "%{$request->input('query') }%" )
        ->get();
        return response()
        ->json( $data );

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
            return view( 'website.tournament.gamer_tournament_schedule.details', compact( 'gamertournamentschedule' ) );
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

            return view( 'website.tournament.team_tournament_schedule.details', compact( 'teamtournamentschedule' ) );
        }
    }

    public function message(Request $request){

        // dd($request->all());
        $request->validate([
            'sms' => ['required']
        ]);
       
        $StoreData =  new TournamentChat;
        $StoreData->tournament_id = $request->tournament_id;
        $StoreData->gamer_id = $request->gamer_id;
        $StoreData->message = $request->sms;
        $StoreData->sms_to = $request->sms_to;
        $StoreData->tournament_creator = $request->creator;
        
        $StoreData->save();
        if ($StoreData) {
            // return redirect()->back();
            return response()->json(['status' => 200, 'data' => $StoreData]);
            // return response()->json( $StoreData );
        } 
    }

    public function ChatList($id){
        $creator = Tournaments::where('id', $id)->first();
        $data = TournamentChat::where('tournament_id', $id)->where('gamer_id', '!=', $creator->gamer_id)->groupBy('gamer_id')->orderBy('id', 'DESC')->get();
        return view('website/tournament/chat_list', compact('data'));
    }
}

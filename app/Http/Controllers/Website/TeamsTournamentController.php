<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Teams_tournament;
use App\Models\Teams;
use App\Models\Tournaments;
use App\Models\TeamPlayers;
use Illuminate\Http\Request;
use App\Models\Tournament_rooms;
use App\Models\TournamentRoomSlot;
use Alert;
use Illuminate\Support\Facades\DB;

class TeamsTournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamstournament = Teams_tournament::where('teams_tournaments.is_deleted', 0)->select("teams_tournaments.*", "teams_tournaments.id as ttid", "tournaments.name as tournaments", "teams.team_name as teams")
            ->leftJoin("tournaments", "tournaments.id", "=", "teams_tournaments.tournament_id")
            ->leftJoin("teams", "teams.id", "=", "teams_tournaments.team_id")
            ->get();
        $teamsplayers = TeamPlayers::where('is_deleted', 0)->get();
        return view('website.tournament.teams_tournament.index', compact('teamstournament', 'teamsplayers'));
    }
    public function teamname($id)
    {
        $tour = Tournaments::find($id);
        $team_name = (isset($_GET['team_name']) && $_GET['team_name'] != '') ? $_GET['team_name'] : '';
        if ($tour->tournament_type == 1 )
        {
            if ($team_name != '')
            {
                $teamstournament = Teams_tournament::where('teams_tournaments.is_deleted', 0)->where(function ($query) use ($team_name)
                {
                    $query->where('teams.team_name', 'like', '%' . $team_name . '%');
                    $query->orWhere('gamers.fname', 'like', '%' . $team_name . '%');
                    $query->orWhere('gamers.lname', 'like', '%' . $team_name . '%');
                    $query->orWhere('gamers.email', 'like', '%' . $team_name . '%');
                    $query->orWhere('gamers.mobile', 'like', '%' . $team_name . '%');
                    $query->orWhere('teams_tournaments.in_game_name', 'like', '%' . $team_name . '%');
                    $query->orWhere('teams_tournaments.in_game_id', 'like', '%' . $team_name . '%');
                })->select("teams_tournaments.*", "teams_tournaments.id as ttid", "tournaments.name as tournaments", "teams.team_name as teams", "teams.id as team_id", "gamers.fname", "gamers.lname", "gamers.email", "gamers.mobile")
                    ->leftJoin("tournaments", "tournaments.id", "=", "teams_tournaments.tournament_id")
                    ->leftJoin("teams", "teams.id", "=", "teams_tournaments.team_id")
                    ->leftJoin("gamers", "teams.gamer_id", "=", "gamers.id")
                    ->where('tournaments.id', $id)->get();

            }
            else
            {
                $teamstournament = Teams_tournament::where('teams_tournaments.is_deleted', 0)->select("teams_tournaments.*", "teams_tournaments.id as ttid", "tournaments.name as tournaments", "teams.team_name as teams", "teams.id as team_id", "gamers.fname", "gamers.lname", "gamers.email", "gamers.mobile")
                    ->leftJoin("tournaments", "tournaments.id", "=", "teams_tournaments.tournament_id")
                    ->leftJoin("teams", "teams.id", "=", "teams_tournaments.team_id")
                    ->leftJoin("gamers", "teams.gamer_id", "=", "gamers.id")
                    ->where('tournaments.id', $id)->get();
            }
               $tournamentrooms = Tournament_rooms::where('tournament_rooms.is_deleted', 0)->where('tournament_rooms.tournament_id', $id)->select("tournament_rooms.*", "tournaments.name as tournaments")
                ->leftJoin("tournaments", "tournaments.id", "=", "tournament_rooms.tournament_id")
                ->get();
            return view('website.tournament.teams_tournament.index', compact('teamstournament', 'id', 'tournamentrooms'));
        }
        elseif ($tour->tournament_type == 2 )
        {
            $teamstournament = Teams_tournament::where('is_deleted', 0)
                ->where('tournament_id', $id)->get();
                
            $tournamentrooms = Tournament_rooms::where('tournament_rooms.is_deleted', 0)->where('tournament_rooms.tournament_id', $id)->select("tournament_rooms.*", "tournaments.name as tournaments")
                ->leftJoin("tournaments", "tournaments.id", "=", "tournament_rooms.tournament_id")
                ->get();
                
            return view('website.tournament.teams_tournament.fifaindex', compact('teamstournament', 'id',  'tournamentrooms'));
        }

    }
    public function changeteams($id)
    {
        $teams = Teams::all();
        $tournaments = Tournaments::find($id);
        return view('website.tournament.teams_tournament.create', compact('teams', 'tournaments'));
    }

    public function create()
    {
        $teams = Teams::all();
        $tournaments = Tournaments::where('tournaments.user_type', '2')->get();
        return view('website.tournament.teams_tournament.create', compact('teams', 'tournaments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tour = Tournaments::find($request->tournament_id);
        $curr_time = date("Y-m-d G:i:s");
        $end_time = $tour->reg_end_date . ' ' . $tour->reg_end_time;
        if ($curr_time > $end_time || $tour->stop_joining == 1)
        {
            Alert::Html('Success', '<h2>Tournament registration is now closed</h2>', 'success');
            return redirect()->back();
        }
        else
        {
            $TeamPlayers = TeamPlayers::where('team_id', $request->team_id)
                ->first();
              
            if ($TeamPlayers->ingame_name == null)
            {
                Alert::Html('Success', '<h2> In Game Details is blank </h2>', 'success');
                return redirect()
                    ->back();
            }
            $playerjoined = Teams_tournament::WHERE('tournament_id', $request->tournament_id)
                ->where('team_id', $request->team_id)
                ->count();
            $playerjoinedcount = Teams_tournament::WHERE('tournament_id', $request->tournament_id)
                ->count();
            $playercount = $tour->max_players - $playerjoinedcount;
            if ($playercount > 0)
            {
                if ($playerjoined >= 1)
                {
                    Alert::Html('<h2> Teams Tournaments Already Joined </h2>', 'warning');
                    return redirect()->back();
                }
                else
                {
                    $id = $request->tournament_id;
                    $teamstournament = new Teams_tournament;
                    $teamstournament->team_id = $request->team_id;
                    $teamstournament->tournament_id = $request->tournament_id;
                    $teamstournament->in_game_name = $TeamPlayers->ingame_name;
                    $teamstournament->in_game_id = $TeamPlayers->ingame_id;
                    $teamstournament->save();
                    Alert::Html('Success', '<h2> Teams Tournament Added Successfully </h2>', 'success');
                    return redirect()
                        ->back();
                }
            }
            else
            {
                Alert::Html('<h2> Tournament is Full </h2>', 'warning');
                return redirect()
                    ->back();
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teams_tournament  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teamstournament = Teams_tournament::find($id);
        return view('website.tournament.teams_tournament.show', compact('teamstournament'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teams_tournament  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teams = Teams::all();
        $tournaments = Tournaments::all();
        $teamstournament = Teams_tournament::find($id);
        $teamsname = Teams::find($teamstournament->team_id);
        $tournamentsname = Tournaments::find($teamstournament->tournament_id);
        return view('website.tournament.teams_tournament.edit', compact('teams', 'tournaments', 'teamstournament', 'teamsname', 'tournamentsname'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teams_tournament  $teams_tournament
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $teamstournament = new Teams_tournament;
        $teamstournament->team_id = $request->team_id;
        $teamstournament->room_code = $request->room_code;
        $teamstournament->tournament_id = $request->tournament_id;
        $teamstournament->point = $request->point;
        $teamstournament->payment_status = $request->payment_status;
        $teamstournament->score = $request->score;
        $teamstournament->earning = $request->earning;
        $teamstournament->currency_id = $request->currency_id;
        $teamstournament->status = $request->status;
        $teamstournament->save();
        Alert::Html('Success', '<h2> Teams Tournament Updated Successfully </h2>', 'success');
        return redirect("teamstournament");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teams_tournament  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teamstournament = Teams_tournament::find($id);
        $status = $teamstournament->is_deleted;
        if ($status == 0)
        {
            $teamstournament->is_deleted = '1';
        }
        else
        {
            $teamstournament->is_deleted = '0';
        }
        $teamstournament->save();
        Alert::Html('Success', '<h2> Teams Tournament Deleted Successfully </h2>', 'success');
        return redirect('teamstournament');
    }
    public function changeStatus($id)
    {
        $teamstournament = Teams_tournament::find($id);
        $status = $teamstournament->is_active;
        if ($status == 1)
        {
            $teamstournament->is_active = '0';
        }
        else
        {
            $teamstournament->is_active = '1';
        }
        $teamstournament->save();
        Alert::Html('Success', '<h2> Teams Tournament Status Changed </h2>', 'success');
        return redirect('teamstournament');
    }

    public function roomSchedule(Request $request)
    {

        $room_code = $request->room_code;
        $password = $request->password;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $tournament_id = $request->tournament_id;

        // $teamstournaments = Teams_tournament::select("teams_tournaments.*", 'teams_tournaments.id as gtid', "tournaments.name as tname","teams.*","tournament_room_slots.slot_number")
        // ->leftJoin("tournaments", "tournaments.id", "=", "teams_tournaments.tournament_id")
        // ->leftjoin("teams","teams.id","=","teams_tournaments.team_id")
        // ->leftjoin("tournament_room_slots","teams_tournaments.team_id","=","tournament_room_slots.team_id")
        // ->where('teams_tournaments.is_deleted', 0)
        // ->where ('teams_tournaments.room_code',$room_code)
        // ->where ('tournaments.user_type','1')
        // ->get();
        // $teamstournaments = DB::select("select teams_tournaments.*, teams.team_name, gamers.email,
        //     gamers.fname, gamers.lname, tournaments.name as tname, tournament_room_slots.slot_number
        //     from teams_tournaments join teams
        //     on (teams_tournaments.team_id= teams.id)
        //     join gamers
        //     on (teams.gamer_id=gamers.id)
        //     join tournaments
        //     on (teams_tournaments.tournament_id=tournaments.id)
        //     join tournament_room_slots
        //     on (tournaments.id = tournament_room_slots.tournament_id)
        //     where teams_tournaments.tournament_id='$tournament_id' and teams_tournaments.room_code='$room_code'");
        $teamstournaments = DB::select("select tournament_room_slots.slot_number, teams.team_name, gamers.email,
            gamers.fname, gamers.lname, tournaments.name as tname
            from tournament_room_slots join teams
            on (tournament_room_slots.team_id=teams.id)
            join tournaments
            on (tournament_room_slots.tournament_id=tournaments.id)
            join gamers
            on (teams.gamer_id=gamers.id)
             where tournament_room_slots.tournament_id='$tournament_id' and tournament_room_slots.room_code='$room_code'");

        // echo "<pre>";
        // print_r($teamstournaments);
        // die("xyz");
        DB::update(DB::raw("update tournament_room_slots set password='$password',start_date='$start_date',end_date='$end_date',start_time='$start_time',end_time='$end_time' where room_code='$room_code'"));

        // $slotUpdate = TournamentRoomSlot::where("room_code",$room_code)->get();
        // $slotUpdate->password = $password;
        // $slotUpdate->start_date = $start_date;
        // $slotUpdate->end_date = $end_date;
        // $slotUpdate->start_time = $start_time;
        // $slotUpdate->end_time = $end_time;
        // $slotUpdate->save();
        

        foreach ($teamstournaments as $team)
        {
            $email = $team->email;
            $fname = $team->fname;
            $lname = $team->lname;
            $tname = $team->tname;
            $slot_number = $team->slot_number;

            $to = $email;
            $subject = 'Upcoming tournament information';

            $message = "Hi $fname $lname,<br>
                        Following are your upcoming tournament details<br>
                        Tournament Name : $tname<br>
                        Room Code : $room_code<br>
                        Slot : $slot_number<br>
                        Password : $password<br>
                        Start Date : $start_date , $start_time<br>
                        <br>
                        Kind Regards,<br>
                        Team - LetsGameNow<br>
                        ";

            $header = "From: LetsGameNow<info@letsgamenow.com> \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail($to, $subject, $message, $header);

            // echo $msg1 = "Hi%20Soham,%20$tname%20will%20start%20from%20$start_time%20on%20$start_date.%20Your%20room%20code%20will%20be%20$room_code,%20slot%20$slot_number%20and%20password%20will%20be%20$password.";
            // $customer_mobile = $team->mobile;
            //  $ch = curl_init();
            // // Set query data here with the URL
            // echo $url1 = "http://203.212.70.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=$customer_mobile&from=LGNEST&text=$msg1";
            // curl_setopt($ch, CURLOPT_URL, $url1);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            // $content = curl_exec($ch);
            // //echo $content;
            // //die();
            // curl_close($ch);
            
        }
        //die();
        Alert::Html('Success', '<h2> Room Password Updated Successfully </h2>', 'success');
        return redirect()->back();
    }

    public function teamroomSchedulemail(Request $request)
    {
        $room_code = $request->room_code;
        $subject = $request->subject;
        $messagemail = $request->messagemail;

        $teamstournaments = DB::select("select tournament_room_slots.slot_number, gamers.email,
        gamers.fname, gamers.lname from tournament_room_slots join gamers
        on (tournament_room_slots.gamer_id=gamers.id)
         where  tournament_room_slots.room_code='$room_code'");
        foreach ($teamstournaments as $gamer)
        {
            $email = $gamer->email;
            // dd($email);
            $to = $email;
            $message = $messagemail;
            $header = "From: LetsGameNow<info@letsgamenow.com> \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail($to, $subject, $message, $header);

            Alert::Html('Success', '<h2> Room Mail Successfully </h2>', 'success');
            return redirect()->back();

        }

    }

    public function sendMail(Request $request)
    {
        $tournament_id = $request->tournament_id;
        $subject = $request->subject;
        $message = $request->message;

        // $teamstournaments = Teams_tournament::select("teams_tournaments.*","teams.team_name","gamers.email")
        // ->leftjoin("teams","teams_tournaments.team_id","=","teams.id")
        // ->leftjoin("gamers","teams.gamer_id","=","gamers.id")
        // ->where('teams_tournaments.is_deleted', 0)
        // ->where ('teams_tournaments.tournament_id',$tournament_id)
        // ->get();
        $teamstournaments = DB::select("select teams_tournaments.*, teams.team_name, gamers.email
            from teams_tournaments join teams
            on (teams_tournaments.team_id= teams.id)
            join gamers
            on (teams.gamer_id=gamers.id)
            where teams_tournaments.tournament_id='$tournament_id'");

        // echo "<pre>";
        // print_r($teamstournaments);
        // die("xyz");
        foreach ($teamstournaments as $team)
        {
            $email = $team->email;
            $to = $email;

            $header = "From: LetsGameNow<info@letsgamenow.com> \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail($to, $subject, $message, $header);

            //echo $retval;
            //die("xyz");
            
        }

        Alert::Html('Success', '<h2> Email sent to all the joiners of this tournament </h2>', 'success');
        return redirect()->back();
    }

}


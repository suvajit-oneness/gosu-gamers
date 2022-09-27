<?php
namespace App\Http\Controllers;

use App\Models\Tournaments;
use App\Models\Gamer;
use App\Models\Game;
use App\Models\Gamers_tournaments;
use App\Models\Tournament_rooms;
use App\Models\TournamentRoomSlot;
use App\Models\GamerPlatfromDetail;
use Illuminate\Http\Request;
use Alert;
use DB;
class GamersTournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamerstournaments = Gamers_tournaments::where('gamers_tournaments.is_deleted', 0)->select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tournaments", "gamers.*")
            ->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
            ->join("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
            ->where('tournaments.user_type', '1')
            ->get();
        return view('admin.gamers_tournaments.index', compact('gamerstournaments'));
    }

    public function gamerteam($id)
    {
        $tour = Tournaments::find($id);
            
        if ($tour->user_type == '1')
        {
            return $this->gamer($id, $tour);
        }

        return redirect('teamstournamentname/'  . $id);
    }

    public function gamer($id, $tour)
    {
        $gamer_name = (isset($_GET['gamer_name']) && $_GET['gamer_name'] != '') ? $_GET['gamer_name'] : '';
        if (($tour->tournament_type == 1 ))
        {
            if ($gamer_name != '')
            {
                $gamerstournaments = Gamers_tournaments::where('gamers_tournaments.is_deleted', 0)->where(function ($query) use ($gamer_name)
                {
                    $query->where('gamers.fname', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers.lname', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers.email', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers.mobile', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers_tournaments.in_game_id', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers_tournaments.in_game_name', 'like', '%' . $gamer_name . '%');
                })->select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tournaments", "gamers.*")
                    ->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
                    ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
                    ->where(['tournaments.id' => $id, 'tournaments.user_type' => '1'])->get();

            }
            else
            {
                $gamerstournaments = Gamers_tournaments::where('gamers_tournaments.is_deleted', 0)->select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tournaments", "gamers.*")
                    ->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
                    ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
                    ->where('tournaments.id', $id)->where('tournaments.user_type', '1')
                    ->get();
            }

            $tournamentrooms = Tournament_rooms::where('tournament_rooms.is_deleted', 0)->where('tournament_rooms.tournament_id', $id)->select("tournament_rooms.*", "tournaments.name as tournaments")
                ->leftJoin("tournaments", "tournaments.id", "=", "tournament_rooms.tournament_id")
                ->get();
            return view('admin.gamers_tournaments.index', compact('gamerstournaments', 'tournamentrooms', 'id'));
        }
        elseif (($tour->tournament_type == 2 ))
        {
            $gamer_name = (isset($_GET['gamer_name']) && $_GET['gamer_name'] != '') ? $_GET['gamer_name'] : '';
            if ($gamer_name != '')
            {
                $gamerstournaments = Gamers_tournaments::where('gamers_tournaments.is_deleted', 0)->select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tournaments", "gamers.*")->where(function ($query) use ($gamer_name)
                {
                    $query->where('gamers.fname', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers.lname', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers.email', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers.mobile', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers_tournaments.in_game_id', 'like', '%' . $gamer_name . '%');
                    $query->orWhere('gamers_tournaments.in_game_name', 'like', '%' . $gamer_name . '%');
                })->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
                    ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
                    ->where('tournaments.id', $id)->where('tournaments.user_type', '1')
                    ->get();
            }
            else
            {
                $gamerstournaments = Gamers_tournaments::where('gamers_tournaments.is_deleted', 0)->select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tournaments", "gamers.*")
                    ->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
                    ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
                    ->where('tournaments.id', $id)->where('tournaments.user_type', '1')
                    ->get();
            }

            $tournamentrooms = Tournament_rooms::where('tournament_rooms.is_deleted', 0)->where('tournament_rooms.tournament_id', $id)->select("tournament_rooms.*", "tournaments.name as tournaments")
                ->leftJoin("tournaments", "tournaments.id", "=", "tournament_rooms.tournament_id")
                ->get();
            return view('admin.gamers_tournaments.fifaindex', compact('gamerstournaments', 'tournamentrooms', 'id'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tournaments = Tournaments::where('id', $id)->get();
        // $gamer = Gamer::select('id', 'fname', 'lname', 'email', 'mobile')->where('is_deleted', 0)->where('gamer_type', 1)->distinct()->get();
        $gamer = Gamer::where('is_active', 1)->where('is_deleted', 0)->where('gamer_type', 1)->groupBy('email')->orderBy('fname', 'ASC')->get();
        return view('admin.gamers_tournaments.create', compact('tournaments', 'gamer'));
        
    }
   
    public function gamerstournamentschange($id)
    {
        $tournaments = Tournaments::find($id);
        $gamer = Gamer::where('is_deleted', 0)->where('gamer_type', 1)
            ->get();
        return view('admin.gamers_tournaments.create', compact('tournaments', 'gamer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request->all());
       
        $tour = Tournaments::find($request->tournaments_id);
        $curr_time = date("Y-m-d G:i:s");
        $end_time = $tour->reg_end_date . ' ' . $tour->reg_end_time;
        // dd($curr_time);
        if ($curr_time > $end_time || $tour->stop_joining == 1)
        {
            Alert::Html('Success', '<h2>Tournament registration is now closed</h2>', 'success');
            return redirect()->back();
        }
        else
        {
            // dd($request->user_id);
            // $gamers = GamerPlatfromDetail::where('gamer_id', $request->user_id)
            //     ->first();
            //     // dd($gamers);
            // if (!isset($gamers))
            // {
            //     Alert::Html('Success', '<h2> In Game Details is blank </h2>', 'success');
            //     return redirect()->back();
            // }

            $playerjoined = Gamers_tournaments::WHERE('tournament_id', $request->tournaments_id)
                ->where('user_id', $request->user_id)
                ->count();
            $playerjoinedcount = Gamers_tournaments::WHERE('tournament_id', $request->tournaments_id)
                ->count();
            $playercount = $tour->max_players - $playerjoinedcount;

            if ($playercount > 0)
            {
                if ($playerjoined >= 1)
                {
                    Alert::Html('<h2> Gamers Tournaments Already Joined </h2>', 'warning');
                    return redirect()->back();
                }
                else
                {
                    $user_id = $request->user_id;
                   $id = $request->tournaments_id;
                   foreach($user_id as $key =>$data){
                          $gamerstournaments = new Gamers_tournaments;
                        $gamerstournaments->tournament_id = $request->tournaments_id;
                        $gamerstournaments->user_id = $data;
                        $gamerstournaments->save();
                       
                   }
                    
                    Alert::Html('Success', '<h2> Gamers Tournaments Added Successfully </h2>', 'success');
                    return redirect('gamerteam/'.$id);
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
     * @param  \App\Models\Gamers_tournaments  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gamerstournaments = Gamers_tournaments::find($id);
        return view('admin.gamers_tournaments.show', compact('gamerstournaments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gamers_tournaments  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gamerstournaments = Gamers_tournaments::find($id);
        $gamerstourname = Tournaments::find($gamerstournaments->tournament_id);
        $tournaments = Tournaments::all();
        return view('admin.gamers_tournaments.edit', compact('gamerstournaments', 'tournaments', 'gamerstourname'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gamers_tournaments  $gamers_tournaments
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $gamerstournaments = Gamers_tournaments::find($request->id);
        $gamerstournaments->tournament_id = $request->tournaments_id;
        $gamerstournaments->user_id = $request->user_id;
        $gamerstournaments->room_code = $request->room_code;
        $gamerstournaments->point = $request->point;
        $gamerstournaments->payment_status = $request->payment_status;
        $gamerstournaments->score = $request->score;
        $gamerstournaments->earning = $request->earning;
        $gamerstournaments->currency_id = $request->currency_id;
        $gamerstournaments->status = $request->status;
        $gamerstournaments->save();
        Alert::Html('Success', '<h2> Gamers Tournaments updated Successfully </h2>', 'success');
        return redirect("gamerstournaments");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gamers_tournaments  $gamers_tournaments
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $gamerstournaments = Gamers_tournaments::find($id);
        $status = $gamerstournaments->is_deleted;

        if ($status == 0)
        {
            $gamerstournaments->is_deleted = '1';
        }
        else
        {
            $gamerstournaments->is_deleted = '0';
        }
        $gamerstournaments->save();

        Alert::Html('Success', '<h2> Gamers Tournaments Deleted Successfully </h2>', 'success');
        return redirect('gamerstournaments');
    }

    public function changeStatus($id)
    {

        $gamerstournaments = Gamers_tournaments::find($id);
        $status = $gamerstournaments->is_active;

        if ($status == 1)
        {
            $gamerstournaments->is_active = '0';

        }
        else
        {
            $gamerstournaments->is_active = '1';
        }
        $gamerstournaments->save();

        Alert::Html('Success', '<h2> Gamers Tournaments Status Changed </h2>', 'success');
        return redirect('gamerstournaments');
    }

    public function roomSchedule(Request $request)
    {

        $room_code = $request->room_code;
        $room_id = $request->room_id;
        $password = $request->password;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        $gamerstournaments = Gamers_tournaments::select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tname", "gamers.*", "tournament_room_slots.slot_number")->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
            ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
            ->leftjoin("tournament_room_slots", "gamers_tournaments.user_id", "=", "tournament_room_slots.gamer_id")
            ->where('gamers_tournaments.is_deleted', 0)
            ->where('gamers_tournaments.room_code', $room_code)->where('tournaments.user_type', '1')
            ->get();

        DB::update(DB::raw("update tournament_room_slots set password='$password',start_date='$start_date',end_date='$end_date',start_time='$start_time',end_time='$end_time' where room_code='$room_code'"));

        $slotUpdate = TournamentRoomSlot::where('room_code', $room_code)->first();
        $slotUpdate->password = $password;
        $slotUpdate->start_date = $start_date;
        $slotUpdate->end_date = $end_date;
        $slotUpdate->start_time = $start_time;
        $slotUpdate->end_time = $end_time;
        $slotUpdate->save();

        foreach ($gamerstournaments as $gamer)
        {
            $email = $gamer->email;
            $fname = $gamer->fname;
            $lname = $gamer->lname;
            $tname = $gamer->tname;
            $slot_number = $gamer->slot_number;

            $to = $email;
            $subject = 'Upcoming tournament information';

            $message = "Hi $fname $lname,<br>
                        Following are your upcoming tournament details<br>
                        Tournament Name : $tname<br>
                        Room Id : $room_id<br>
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

            // //echo $msg1 = "Hi%20$fname,%20$tname%20will%20start%20from%20$start_time%20on%20$start_date.%20Your%20room%20code%20will%20be%20$room_code,%20slot%20$slot_number%20and%20password%20will%20be%20$password.";
            // $customer_mobile = $gamer->mobile;
            //  $ch = curl_init();
            // // Set query data here with the URL
            // //echo $url1 = "http://203.212.70.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=$customer_mobile&from=LGNEST&text=$msg1";
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

    public function roomSchedulemail(Request $request)
    {

        $room_code = $request->room_code;
        $subject = $request->subject;
        $messagemail = $request->messagemail;

        $gamerstournaments = Gamers_tournaments::select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tname", "gamers.*", "tournament_room_slots.slot_number")->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
            ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
            ->leftjoin("tournament_room_slots", "gamers_tournaments.user_id", "=", "tournament_room_slots.gamer_id")
            ->where('gamers_tournaments.is_deleted', 0)
            ->where('gamers_tournaments.room_code', $room_code)->where('tournaments.user_type', '1')
            ->get();
        foreach ($gamerstournaments as $gamer)
        {
            $email = $gamer->email;
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

        $gamerstournaments = Gamers_tournaments::select("gamers_tournaments.*", 'gamers_tournaments.id as gtid', "tournaments.name as tname", "gamers.*", "tournament_room_slots.slot_number")->leftJoin("tournaments", "tournaments.id", "=", "gamers_tournaments.tournament_id")
            ->leftjoin("gamers", "gamers.id", "=", "gamers_tournaments.user_id")
            ->leftjoin("tournament_room_slots", "gamers_tournaments.user_id", "=", "tournament_room_slots.gamer_id")
            ->where('gamers_tournaments.is_deleted', 0)
            ->where('gamers_tournaments.tournament_id', $tournament_id)->where('tournaments.user_type', '1')
            ->get();

        foreach ($gamerstournaments as $gamer)
        {
            $email = $gamer->email;
            $to = $email;

            $header = "From: LetsGameNow<info@letsgamenow.com> \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail($to, $subject, $message, $header);

        }

        Alert::Html('Success', '<h2> Email sent to all the joiners of this tournament </h2>', 'success');
        return redirect()->back();
    }

    public function delete($id)
    {
        $teamstournament = Gamers_tournaments::find($id);
        $teamstournament->delete();
        Alert::Html('Success', '<h2> Gamer Deleted Successfully </h2>', 'success');
        return redirect()->back();
    }

}


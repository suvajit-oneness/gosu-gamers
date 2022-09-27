<?php
namespace App\Http\Controllers;

use App\Models\Tournament_rooms;
use App\Models\Tournaments;
use Illuminate\Http\Request;
use App\Models\TournamentRoomSlot;
use App\Models\Teams_tournament;
use App\Models\Gamers_tournaments;
use Validator;
use Alert;
use DB;

class TournamentRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournamentrooms = Tournament_rooms::where('tournament_rooms.is_deleted', 0)->select("tournament_rooms.*", "tournaments.name as tournaments")
            ->leftJoin("tournaments", "tournaments.id", "=", "tournament_rooms.tournament_id")
            ->get();
        return view('admin.tournament_rooms.index', compact('tournamentrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tournaments = Tournaments::all();
        return view('admin.tournament_rooms.create', compact('tournaments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(array(
            "tournaments_id" => $request->tournaments_id,
            "game_room_id" => $request->game_room_id,
            "room_code" => $request->room_code,
            "status" => $request->status,
        ) , array(
            "tournaments_id" => "required",
            "game_room_id" => "required",
            "room_code" => "required",
            "status" => "required",
        ));
        if ($validator->fails())
        {
            return redirect("tournamentrooms/create")
                ->withErrors($validator)->withInput();
        }
        else
        {
            $tournamentrooms = new Tournament_rooms;
            $tournamentrooms->tournament_id = $request->tournaments_id;
            $tournamentrooms->game_room_id = $request->game_room_id;
            $tournamentrooms->room_code = $request->room_code;
            $tournamentrooms->status = $request->status;
            $tournamentrooms->save();
            Alert::Html('Success', '<h2> Tournament Rooms Added Successfully </h2>', 'success');
            return redirect("tournamentrooms");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournament_rooms  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tournamentrooms = Tournament_rooms::find($id);
        return view('admin.tournament_rooms.show', compact('tournamentrooms'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournament_rooms  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tournaments = Tournaments::all();
        $tournamentrooms = Tournament_rooms::find($id);
        $tournamentsname = Tournaments::find($tournamentrooms->tournament_id);
        return view('admin.tournament_rooms.edit', compact('tournamentrooms', 'tournaments', 'tournamentsname'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tournament_rooms  $tournament_rooms
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $tournamentrooms = Tournament_rooms::find($request->id);
        $tournamentrooms->tournament_id = $request->tournaments_id;
        $tournamentrooms->game_room_id = $request->game_room_id;
        $tournamentrooms->room_code = $request->room_code;
        $tournamentrooms->status = $request->status;
        $tournamentrooms->save();
        Alert::Html('Success', '<h2> Tournament Rooms Updated Successfully </h2>', 'success');
        return redirect("tournamentrooms");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament_rooms  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournamentrooms = Tournament_rooms::find($id);
        $status = $tournamentrooms->is_deleted;

        if ($status == 0)
        {
            $tournamentrooms->is_deleted = '1';
        }
        else
        {
            $tournamentrooms->is_deleted = '0';
        }
        $tournamentrooms->save();
        Alert::Html('Success', '<h2> Tournament Rooms Deleted Successfully </h2>', 'success');
        return redirect('tournamentrooms');
    }
    public function changeStatus($id)
    {
        $tournamentrooms = Tournament_rooms::find($id);
        $status = $tournamentrooms->is_active;
        if ($status == 1)
        {
            $tournamentrooms->is_active = '0';
        }
        else
        {
            $tournamentrooms->is_active = '1';
        }
        $tournamentrooms->save();
        Alert::Html('Success', '<h2> Tournament Rooms Status Changed </h2>', 'success');
        return redirect('tournamentrooms');
    }

    public function assignroom(Request $request)
    {
        $tournaments = Tournaments::find($request->tournament_id);
        $gamer_id = $request->gamer_id;
        $pos = 0;
        foreach ($gamer_id as $value)
        {
            if ($value == null)
            {
                Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
                return redirect('tournaments');
            }
            DB::update(DB::raw("UPDATE `gamers_tournaments` SET `point`=`point` + 1, `room_code`='$request->room' where `user_id`='$value' and `tournament_id`=$request->tournament_id"));
            $TournamentRoomSlot = new TournamentRoomSlot;
            $TournamentRoomSlot->tournament_id = $request->tournament_id;
            $TournamentRoomSlot->room_code = $request->room;
            $TournamentRoomSlot->slot_number = $pos + 1;
            $TournamentRoomSlot->gamer_id = $value;
            $TournamentRoomSlot->save();
            $pos++;
        }
        Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
        return redirect('tournaments');
    }
    public function teamassignroom(Request $request)
    {
        // dd($request->all());
        // $tournaments = Tournaments::find($request->tournament_id);
        // $room_code = $request->room_code;
        // $team_id = $request->team_id;

        // for($i = 0; $i <= $room_size; $i++) {
            
        //         $TournamentRoomSlot = new TournamentRoomSlot;
        //         $TournamentRoomSlot->tournament_id = $request->tournament_id;
        //         $TournamentRoomSlot->room_code = $request->room_code[$i];
        //         $TournamentRoomSlot->team_id = $teamValue;
        //         $TournamentRoomSlot->save();
        //     }
        // }
        /*foreach($request->room_code as $roomKey => $roomValue){
           
                // dd($room_size);
                // if ($value == null)
                // {
                //     Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
                //     return redirect('tournaments');
                // }
                // DB::update(DB::raw("UPDATE `teams_tournaments` SET `point`=`point` + 1, `room_code`='$request->room' where `team_id`='$value' and `tournament_id`=$request->tournament_id
                // "));
                for($i =1; $i<=$room_size; $i++){
                    foreach ($team_id as $teamkey => $value)
                    {
                    $TournamentRoomSlot = new TournamentRoomSlot;
                    $TournamentRoomSlot->tournament_id = $request->tournament_id;
                    // $TournamentRoomSlot->slot_number = $pos + 1;
                    $TournamentRoomSlot->room_code = $roomValue;
                    $TournamentRoomSlot->team_id = $value;
                    // dd($TournamentRoomSlot);
                    $TournamentRoomSlot->save();
                    // $pos++;
                    }
                }
            // }
        }
        */
        Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
        return redirect('tournaments'); 
    }

    public function teamassignroomsingle($id)
    {
        $tournaments = Tournaments::find($id);
        $tournaroom = Tournament_rooms::where('tournament_id', $tournaments->id)
            ->get();
        $count = count($tournaroom);

        for ($i = 0;$i < $count;$i++)
        {
            $room_code = $tournaroom[$i]->room_code;
            $team_id = Teams_tournament::where('tournament_id', $tournaments->id)
                ->where('room_code', '0')
                ->select('team_id')
                ->get();

            foreach ($team_id as $value)
            {
                $maxlimitroom = ($tournaments->max_players / $count);

                $roomplayercount = TournamentRoomSlot::where('tournament_id', $tournaments->id)
                    ->where('room_code', $room_code)->count();

                $left = $maxlimitroom - $roomplayercount;

                if ($left > 0)
                {
                    $pos = 0;
                    if ($value == null)
                    {
                        die("abc");
                        Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
                        return redirect('tournaments');
                    }

                    DB::update(DB::raw("UPDATE `teams_tournaments` SET `point`=`point` + 1, `room_code`='$room_code' where `team_id`='$value->team_id' and `tournament_id`=$tournaments->id
                        "));

                    $roomslot = TournamentRoomSlot::where('tournament_id', $id)->where('room_code', $room_code)->orderBy('slot_number', 'DESC')
                        ->first();

                    if ($roomslot)
                    {
                        $pos = $roomslot->slot_number;
                    }
                    else
                    {
                        $pos = 0;
                    }

                    $TournamentRoomSlot = new TournamentRoomSlot;
                    $TournamentRoomSlot->tournament_id = $tournaments->id;
                    $TournamentRoomSlot->room_code = $room_code;
                    $TournamentRoomSlot->slot_number = $pos + 1;
                    $TournamentRoomSlot->team_id = $value->team_id;
                    $TournamentRoomSlot->save();

                }

            }

        }
        Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
        return redirect('tournaments');
    }

    //     $tournaments= Tournaments::find($id);
    //     $tournaroom= Tournament_rooms::where('tournament_id',$tournaments->id)->first();
    //     $team_id= Teams_tournament::where('tournament_id',$tournaments->id)
    //         ->where('room_code','0')
    //         ->select('team_id')->get();
    //        foreach ($team_id as $value) {
    //         if ($value== null) {
    //         Alert::Html('Success', '<h2> Room Assigned </h2>','success');
    //         return redirect('tournaments');
    //               }
    //  DB::update( DB::raw("UPDATE `teams_tournaments` SET `point`=`point` + 1, `room_code`='$tournaroom->room_code' where `team_id`='$value->team_id' and `tournament_id`=$tournaments->id
    //  ") );
    //  $roomslot= TournamentRoomSlot::where('tournament_id',$id)->orderBy('slot_number', 'DESC')->first();
    //     if($roomslot){
    //          $pos = $roomslot->slot_number;
    //     }else{
    //         $pos = 0;
    //     }
    //     $TournamentRoomSlot = new TournamentRoomSlot;
    //     $TournamentRoomSlot->tournament_id=$tournaments->id;
    //     $TournamentRoomSlot->room_code= $tournaroom->room_code;
    //     $TournamentRoomSlot->slot_number= $pos+1;
    //     $TournamentRoomSlot->team_id=$value->team_id;
    //     $TournamentRoomSlot->save();
    // }
    // Alert::Html('Success', '<h2> Room Assigned </h2>','success');
    //     return redirect('tournaments');
    

    public function assignroomsingle($id)
    {
        $tournaments = Tournaments::find($id);
        $tournaroom = Tournament_rooms::where('tournament_id', $tournaments->id)
            ->get();
        $count = count($tournaroom);
        for ($i = 0;$i < $count;$i++)
        {
            $room_code = $tournaroom[$i]->room_code;
            $gamer_id = Gamers_tournaments::where('tournament_id', $tournaments->id)
                ->where('room_code', '0')
                ->select('user_id')
                ->get();
            foreach ($gamer_id as $value)
            {
                $maxlimitroom = ($tournaments->max_players / $tournaments->room_size);
                $roomplayercount = TournamentRoomSlot::where('tournament_id', $tournaments->id)
                    ->where('room_code', $room_code)->count();
                $left = $maxlimitroom - $roomplayercount;
                if ($left > 0)
                {
                    if ($value == null)
                    {
                        Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
                        return redirect('tournaments');
                    }
                    DB::update(DB::raw("UPDATE `gamers_tournaments` SET `point`=`point` + 1, `room_code`='$room_code' where `user_id`='$value->user_id' and `tournament_id`=$tournaments->id
                "));
                    $roomslot = TournamentRoomSlot::where('tournament_id', $id)->where('room_code', $room_code)->orderBy('slot_number', 'DESC')
                        ->first();
                    if ($roomslot)
                    {
                        $pos = $roomslot->slot_number;
                    }
                    else
                    {
                        $pos = 0;
                    }
                    $TournamentRoomSlot = new TournamentRoomSlot;
                    $TournamentRoomSlot->tournament_id = $tournaments->id;
                    $TournamentRoomSlot->room_code = $room_code;
                    $TournamentRoomSlot->slot_number = $pos + 1;
                    $TournamentRoomSlot->gamer_id = $value->user_id;
                    $TournamentRoomSlot->save();
                }
            }

        }
        Alert::Html('Success', '<h2> Room Assigned </h2>', 'success');
        return redirect('tournaments');
    }

    // {
    //     $tournaments= Tournaments::find($id);
    //     $tournaroom= Tournament_rooms::where('tournament_id',$tournaments->id)->first();
    //     $gamer_id= Gamers_tournaments::where('tournament_id',$tournaments->id)
    //         ->where('room_code','0')
    //         ->select('user_id')->get();
    //        foreach ($gamer_id as $value) {
    //         if ($value== null) {
    //         Alert::Html('Success', '<h2> Room Assigned </h2>','success');
    //         return redirect('tournaments');
    //               }
    //  DB::update( DB::raw("UPDATE `gamers_tournaments` SET `point`=`point` + 1, `room_code`='$tournaroom->room_code' where `user_id`='$value->user_id' and `tournament_id`=$tournaments->id
    //  ") );
    //  $roomslot= TournamentRoomSlot::where('tournament_id',$id)->orderBy('slot_number', 'DESC')->first();
    //     if($roomslot){
    //          $pos = $roomslot->slot_number;
    //     }else{
    //         $pos = 0;
    //     }
    //     $TournamentRoomSlot = new TournamentRoomSlot;
    //     $TournamentRoomSlot->tournament_id=$tournaments->id;
    //     $TournamentRoomSlot->room_code= $tournaroom->room_code;
    //     $TournamentRoomSlot->slot_number= $pos+1;
    //     $TournamentRoomSlot->gamer_id=$value->user_id;
    //     $TournamentRoomSlot->save();
    // }
    // Alert::Html('Success', '<h2> Room Assigned </h2>','success');
    //     return redirect('tournaments');}
    

    
}


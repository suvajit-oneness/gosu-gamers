<?php

namespace App\Http\Controllers;

use App\Models\Gamer_tournament_point;
use App\Models\Gamer_tournament_schedule;
use Illuminate\Http\Request;
use Validator;
use Alert;

class GamerTournamentPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $gamertournamentpoint = Gamer_tournament_point::where('is_deleted', 0)->get();
        
        return view('admin.gamer_tournament_point.index', compact('gamertournamentpoint'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $gamertournamentschedule= Gamer_tournament_schedule::all();

        return view('admin.gamer_tournament_point.create', compact('gamertournamentschedule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make(array(
                    "schedule_id" => $request->schedule_id,
                    "player1_score" => $request->player1_score,
                    "player2_score" => $request->player2_score,
                    "player1_point" => $request->player1_point,
                    "player2_point" => $request->player2_point,
                    "winner" => $request->winner,
                        ), array(
                    "schedule_id" => "required",
                    "player1_score" => "required",
                    "player2_score" => "required",
                    "player1_point" => "required",
                    "player2_point" => "required",
                    "winner" => "required",
        ));
        if ($validator->fails()) {
            return redirect("gamertournamentpoint/create")->withErrors($validator)->withInput();
        } else {$gamertournamentpoint = new Gamer_tournament_point;
            $gamertournamentpoint->schedule_id = $request->schedule_id;
            $gamertournamentpoint->player1_score = $request->player1_score;
            $gamertournamentpoint->player2_score = $request->player2_score;
            $gamertournamentpoint->player1_point = $request->player1_point;
            $gamertournamentpoint->player2_point = $request->player2_point;
            $gamertournamentpoint->winner = $request->winner;
            $gamertournamentpoint->save();
            Alert::Html('Success', '<h2> Gamer Tournament Point Added Successfully </h2>','success');
            return redirect("gamertournamentpoint");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gamer_tournament_point  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
       $gamertournamentpoint = Gamer_tournament_point::find($id);
        return view('admin.gamer_tournament_point.show', compact('gamertournamentpoint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gamer_tournament_point  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gamertournamentschedule=Gamer_tournament_schedule::all();
        $gamertournamentpoint = Gamer_tournament_point::find($id);
        $gamertournamschedule= Gamer_tournament_schedule::find($gamertournamentpoint->schedule_id);
        return view('admin.gamer_tournament_point.edit', compact('gamertournamentpoint','gamertournamentschedule','gamertournamschedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gamer_tournament_point  $gamer_tournament_point
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $gamertournamentpoint =Gamer_tournament_point:: find($request->id);
            $gamertournamentpoint->schedule_id = $request->schedule_id;
            $gamertournamentpoint->player1_score = $request->player1_score;
            $gamertournamentpoint->player2_score = $request->player2_score;
            $gamertournamentpoint->player1_point = $request->player1_point;
            $gamertournamentpoint->player2_point = $request->player2_point;
            $gamertournamentpoint->winner = $request->winner;
            $gamertournamentpoint->save();
            Alert::Html('Success', '<h2> Gamer Tournament Point Updated Successfully </h2>','success');
            return redirect("gamertournamentpoint");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gamer_tournament_point  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy( $id)
    {
         $gamertournamentpoint = Gamer_tournament_point::find($id);
        $status = $gamertournamentpoint->is_deleted;

        if ($status == 0) {
            $gamertournamentpoint->is_deleted = '1';
        } else {
            $gamertournamentpoint->is_deleted = '0';
        }
        $gamertournamentpoint->save();

        Alert::Html('Success', '<h2> Gamer Tournament Point Deleted Successfully </h2>','success');
        return redirect('gamertournamentpoint');
    }


    public function changeStatus($id) 
   {

        $gamertournamentpoint = Gamer_tournament_point::find($id);
        $status = $gamertournamentpoint->is_active;

        if ($status == 1) {
            $gamertournamentpoint->is_active = '0';
        
        } else {
            $gamertournamentpoint->is_active = '1';
            }
        $gamertournamentpoint->save();

Alert::Html('Success', '<h2> Gamer Tournament Point Status Changed </h2>','success');
        return redirect('gamertournamentpoint');
    }


}

<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Country;
use App\Models\Gamer;
use App\Models\Gamer_Position;
use App\Models\Gamers_tournaments;
use App\Models\Teams_tournament;
use App\Models\Tournaments;
use Illuminate\Http\Request;
use Validator;

class GamerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
        $gamer_name = ( isset($_GET['gamer_name']) && $_GET['gamer_name'] != '' ) ? $_GET['gamer_name'] : '';

        if ($gamer_name != '') {
            $gamer = Gamer::where('is_deleted', 0)->where('fname', 'like', '%' . $gamer_name . '%')->orwhere('lname', 'like', '%' . $gamer_name . '%')->orwhere('email', 'like', '%' . $gamer_name . '%')->where('gamer_type', '1')
            ->orderBy('id', 'desc')
            ->paginate(100);
        } else {
            $gamer = Gamer::where('is_deleted', 0)->where('gamer_type', '1')
            ->orderBy('id', 'desc')
            ->paginate(100);
        }

        return view('admin.gamer.index', compact('gamer'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $country = Country::all();
        return view('admin.gamer.create', compact('country'));
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
            'country_id' => $request->country_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'email' => $request->email,
            'gender' => $request->gender,
            'mobile' => $request->mobile,
            'password' => $request->password,
        ), array(
            'country_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:gamers',
            'password' => 'required',
        ));

        if ($validator->fails()) {
            return redirect('gamers/create')
            ->withErrors($validator)->withInput();
        } else {
            $Gamer = new Gamer();
            $Gamer->country_id = $request->country_id;
            $Gamer->fname = $request->fname;
            $Gamer->lname = $request->lname;
            $Gamer->email = $request->email;
            $Gamer->username = $request->username;
            $Gamer->password = md5($request->password);
            $Gamer->gender = $request->gender;
            $Gamer->mobile = $request->mobile;
            $Gamer->dob = $request->dob;
            $Gamer->is_verified = $request->is_verified;
            $Gamer->is_active = $request->is_active;
            $Gamer->gamer_type = 1;
            $Gamer->partner = $request->partner;

            $valid_images = array(
                'png',
                'jpg',
                'jpeg',
                'gif'
            );

            if (
                $request->hasFile('image') && in_array($request
                ->image
                ->extension(), $valid_images)
            ) {
                $profile_image = $request->image;
                $imageName = time() . '.' . $profile_image->getClientOriginalName();
                $profile_image->move('new-theme/images/gamer/', $imageName);
                $uploadedImage = 'new-theme/images/gamer/' . $imageName;
                $Gamer->image = $uploadedImage;
            }

            $Gamer->save();

            Alert::Html('Success', '<h2> Gamer Added Successfully </h2>', 'success');

            return redirect('gamers');
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Gamer  $id
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        $gamer = Gamer::find($id);
        return view('admin.gamer.show', compact('gamer'));
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Gamer  $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        $gamer = Gamer::findOrFail($id);
        $countryname = Country::find($gamer->country_id);
        $country = Country::all();
        return view('admin.gamer.edit', compact('country', 'gamer', 'countryname'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Gamer  $gamer
    * @return \Illuminate\Http\Response
    */

    public function update1(Request $request)
    {
        $id = $request->id;
        $Gamer = Gamer::find($id);
        $Gamer->country_id = $request->country_id;
        $Gamer->fname = $request->fname;
        $Gamer->lname = $request->lname;
        $Gamer->email = $request->email;
        $Gamer->username = $request->username;
        $Gamer->gender = $request->gender;
        $Gamer->mobile = $request->mobile;
        $Gamer->dob = $request->dob;
        $Gamer->is_verified = $request->is_verified;
        $Gamer->is_active = $request->is_active;
        $Gamer->partner = $request->partner;

        if ($request->password != "") {
            $Gamer->password = md5($request->password);
        }


        $valid_images = array(
            'png',
            'jpg',
            'jpeg',
            'gif'
        );

        if (
            $request->hasFile('image') && in_array($request
            ->image
            ->extension(), $valid_images)
        ) {
            $profile_image = $request->image;
            $imageName = time() . '.' . $profile_image->getClientOriginalName();
            $profile_image->move('new-theme/images/gamer/', $imageName);
            $uploadedImage = 'new-theme/images/gamer/' . $imageName;
            $Gamer->image = $uploadedImage;
        }

        $Gamer->save();

        Alert::Html('Success', '<h2> Gamer Updated Successfully </h2>', 'success');

        return redirect('gamers');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Gamer  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
        $Gamer = Gamer::find($id);
        $status = $Gamer->is_deleted;

        if ($status == 0) {
            $Gamer->is_deleted = '1';
        } else {
            $Gamer->is_deleted = '0';
        }
        $Gamer->save();

        Alert::Html('Success', '<h2> Gamer Deleted Successfully </h2>', 'success');
        return redirect('gamers');
    }

    public function changeStatus($id)
    {

        $gamer = Gamer::find($id);
        $status = $gamer->is_active;

        if ($status == 1) {
            $gamer->is_active = '0';
        } else {
            $gamer->is_active = '1';
        }
        $gamer->save();

        Alert::Html('Success', '<h2> Gamer Status Changed </h2>', 'success');
        return redirect('gamers');
    }

    public function sendEmail(Request $request)
    {
        $subject = $request->subject;
        if ($request->message != '') {
            $message = $request->message;
        } else {
            $message = $request->message1;
        }
        $to = $request->to;

        $header = 'From: LetsGameNow<info@letsgamenow.com> \r\n';
        $header .= 'MIME-Version: 1.0\r\n';
        $header .= 'Content-type: text/html\r\n';
        $retval = mail($to, $subject, $message, $header);

        Alert::Html('Success', '<h2> Email has been successfully sent to all selected gamers</h2>', 'success');
        return redirect()->back();
    }

    public function gamerpositions($id)
    {
        $tournament = Tournaments::find($id);
        if ($tournament->user_type == 1) {
            $players = Gamers_tournaments::select('gamers_tournaments.*', 'gamers_tournaments.id as gtid', 'tournaments.name as tname', 'gamers.*')->leftJoin('tournaments', 'tournaments.id', '=', 'gamers_tournaments.tournament_id')
            ->leftjoin('gamers', 'gamers.id', '=', 'gamers_tournaments.user_id')
            ->where('gamers_tournaments.is_deleted', 0)
            ->where('gamers_tournaments.tournament_id', $id)->get();
            $position = Gamer_Position::where('tournaments.id', $id)->select('tournaments.name as tournaments', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'gamer_positions.tournament_id')
            ->leftJoin('gamers', 'gamers.id', '=', 'gamer_positions.gamer_id')
            ->get();

            return view('admin.gamer.indivposition', compact('tournament', 'players', 'position'));
        } elseif ($tournament->user_type == 2) {
            $players = Teams_tournament::where('teams_tournaments.is_deleted', 0)->select('teams_tournaments.*', 'teams_tournaments.id as ttid', 'tournaments.name as tournaments', 'teams.team_name as teams', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'teams_tournaments.tournament_id')
            ->leftJoin('teams', 'teams.id', '=', 'teams_tournaments.team_id')
            ->leftJoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
            ->where('tournaments.id', $id)->get();
            $position = Gamer_Position::where('tournaments.id', $id)->select('tournaments.name as tournaments', 'teams.team_name as teams', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile')
            ->leftJoin('tournaments', 'tournaments.id', '=', 'gamer_positions.tournament_id')
            ->leftJoin('teams', 'teams.id', '=', 'gamer_positions.team_id')
            ->leftJoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
            ->get();
            return view('admin.gamer.teamposition', compact('tournament', 'players', 'position'));
        }
    }

    public function positionsteam(Request $request)
    {
        $position = Gamer_Position::where('tournament_id', $request->tournament_id)
        ->count();
        if ($position >= 1) {
            Gamer_Position::where('tournament_id', $request->tournament_id)
            ->delete();
        }
        $player1 = $request['team_id'];
        $pos = 0;
        $incriment_value = 0;
        $count = count($player1);
        for ($i = 0; $i < $count; $i++) {
            $p1 = ( isset($player1[$i]) && $player1[$i] != '' ) ? $player1[$i] : 0;
            $position = new Gamer_Position();
            $position->tournament_id = $request->tournament_id;
            $incriment_value = $pos + 1;
            $position->position = $incriment_value;
            $position->team_id = $p1;
            $position->save();
            $pos++;
        }

        Alert::Html('Success', '<h2> All Team Postion for the Tournament is Set</h2>', 'success');
        return redirect()->back();
    }

    public function positionsindiv(Request $request)
    {
        $position = Gamer_Position::where('tournament_id', $request->tournament_id)
        ->count();
        if ($position >= 1) {
            Gamer_Position::where('tournament_id', $request->tournament_id)
            ->delete();
        }

        $player1 = $request['gamer_id'];
        $pos = 0;
        $incriment_value = 0;
        $count = count($player1);
        for ($i = 0; $i < $count; $i++) {
            $p1 = ( isset($player1[$i]) && $player1[$i] != '' ) ? $player1[$i] : 0;
            $position = new Gamer_Position();
            $position->tournament_id = $request->tournament_id;
            $incriment_value = $pos + 1;
            $position->position = $incriment_value;
            $position->gamer_id = $p1;
            $position->save();
            $pos++;
        }

        Alert::Html('Success', '<h2> All Gamer Postion for the Tournament is Set</h2>', 'success');
        return redirect()->back();
    }
}

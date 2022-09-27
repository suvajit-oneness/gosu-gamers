<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Country;
use App\Models\Game;
use App\Models\Gamer_tournament_schedule;
use App\Models\Gamers_tournaments;
use App\Models\Region;
use App\Models\Team_tournament_schedule;
use App\Models\Teams_tournament;
use App\Models\Tournament_rooms;
use App\Models\Tournaments;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Redirect;
use Validator;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $tournam = (isset($_GET['tournament']) && $_GET['tournament'] != '') ? $_GET['tournament'] : '';

        if ($tournam != '') {
            // $tournaments = Tournaments::where('tournaments.is_deleted', 0)->where('name', 'like', '%' . $tournam . '%')->orderBy(DB::raw('ABS(DATEDIFF(start_date, NOW()))'))
            //     ->get();
            $tournaments = Tournaments::where('tournaments.is_deleted', 0)->where('name', 'like', '%' . $tournam . '%')->orderBy('id', 'DESC')
                ->get();
        } else {
            // $tournaments = Tournaments::where('tournaments.is_deleted', 0)->orderBy(DB::raw('ABS(DATEDIFF(start_date, NOW()))'))
            //     ->get();
            $tournaments = Tournaments::where('tournaments.is_deleted', 0)->orderBy('id', 'DESC')
                ->get();
        }

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function freetournaments()
    {

        $tournam = (isset($_GET['tournament']) && $_GET['tournament'] != '') ? $_GET['tournament'] : '';

        if ($tournam != '') {
            $tournaments = Tournaments::where('tournaments.is_deleted', 0)
                ->where('is_free', '1')
                ->where('name', 'like', '%' . $tournam . '%')
                ->orderBy(DB::raw('ABS(DATEDIFF(start_date, NOW()))'))
                ->get();
        } else {
            $tournaments = Tournaments::where('tournaments.is_deleted', 0)
                ->where('is_free', '1')
                ->orderBy(DB::raw('ABS(DATEDIFF(start_date, NOW()))'))
                ->get();
        }

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function paidtournaments()
    {

        $tournam = (isset($_GET['tournament']) && $_GET['tournament'] != '') ? $_GET['tournament'] : '';

        if ($tournam != '') {
            $tournaments = Tournaments::where('tournaments.is_deleted', 0)->where('is_free', '0')->where('name', 'like', '%' . $tournam . '%')->orderBy(DB::raw('ABS(DATEDIFF(start_date, NOW()))'))
                ->get();
        } else {
            $tournaments = Tournaments::where('tournaments.is_deleted', 0)->where('is_free', '0')->orderBy(DB::raw('ABS(DATEDIFF(start_date, NOW()))'))
                ->get();
        }

        return view('admin.tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $regions = Region::all();
        $country = Country::all();
        $game = Game::all();
        $station = DB::table('platforms')->where('is_deleted', '=', '0')
            ->get();
        $currencyList = DB::table('currencies')->where('is_deleted', '=', '0')
            ->distinct()
            ->get(['id', 'currency_name', 'currency_code']);
        return view('admin.tournaments.create', compact('regions', 'country', 'game', 'station', 'currencyList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(array(
            'name' => $request->tournament_name,
            'ps_number' => $request->ps_number,
            // 'image' => $request->image,
        ), array(
            'name' => 'required|unique:tournaments',
            'ps_number' => 'required',
            // 'image' => 'required'
        ));
        if ($validator->fails()) {
            // dd('if');
            return redirect('tournaments/create')
                ->withErrors($validator)->withInput();
        } else {
            // dd('else');
            $flag = 0;
            $flag1 = 0;
            // $ps_number = '';
            $region_id = '';
            $country_id = '';
            $Tournaments = new Tournaments;
            $Tournaments->name = trim($request->tournament_name);
            $Tournaments->game_id = trim($request->game_id);
            $Tournaments->description = trim($request->description);
            $Tournaments->rulesdescription = trim($request->rulesdescription);
            $Tournaments->user_type = trim($request->user_type);
            $Tournaments->slug = trim($request->slug);
            $Tournaments->prize_money = trim($request->prize_money);
            $Tournaments->prize_currency = trim($request->prize_currency);
            $Tournaments->max_players = trim($request->max_players);
            $Tournaments->status = trim($request->tournament_status);
            $Tournaments->partner = trim($request->partner);
            $Tournaments->participation_point = trim($request->participation_point);
            $Tournaments->winner_point = trim($request->winner_point);
            $Tournaments->runnerup_point = trim($request->runnerup_point);
            $Tournaments->tournament_type = trim($request->tournament_type);
            if ($request->no_user_prize_dist != '') {
                $Tournaments->no_user_prize_dist = trim($request->no_user_prize_dist);
            } else {
                $Tournaments->no_user_prize_dist = 0;
            }
            $Tournaments->meta_title = trim($request->meta_title);
            $Tournaments->metakeyword = trim($request->metakeyword);
            $Tournaments->metadescription = trim($request->metadescription);
            if ($request->room_size == '') {
                $Tournaments->room_size = '1';
            } else {
                $request->room_size = intdiv($Tournaments->max_players, $request->room_size);
                $Tournaments->room_size = $request->room_size;
            }

            if ($request->country_id == '') {
                $Tournaments->country_id = '0';
            } else {
                $coun = $request->country_id;
                for ($k = 0; $k < count($coun);
                     $k++) {
                    $country_id = $country_id . $coun[$k] . ',';
                }
                $Tournaments->country_id = $country_id;
            }
            if ($request->region_id == '') {
                $Tournaments->region_id = '0';
            } else {
                $regio = $request->region_id;
                for ($k = 0; $k < count($regio);
                     $k++) {
                    $region_id = $region_id . $regio[$k] . ',';
                }
                $Tournaments->region_id = $region_id;
            }

            if ($request->prize_money == '') {
                $Tournaments->prize_money = '0';
                $Tournaments->prize_currency = '0';
            } else {
                $Tournaments->prize_money = $request->prize_money;
                $Tournaments->prize_currency = $request->prize_currency;
            }
            if ($request->other_reward == '') {
                $Tournaments->other_reward = '';
            } else {
                $Tournaments->other_reward = $request->other_reward;
            }
            $free = $request->is_free;
            if ($free == '0') {
                $Tournaments->is_free = '0';
                $Tournaments->part_amount = trim($request->partcipation_amount);
                $Tournaments->part_currency = $request->part_currency;
            } else {
                $Tournaments->is_free = '1';
                $Tournaments->part_amount = '0';
                $Tournaments->part_currency = '0';
            }
            $ps = $request->ps_number;
            // for ($k = 0; $k < count($ps);
            //      $k++) {
            //     $ps_number = $ps_number . $ps[$k] . ',';
            // }
            $Tournaments->ps_number = $ps;
            $sdate = date_create(trim($request->start_date));
            $edate = date_create(trim($request->end_date));
            $diff = date_diff($sdate, $edate);
            if ($diff->d >= 0 && $flag == 0) {
                $Tournaments->start_date = date('Y-m-d', strtotime(trim($request->start_date)));
                $Tournaments->end_date = date('Y-m-d', strtotime(trim($request->end_date)));
            } else {
                $flag = 1;
            }
            $start_time = new \DateTime(trim($request->start_time));
            $end_time = new \DateTime(trim($request->end_time));
            $stime = $start_time->format('H:i:s');
            $etime = $end_time->format('H:i:s');
            $st_time = explode(':', $stime);

            $et_time = explode(':', $etime);
            if (($et_time[0] >= $st_time[0]) && ($flag == 0)) {
                $Tournaments->start_time = $stime;
                $Tournaments->end_time = $etime;
            } else if (($et_time[1] >= $st_time[1]) && ($flag == 0)) {
                $Tournaments->start_time = $stime;
                $Tournaments->end_time = $etime;
            } else {
                $flag = 1;
            }
            $srdate = date_create(trim($request->reg_start_date));
            $erdate = date_create(trim($request->reg_end_date));
            $diff1 = date_diff($srdate, $erdate);
            if ($diff1->d >= 0 && $flag == 0) {
                $Tournaments->reg_start_date = date('Y-m-d', strtotime(trim($request->reg_start_date)));
                $Tournaments->reg_end_date = date('Y-m-d', strtotime(trim($request->reg_end_date)));
            } else {
                $flag = 1;
            }
            $reg_start_time = new \DateTime(trim($request->reg_start_time));
            $reg_end_time = new \DateTime(trim($request->reg_end_time));
            $rstime = $reg_start_time->format('H:i:s');
            $retime = $reg_end_time->format('H:i:s');
            $Tournaments->reg_start_time = $rstime;
            $Tournaments->reg_end_time = $retime;
            $valid_images = array(
                'png',
                'jpg',
                'jpeg'
            );
            if ($request->hasFile('image') && in_array($request
                    ->image
                    ->extension(), $valid_images)) {
                $profile_image = $request->image;
                $imageName = time(). '_' .rand(1000, 9999).'.'. $profile_image->getClientOriginalExtension();
                $profile_image->move('new-theme/images/Tournaments/', $imageName);
                $uploadedImage = 'new-theme/images/Tournaments/' . $imageName;
                $Tournaments->image = $uploadedImage;
            }
            if ($flag == 0) {
                $res = $Tournaments->save();
                $lid = $Tournaments->id;
                if ($request->has('percAmt') && count($request->percAmt) > 0) {
                    $arrx2 = $request->percAmt;
                    $inputArr = array();
                    $rank = 1;
                    for ($i = 0; $i < count($request->percAmt);
                         $i++) {
                        $arr = array();
                        $arr['tournament_id'] = $Tournaments->id;
                        $arr['percentage_amt'] = $arrx2[$i];
                        $arr['user_rank'] = $rank;
                        array_push($inputArr, $arr);
                        $rank++;
                    }
                    DB::table('tournament_percentage_maps')->insert($inputArr);
                }
                if ($Tournaments->room_size) {
                    for ($i = 0; $i < $Tournaments->room_size; $i++) {
                        $n2 = str_pad($i + 1, 4, 0, STR_PAD_LEFT);
                        $Tournament = new Tournament_rooms;
                        $Tournament->tournament_id = $lid;
                        $Tournament->game_room_id = 0;
                        $tour = Tournaments::with('game_name')->where('id', '=', $lid)->first();
                        $tournament_name = $tour->name;
                        $game_name = $tour
                            ->game_name->name;
                        $gname = substr($game_name, 0, 1);
                        $tname = substr($tournament_name, 0, 2);
                        $code = ucwords($gname) . '-' . strtoupper($tname) . '-' . $lid . '-' . $n2;
                        $Tournament->room_code = $code;
                        $Tournament->save();
                    }
                }
                if ($res) {
                    Alert::Html('Success', '<h2> Tournament Added Successfully </h2>', 'success');
                    return redirect('tournaments');
                } else {
                    Alert::Html('Warning', '<h2> Something went wrong </h2>', 'warning');
                    return redirect('tournaments');
                }
            } else {
                Alert::Html('Warning', '<h2> Something went wrong </h2>', 'warning');
                return redirect('tournaments');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tournaments $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $game_data = DB::table('games')->get();
        $tour_data = Tournaments::where('id', $id)->first();
        $station = DB::table('platforms')->where('is_active', '1')
            ->get();
        $regionList = Region::where('is_deleted', 0)->get();
        $countries = DB::table('countries')->where('is_active', '1')
            ->orderBy('name', 'asc')
            ->get();
        $currencyList = DB::table('currencies')->where('is_active', '1')
            ->distinct()
            ->get(['id', 'currency_name', 'currency_code']);
        $percentageBrakeups = DB::table('tournament_percentage_maps')->where('tournament_id', $id)->orderBy('user_rank', 'asc')
            ->get();

        return view('admin.tournaments.edit', compact('game_data', 'tour_data', 'station', 'countries', 'currencyList', 'regionList', 'percentageBrakeups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tournaments $tournaments
     * @return \Illuminate\Http\Response
     */

    public function update1(Request $request)
    {
        
        $tid = $request->input('tournament_id');
        $flag = 0;

        $valid_images = array(
            'png',
            'jpg',
            'jpeg',
            'webp'
        );

        $ck = Tournaments::where('id', '=', $tid)->first();
        if (!empty($ck)) {
            // $request->validate(['tournament_name' => 'required', 'game' => 'required', 'user_type' => 'required', 'start_date' => 'required|date', 'end_date' => 'required|date', 'start_time' => 'required', 'end_time' => 'required', 'reg_start_date' => 'required|date', 'reg_end_date' => 'required|date', 'reg_start_time' => 'required', 'reg_end_time' => 'required', 'max_players' => 'required|numeric', 'room_size' => 'required|numeric']);
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

            $updateData['partner'] = trim($request->input('partner'));
            $updateData['participation_point'] = trim($request->input('participation_point'));
            $updateData['winner_point'] = trim($request->input('winner_point'));
            $updateData['runnerup_point'] = trim($request->input('runnerup_point'));

            // country
            $coun = $request->input('country');
               if($coun){
                
                $country = '';
                for ($k = 0; $k < count($coun);
                     $k++) {
                    $country = $country . $coun[$k] . ',';
                }
                $updateData['country_id'] = $country;
               }

            // region
                $regi = $request->input('region');
                    if($regi){
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

            if(trim($request->input('max_users'))){
                $updateData['max_players'] = trim($request->input('max_users'));
            }else{
                $updateData['max_players'] = trim($request->input('max_players'));
            }
            
           

           if($request->room_size != 0){
            $request->room_size = intdiv($updateData['max_players'], $request->room_size);

            $updateData['room_size'] = trim($request->room_size);
           }

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

                if (File::exists($image_full_path)) {
                    File::delete($image_full_path);
                }

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
                    return redirect('tournaments');
                } else {
                    Alert::Html('Warning', '<h2> Something Went Wrong </h2>', 'warning');
                    return redirect('tournaments');
                }
            } else {

                Alert::Html('Warning', '<h2> Something Went Wrong </h2>', 'warning');
                return redirect('tournaments');
            }
        } else {
            Alert::Html('Warning', '<h2> Something Went Wrong </h2>', 'warning');
            return redirect('tournaments');
        }

    }

    public function destroy($id)
    {
        $tournaments = Tournaments::find($id);
        $status = $tournaments->is_deleted;
        if ($status == 0) {
            $tournaments->is_deleted = '1';
        } else {
            $tournaments->is_deleted = '0';
        }
        $tournaments->save();
        Alert::Html('Success', '<h2> Tournament Deleted Successfully </h2>', 'success');
        return redirect('tournaments');
    }

    public function changeStatus($id)
    {
        $tournaments = Tournaments::find($id);
        $status = $tournaments->is_active;
        if ($status == 1) {
            $tournaments->is_active = '0';
        } else {
            $tournaments->is_active = '1';
        }
        $tournaments->save();
        Alert::Html('Success', '<h2> Tournament Status Changed </h2>', 'success');
        return redirect('tournaments');
    }

    public function stopjoining($id)
    {
        $tournaments = Tournaments::find($id);
        $status = $tournaments->stop_joining;
        if ($status == 0) {
            $tournaments->stop_joining = '1';
        } else {
            $tournaments->stop_joining = '0';
        }
        $tournaments->save();
        Alert::Html('Success', '<h2> Tournament Joining Stopped </h2>', 'success');
        return redirect('tournaments');
    }

    public function tournamentUsersList($id)
    {
        
        $tournament = Tournaments::where('id', $id)->first();
        $teamstage = Team_tournament_schedule::where('tournament_id', $id)->get();
        $stage = Gamer_tournament_schedule::where('tournament_id', $id)->get();
        if ($stage->count() > 0 and $tournament->user_type == 1) {
            return redirect()
                ->route('add_schedule', [$id]);
        } elseif ($teamstage->count() > 0 and $tournament->user_type == 2) {
            return redirect()
                ->route('add_teamschedule', [$id]);
        } else {
           
            if ($tournament->tournament_type == '2') {
                if ($tournament->user_type == '1') {
                    $tournamentList = Gamers_tournaments::where('tournament_id', $id)->select('gamers.*', 'gamers.id as gamer_id', 'gamers_tournaments.*')
                        ->join('gamers', 'gamers.id', '=', 'gamers_tournaments.user_id')
                        // ->where('gamers_tournaments.room_code', '0')
                        ->get();
                    $stage = DB::table('gamer_tournament_schedules')->where('tournament_id', $id)->get();
                    return view('admin.tournaments.view_gamer_tournament_schedule', compact('tournamentList', 'tournament', 'stage'));
                } else {
                    $tournamentList = Teams_tournament::where('tournament_id', $id)->select('teams.*', 'teams.id as team_id', 'teams_tournaments.*')
                        ->join('teams', 'teams.id', '=', 'teams_tournaments.team_id')
                        // ->where('teams_tournaments.room_code', '0')
                        ->get();
                    $stage = DB::table('team_tournament_schedules')->where('tournament_id', $id)->get();
                    return view('admin.tournaments.view_team_tournament_schedule', compact('tournamentList', 'tournament', 'stage'));
                }
            } else {
                if ($tournament->user_type == '1') {
                    // dd('if');
                    $platforms = str_replace(',', '', $tournament->ps_number);
                    if ($tournament->is_free == '0') {
                        $tournamentList = DB::table('orders')->select('gamers.*', 'gamers.id as gamer_id', 'orders.*', 'orders.tournament_id as tournament_id', 'gamers_tournaments.room_code')
                            ->join('gamers', 'gamers.id', '=', 'orders.user_id')
                            ->join('gamers_tournaments', 'gamers_tournaments.user_id', '=', 'gamers.id')
                            ->where('gamers_tournaments.room_code', '0')
                            ->where('gamers_tournaments.tournament_id', $id)->where('orders.tournament_id', $id)->get();
                        $room = Tournament_rooms::where('tournament_id', $id)->get();
                        $count = $tournamentList->count();
                        if ($count == 0) {
                            return redirect()->route('roomtournamentshow', [$id]);
                        }
                        return view('admin.tournaments.gamer_tournaments', compact('tournamentList', 'platforms', 'room', 'tournament'));
                    } else {
                        $tournamentList = Gamers_tournaments::where('tournament_id', $id)->select('gamers.*', 'gamers.id as gamer_id', 'gamers_tournaments.*')
                            ->join('gamers', 'gamers.id', '=', 'gamers_tournaments.user_id')
                            ->where('gamers_tournaments.room_code', '0')
                            ->get();
                        $room = Tournament_rooms::where('tournament_id', $id)->get();
                        $count = $tournamentList->count();
                        if ($count == 0) {
                            return redirect()->route('roomtournamentshow', [$id]);
                        }
                        return view('admin.tournaments.gamer_tournaments_free', compact('tournamentList', 'platforms', 'room', 'tournament'));
                    }
                } else {
                    $room = Tournament_rooms::where('tournament_id', $id)->get();
                    if ($tournament->is_free == '0') {
                        $tournamentList = Teams_tournament::where('tournament_id', $id)->where('payment_status', '=', '1')
                            ->select('teams.*', 'teams_tournaments.*')
                            ->where('teams_tournaments.room_code', '0')
                            ->join('teams', 'teams.id', '=', 'teams_tournaments.team_id')
                            ->get();

                    } else {
                        $tournamentList = Teams_tournament::where('tournament_id', $id)->select('teams.*', 'teams_tournaments.*')
                            ->join('teams', 'teams.id', '=', 'teams_tournaments.team_id')
                            ->where('teams_tournaments.room_code', '0')
                            ->get();
                    }
                    $count = $tournamentList->count();
                    // dd($count);
                    if ($count == 0) {
                        return redirect()->route('roomtournamentshowteam', [$id]);
                    }
                    $platforms = str_replace(',', '', $tournament->ps_number);
                    return view('admin.tournaments.team_tournaments', compact('tournamentList', 'platforms', 'room', 'tournament'));
                }
            }
        }
    }

    public function viewTournamentRoom($id)
    {
        $roomData = Tournament_rooms::with('get_tournament.game_name')->where('tournament_id', '=', $id)->get();
        return view('admin.tournaments.view_tournament_rooms', compact('roomData'));
    }

    public function autocomplete(Request $request)
    {
        $data = Tournaments::select('name')->where('name', 'LIKE', "%{$request->input('query') }%")
            ->get();
        return response()
            ->json($data);

    }

}


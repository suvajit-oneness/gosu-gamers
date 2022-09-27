<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GamerPlatfromDetail;
use App\Models\Teams_tournament;
use App\Models\Teams;
use App\Models\Gamer;
use App\Models\TeamPlayers;
use App\Models\Tournaments;
use App\Models\Gamers_tournaments;
use Illuminate\Http\Request;
use DB;
use Session;

date_default_timezone_set( 'Asia/Kolkata' );

class GamerPlatfromDetailController extends Controller
 {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
 {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create()
 {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request )
 {

        $gamerPlatfromDetail = new GamerPlatfromDetail;
        $gamerPlatfromDetail->gamer_id = $request->gamer_id;
        $gamerPlatfromDetail->ingame_name = $request->platfromname;
        $gamerPlatfromDetail->platfrom_id = $request->platform_id;
        $gamerPlatfromDetail->platfrom_number = $request->platfromnumber;
        $gamerPlatfromDetail->save();
        Session::flash( 'message', 'InGame Details updated' );
        Session::flash( 'alert-class', 'alert-success' );
        return redirect()->back();
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\GamerPlatfromDetail  $gamerPlatfromDetail
    * @return \Illuminate\Http\Response
    */

    public function show( GamerPlatfromDetail $gamerPlatfromDetail )
 {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\GamerPlatfromDetail  $request
    * @return \Illuminate\Http\Response
    */

    public function gameringameidsave( Request $request )
 {
        if ( $request->gamer_type == 'gamer' ) {
            DB::update( DB::raw( "UPDATE `gamers_tournaments` SET `in_game_name`='$request->ingamename', `in_game_id`='$request->ingameid', `email`='$request->email' 
                      WHERE `user_id`='$request->gamer_id'" ) );
        } elseif ( $request->gamer_type == 'team' ) 
 {

            $gamer_id = $request->gamer_id;
            $team_id = Gamer::where( 'gamers.id', $gamer_id )
            ->select( 'teams.id' )
            ->leftjoin( 'teams', 'teams.gamer_id', '=', 'gamers.id' )
            ->get();
            $team_id = $team_id[0]->id;
            DB::update( DB::raw( "UPDATE `teams_tournaments` SET `in_game_name`='$request->ingamename' `in_game_id`='$request->ingameid', `email`='$request->email' WHERE `team_id`='$team_id'" ) );

        }
        return redirect()->back();
    }

    public function update2( Request $request ) {

        $tour = Tournaments::find( $request->id );

        $curr_time = date( 'Y-m-d G:i:s' );
        

        $end_time = $tour->reg_end_date.' '.$tour->reg_end_time;
        // dd($end_time);

        if ( $curr_time>$end_time || $tour->stop_joining == 1 ) {
            echo json_encode( array( 'status' => 0, 'message'=> 'Tournament registration is now closed' ) );
            die();
        } else {
            if ( $tour->user_type == 1 ) {
                $playerjoined = DB::select( DB::raw( "SELECT COUNT(*) PLAYERS 
                  FROM `gamers_tournaments` WHERE `tournament_id`=$request->id AND `is_deleted` = 0" ) );
                $playerjoined = $playerjoined[0]->PLAYERS;
            } else {
                $playerjoined = DB::select( DB::raw( "SELECT COUNT(*) PLAYERS 
                  FROM `teams_tournaments` WHERE `tournament_id`=$request->id AND `is_deleted` = 0" ) );
                $playerjoined = $playerjoined[0]->PLAYERS;
            }

            $playercount = $tour->max_players - $playerjoined;

            if ( $playercount>0 ) {
                if ( $tour->user_type == 2 AND $request->gamer_type == 'team' ) {

                    return $this->teamregister( $request );

                } elseif ( $tour->user_type == 1 AND $request->gamer_type == 'gamer' ) {
                    return $this->register( $request );

                } elseif ( $tour->user_type == 2 AND $request->gamer_type == 'gamer' ) {

                    echo json_encode( array( 'status' => 0, 'message'=> 'Please Create your Own team to Play this Tournament in the Profile Section' ) );

                } elseif ( $tour->user_type == 1 AND $request->gamer_type == 'team' ) {

                    return $this->register( $request );

                }

            } else {
                echo json_encode( array( 'status' => 0, 'message'=> 'Tournament is full' ) );
            }

        }

    }

    public function register( Request $request ) {

        $transaction_id = ( isset( $request->transaction_id ) && $request->transaction_id != '' )?$request->transaction_id:'';

        $reg = Gamers_tournaments::where( 'tournament_id', $request->id )
        ->where( 'user_id', $request->gamer_id )->get();
        $count = $reg->count();
        if ( $count >= 1 )
 {
            echo json_encode( array( 'status' => 0, 'message' => 'You have Already Register' ) );
        } else {
            if ( $request->in_game_name == '' ) {
                $in_game_name = $request->in_game_name0;
            } else {
                $in_game_name = $request->in_game_name;
            }
            if ( $request->in_game_id == '' ) {
                $in_game_id = $request->in_game_id0;
            } else {
                $in_game_id = $request->in_game_id;
            }

            // patch by Nir
            if($in_game_name == "") {
                $in_game_name = "NA";
            }
            if($in_game_id == "") {
                $in_game_id = "NA";
            }


            $gamerstournaments = new Gamers_tournaments;
            $gamerstournaments->tournament_id = $request->id;
            $gamerstournaments->user_id = $request->gamer_id;
            $gamerstournaments->in_game_name = $in_game_name;
            $gamerstournaments->in_game_id = $in_game_id;

            $save = $gamerstournaments->save();

            if ( $transaction_id != '' ) {
                $save_data['tournament_id'] = $request->id;
                $save_data['gamer_id'] = $request->gamer_id;
                $save_data['transaction_id'] = $transaction_id;
                $save_data['amount'] = $request->amount;
                $save_data['currency'] = $request->currency;
                DB::table( 'gamer_tournament_payments' )->insertGetId( $save_data );

                $amm = $request->amount;
                $pay_id = $transaction_id;

                $url = 'https://api.razorpay.com/v1/payments/'.$pay_id.'/capture';

                $data_string = 'amount='.$amm;

                $headers = array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Basic '. base64_encode( 'rzp_live_0jrAcAoatSyqoS:C6cx89QcbCQUBv89Dh21jWwS' )
                );

                // Open connection
                $ch = curl_init();
                // Set the url, number of POST vars, POST data
                curl_setopt( $ch, CURLOPT_URL, $url );
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );

                curl_setopt( $ch, CURLOPT_POST, true );

                curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
                curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                // Disabling SSL Certificate support temporarly
                curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                //curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
                // Execute post
                $result = curl_exec( $ch );
                //echo $result;
                //pr( $result );
                curl_close( $ch );
            }

            if ( $save ) {

                echo json_encode( array( 'status' => 1, 'message' => 'You have Successfully Register to this Tournaments' ) );
            } else {
                echo json_encode( array( 'status' => 0, 'message' => 'Something Went Wrong' ) );
            }
        }
    }

    public function teamregister( Request $request ) {

        $transaction_id = ( isset( $request->transaction_id ) && $request->transaction_id != '' )?$request->transaction_id:'';
        if ( $request->gamer_type == 'team' ) {
            $team_id = Teams::where( 'gamer_id', $request->gamer_id )->get();
        }

        $reg = Teams_tournament::where( 'tournament_id', $request->id )
        ->where( 'team_id', $team_id[0]->id )->get();
        $count = $reg->count();

        $team_player = 0;

        $team_id = $team_id[0]->id;

        if ( $request->player_name0 != null && $request->player_email0 != null && $request->player_phone0 != null && $request->in_game_name0 != null && $request->in_game_id0 != null ) {

            $player_email = $request->player_email0;

            $player0 = TeamPlayers::where( 'team_id', $team_id )->where( 'email', $player_email )->get();

            if ( count( $player0 ) == 0 ) {
                $tp0  = new TeamPlayers;
                $tp0->ingame_name = $request->in_game_name0;
                $tp0->ingame_id = $request->in_game_id0;
                $tp0->team_id = $team_id;

                $tp0->name = $request->player_name0;
                $tp0->email = $request->player_email0;
                $tp0->phone_no = $request->player_phone0;
                $tp0->save();
            } else {
                $tp0  = TeamPlayers:: find( $player0[0]->id );
                $tp0->ingame_name = $request->in_game_name0;
                $tp0->ingame_id = $request->in_game_id0;
                $tp0->team_id = $team_id;

                $tp0->name = $request->player_name0;
                $tp0->email = $request->player_email0;
                $tp0->phone_no = $request->player_phone0;
                $tp0->save();
            }

            $team_player += 1;

        }

        if ( $request->player_name1 != '' && $request->player_email1 != '' && $request->player_phone1 && $request->in_game_name1 && $request->in_game_id1 != '' ) {
            // $team_id = $team_id[0]->id;

            $player_email = $request->player_email1;

            $player1 = TeamPlayers::where( 'team_id', $team_id )->where( 'email', $player_email )->get();

            if ( count( $player1 ) == 0 ) {
                $tp1  = new TeamPlayers;
                $tp1->ingame_name = $request->in_game_name1;
                $tp1->ingame_id = $request->in_game_id1;
                $tp1->team_id = $team_id;

                $tp1->name = $request->player_name1;
                $tp1->email = $request->player_email1;
                $tp1->phone_no = $request->player_phone1;
                $tp1->save();
            } else {
                $tp1  = TeamPlayers:: find( $player1[0]->id );
                $tp1->ingame_name = $request->in_game_name1;
                $tp1->ingame_id = $request->in_game_id1;
                $tp1->team_id = $team_id;

                $tp1->name = $request->player_name1;
                $tp1->email = $request->player_email1;
                $tp1->phone_no = $request->player_phone1;
                $tp1->save();
            }

            $team_player += 1;

        }

        if ( $request->player_name2 != '' && $request->player_email2 != '' && $request->player_phone2 && $request->in_game_name2 && $request->in_game_id2 != '' ) {
            // $team_id = $team_id[0]->id;
            $player_email = $request->player_email2;

            $player2 = TeamPlayers::where( 'team_id', $team_id )->where( 'email', $player_email )->get();

            if ( count( $player2 ) == 0 ) {
                $tp2  = new TeamPlayers;
                $tp2->ingame_name = $request->in_game_name2;
                $tp2->ingame_id = $request->in_game_id2;
                $tp2->team_id = $team_id;

                $tp2->name = $request->player_name2;
                $tp2->email = $request->player_email2;
                $tp2->phone_no = $request->player_phone2;
                $tp2->save();
            } else {
                $tp2  = TeamPlayers:: find( $player2[0]->id );
                $tp2->ingame_name = $request->in_game_name2;
                $tp2->ingame_id = $request->in_game_id2;
                $tp2->team_id = $team_id;

                $tp2->name = $request->player_name2;
                $tp2->email = $request->player_email2;
                $tp2->phone_no = $request->player_phone2;
                $tp2->save();
            }

            $team_player += 1;

        }

        if ( $request->player_name3 != '' && $request->player_email3 != '' && $request->player_phone3 && $request->in_game_name3 && $request->in_game_id3 != '' ) {
            // $team_id = $team_id[0]->id;
            $player_email = $request->player_email3;

            $player3 = TeamPlayers::where( 'team_id', $team_id )->where( 'email', $player_email )->get();

            if ( count( $player3 ) == 0 ) {
                $tp3  = new TeamPlayers;
                $tp3->ingame_name = $request->in_game_name3;
                $tp3->ingame_id = $request->in_game_id3;
                $tp3->team_id = $team_id;

                $tp3->name = $request->player_name3;
                $tp3->email = $request->player_email3;
                $tp3->phone_no = $request->player_phone3;
                $tp3->save();
            } else {
                $tp3  = TeamPlayers:: find( $player3[0]->id );
                $tp3->ingame_name = $request->in_game_name3;
                $tp3->ingame_id = $request->in_game_id3;
                $tp3->team_id = $team_id;

                $tp3->name = $request->player_name3;
                $tp3->email = $request->player_email3;
                $tp3->phone_no = $request->player_phone3;
                $tp3->save();
            }

            $team_player += 1;

        }

        if ( $request->player_name4 != '' && $request->player_email4 != '' && $request->player_phone4 && $request->in_game_name4 && $request->in_game_id4 != '' ) {
            // $team_id = $team_id[0]->id;
            $player_email = $request->player_email4;

            $player4 = TeamPlayers::where( 'team_id', $team_id )->where( 'email', $player_email )->get();

            if ( count( $player4 ) == 0 ) {
                $tp4  = new TeamPlayers;
                $tp4->ingame_name = $request->in_game_name4;
                $tp4->ingame_id = $request->in_game_id4;
                $tp4->team_id = $team_id;

                $tp4->name = $request->player_name4;
                $tp4->email = $request->player_email4;
                $tp4->phone_no = $request->player_phone4;
                $tp4->save();
            } else {
                $tp4  = TeamPlayers:: find( $player4[0]->id );
                $tp4->ingame_name = $request->in_game_name4;
                $tp4->ingame_id = $request->in_game_id4;
                $tp4->team_id = $team_id;

                $tp4->name = $request->player_name4;
                $tp4->email = $request->player_email4;
                $tp4->phone_no = $request->player_phone4;
                $tp4->save();
            }

            $team_player += 1;

        }

        if ( $request->player_name5 != '' && $request->player_email5 != '' && $request->player_phone5 && $request->in_game_name5 && $request->in_game_id5 != '' ) {
            // $team_id = $team_id[0]->id;
            $player_email = $request->player_email5;

            $player5 = TeamPlayers::where( 'team_id', $team_id )->where( 'email', $player_email )->get();

            if ( count( $player5 ) == 0 ) {
                $tp5  = new TeamPlayers;
                $tp5->ingame_name = $request->in_game_name5;
                $tp5->ingame_id = $request->in_game_id5;
                $tp5->team_id = $team_id;

                $tp5->name = $request->player_name5;
                $tp5->email = $request->player_email5;
                $tp5->phone_no = $request->player_phone5;
                $tp5->save();
            } else {
                $tp5  = TeamPlayers:: find( $player5[0]->id );
                $tp5->ingame_name = $request->in_game_name5;
                $tp5->ingame_id = $request->in_game_id5;
                $tp5->team_id = $team_id;

                $tp5->name = $request->player_name5;
                $tp5->email = $request->player_email5;
                $tp5->phone_no = $request->player_phone5;
                $tp5->save();
            }

            $team_player += 1;

        }
        $team_player = TeamPlayers::where( 'team_id', $team_id )->where( 'is_deleted', 0 )->count();
        //}

        if ( $team_player<3 ) {
            echo json_encode( array( 'status' => 0, 'message' => 'Please add all the player details properly for at least 3 players' ) );
        } else {
            if ( $count >= 1 )
 {
                echo json_encode( array( 'status' => 0, 'message' => 'You have Already Register' ) );
            } else {

                $teamstournaments = new Teams_tournament;
                $teamstournaments->tournament_id = $request->id;
                $teamstournaments->team_id = $team_id;

                $teamstournaments->in_game_name = $request->in_game_name0;
                $teamstournaments->in_game_id = $request->in_game_id0;

                $save = $teamstournaments->save();

                if ( $transaction_id != '' ) {
                    $save_data['tournament_id'] = $request->id;
                    $save_data['team_id'] = $team_id;
                    $save_data['transaction_id'] = $transaction_id;
                    $save_data['amount'] = $request->amount;
                    $save_data['currency'] = $request->currency;
                    DB::table( 'team_tournament_payments' )->insertGetId( $save_data );

                    $amm = $request->amount;
                    $pay_id = $transaction_id;

                    $url = 'https://api.razorpay.com/v1/payments/'.$pay_id.'/capture';

                    $data_string = 'amount='.$amm;

                    $headers = array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Authorization: Basic '. base64_encode( 'rzp_live_0jrAcAoatSyqoS:C6cx89QcbCQUBv89Dh21jWwS' )
                    );

                    // Open connection
                    $ch = curl_init();
                    // Set the url, number of POST vars, POST data
                    curl_setopt( $ch, CURLOPT_URL, $url );
                    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );

                    curl_setopt( $ch, CURLOPT_POST, true );

                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    // Disabling SSL Certificate support temporarly
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                    //curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
                    // Execute post
                    $result = curl_exec( $ch );
                    //echo $result;
                    //pr( $result );
                    curl_close( $ch );

                }
                if ( $save ) {

                    echo json_encode( array( 'status' => 1, 'message' => 'You have Successfully Register to this Tournaments' ) );
                } else {
                    echo json_encode( array( 'status' => 0, 'message' => 'Somethin Went Wrong' ) );
                }
            }
        }

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\GamerPlatfromDetail  $gamerPlatfromDetail
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, GamerPlatfromDetail $gamerPlatfromDetail )
 {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\GamerPlatfromDetail  $gamerPlatfromDetail
    * @return \Illuminate\Http\Response
    */

    public function destroy( GamerPlatfromDetail $gamerPlatfromDetail )
 {
        //
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GamerPlatfromDetail;
use App\Models\Gamer;
use App\Models\Teams;
use App\Models\TeamPlayers;
use App\Models\Platform;
use Auth;
use DB;
use Session;

class GamerLoginController extends Controller {

    public function showLoginForm() {

        if ( Auth::guard( 'gamer' )->check() ) {
            Session::flash( 'message', 'Already logged in.' );

            Session::flash( 'alert-class', 'alert-warning' );
            return redirect( route( 'home.index' ) );
        }
        $country = Country::all();

        return view( 'website.home.login', compact( 'country' ) );
    }

    public function login( Request $request ) {

        // Validate the form data
        $this->validate( $request, [
            'email'   => 'required|email',
            'password' => 'required',
            'gamer_type'=>'required',
        ] );

        if ( $request->gamer_type == '1' ) {
            if ( Auth::guard( 'gamer' )->attempt( ['email' => $request->email, 'password' => $request->password, 'is_verified'=>1, 'gamer_type' => 1], $request->remember ) ) {

                return redirect( route( 'home.index' ) );
            } else {
                Session::flash( 'message', 'Wrong username and password. Please try with correct one.' );
                Session::flash( 'alert-class', 'alert-success' );
                return redirect( 'home/login' );
            }
        } elseif ( $request->gamer_type == '2' ) {

            return $this->teamlogin( $request );

        }

        return redirect( route( 'home.login' ) );
    }

    public function register() {

        $country = Country::all();
        return view( 'website.home.register', compact( 'country' ) );
    }

    public function registersave( Request $request ) {
       
        $getGamers = Gamer::all();
        if($getGamers == $request->mobile){
            Session::flash( 'message', 'this number is already registered' );
            return redirect()->back();
        }

        //$otp = '123456';
        $phonePattern = '/\b\d{3}[-.]?\d{3}[-.]?\d{4}\b/';
        $otp = rand( 100000, 999999 );
        $request->validate( [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'email' => 'required|email|unique:gamers,email',
            'mobile' => 'required|unique:gamers',
            'mobile' => 'required|regex:' . $phonePattern,
            'dob' => 'required|date',
            'country_id' => 'required'
        ] );
        $Gamer = new Gamer;
        $Gamer->country_id = $request->country_id;
        $Gamer->fname = $request->fname;
        $Gamer->lname = $request->lname;
        $Gamer->email = $request->email;
        $Gamer->mobile = $request->mobile;
        $Gamer->dob = $request->dob;
        $Gamer->otp = $otp;
        $Gamer->password = md5( $otp );
        $Gamer->gamer_type = 1;

        $valid_images = array( 'png', 'jpg', 'jpeg', 'gif' );

        if ( $request->hasFile( 'image' ) && in_array( $request->image->extension(), $valid_images ) ) {
            $profile_image = $request->image;
            $imageName = time().'.'.$profile_image->getClientOriginalName();
            $profile_image->move( 'new-theme/images/gamer/', $imageName );
            $uploadedImage = 'new-theme/images/gamer/'.$imageName;
            $Gamer->image = $uploadedImage;
        }
        $Gamer->save();
        $fname = $request->fname;
        $mobile = $request->mobile;
        $email = $request->email;
        $msg1 = "Hi%20$fname,%20you%20OTP%20for%20LetsGameNow%20is%20$otp.%20Please%20verify%20your%20account%20to%20continue.";

        $customer_mobile = $mobile;
        $ch = curl_init();
        // Set query data here with the URL
        $url1 = "https://103.229.250.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=$customer_mobile&from=LGNEST&text=$msg1";
        curl_setopt( $ch, CURLOPT_URL, $url1 );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 3 );
        $content = curl_exec( $ch );
        //echo $content;
        //die();
        curl_close( $ch );

        $to = $email;
        $subject = 'Welcome to GosuGamers site';

        $message = "Hi $fname,<br>
                Thanks for registering at GosuGamers! Your account is almost ready. Please verify your account to continue<br>
                OTP : $otp<br>
                With your GosuGamers Account, you can now<br>
                - Compete against friends and other players<br>
                - Stand a chance to win weekly and monthly cash prizes to play your favourite games<br>
                - Qualify for International Tournaments<br>
                <br>
                Kind Regards,<br>
                Team - Gosu Gamers IN<br>
                ";

        //$header = 'From: LetsGameNow<info@gosugamers.net> \r\n';
        //$header .= 'MIME-Version: 1.0\r\n';
        //$header .= 'Content-type: text/html\r\n';
        //$retval = mail( $to, $subject, $message, $header );
        
        $headers[] = 'MIME-Version: 1.0';
    	$headers[] = 'Content-type: text/html; charset=UTF-8';
    	$headers[] = 'From: GosuGamers <info@gosugamers.net>';

    	$retval = mail($to, $subject, $message, implode("\r\n", $headers));
    

        $thisGamer = DB::table( 'gamers' )->orderBy( 'id', 'DESC' )->first();
        return view( 'website.otplogin.otploginmobile', compact( 'thisGamer' ) );

    }

    Public function verifyotpfirst( $thisGamer ) {

        $gamer = $thisGamer;

        return view ( 'website.home.verifyotpfirst', compact( 'gamer' ) );
    }

    public function sendemaildone( Request $request ) {

        $Gamer = Gamer::where( 'email', $request->email )
        ->where( 'otp', $request->otp )-> get();

        $count = count( $Gamer );
        if ( $count > 0 ) {
            Gamer:: where ( ['email'=>$request->email, 'otp'=>$request->otp] )
            ->update( ['is_verified'=> 1, 'otp'=>NULL] );
            Auth::guard( 'gamer' )->login( $Gamer, true );
            return redirect ( '/' );
        } else {

            Session::flash( 'message', 'Wrong OTP. Please try with correct one.' );
            Session::flash( 'alert-class', 'alert-success' );
            $thisGamer = Gamer::where ( 'email', $request->email )-> first();
            return $this->verifyotpfirst( $thisGamer );
        }

    }

    public function registerteamsave( Request $request ) {

        $gamer = Gamer::find( $request->gamer_id );
        $gamer->gamer_type = 2;
        $gamer->save();
        $res = $request->gamer_id;
        $Team                  = new Teams;
        $Team->team_name       = trim( $request->team_name );
        $Team->subscription_type = 0;
        $Team->gamer_id          = $res;
        $Team->country_id      = $gamer->country_id;
        if ( $Team->save() ) {
            $res1 = $Team->id;
            $Players             = new TeamPlayers;
            $Players->team_id    = $res1;
            $Players->name       = $gamer->fname.$gamer->lname;
            $Players->email      = $gamer->email;
            $Players->phone_no   = $gamer->mobile;
            $Players->is_captain = '2';
            $Players->platform_id = $request->platform_id;
            $Players->ingame_id = $request->ingame_id;
            $Players->ingame_name = $request->ingame_name;
            $Players->save();
            Session::flash( 'message', 'You have Created your own team now Please add member' );
            Session::flash( 'alert-class', 'alert-success' );
            return redirect()->back();
        }

    }

    Public function addteamplayer( Request $request ) {

        $this->validate( $request, [
            'playermobile'   => 'required',
            'playername' => 'required',
            'playeremail' => 'required',
        ] );
        $count = TeamPlayers:: where ( 'team_id', $request->team_id )-> where( 'is_deleted', 0 )
        ->count();
        if ( $count >= 6 ) {
            Session::flash( 'message', 'Max Player is already full' );
            Session::flash( 'alert-class', 'alert-success' );

            return redirect()->back();
        } else {

            $Players = new TeamPlayers ;
            $Players->team_id = $request->team_id ;
            $Players->name = $request->playername;
            $Players->email = $request->playeremail;
            $Players->phone_no = $request->playermobile;
            $Players->platform_id = $request->platform_id;
            $Players->ingame_name = $request->platfromname;
            $Players->ingame_id = $request->platfromnumber;
            $Players->is_captain = '1';
            $res3 = $Players->save();
            Session::flash( 'message', 'New Team Player Joined' );
            Session::flash( 'alert-class', 'alert-success' );

            return redirect()->back();
        }
    }

    public function teamlogin( Request $request )
 {

        // Validate the form data
        $this->validate( $request, [
            'email'   => 'required|email',
            'password' => 'required',
            'gamer_type' => 'required',
        ] );
        if ( $request->gamer_type == '2' ) {
            if ( Auth::guard( 'gamer' )->attempt( ['email' => $request->email, 'password' => $request->password, 'is_verified'=>'1', 'gamer_type'=>'2'] ) ) {
                return redirect( route( 'home.index' ) );
            }
        }
        Session::flash( 'message', 'Wrong username and password. Please try with correct one.' );
        Session::flash( 'alert-class', 'alert-success' );
        return redirect( 'home/login' );
    }

    public function profile ( $id ) {
        $today = date( 'Y-m-d' );
        $upcoming_tournaments = DB::table( 'tournaments' )
        ->join( 'games', 'tournaments.game_id', '=', 'games.id' )
        ->select( 'tournaments.*', 'games.name as game_name' )
        ->where( 'tournaments.is_active', 1 )
        ->where( 'tournaments.is_deleted', 0 )
        ->where( 'tournaments.start_date', '>', $today )
        ->get();
        $gamerplatfromdetails = GamerPlatfromDetail::where( 'gamer_id', $id )
        ->select( 'gamer_platfrom_details.*', 'platforms.name as pfname' )
        ->leftjoin( 'platforms', 'platforms.id', '=', 'gamer_platfrom_details.platfrom_id' )
        ->get();

        $platforms = Platform::all();
        $country = Country::all();
        $teams = Teams::all();
        $teamplayer = TeamPlayers::where( 'gamers.id', $id )
        ->select( 'team_players.name as tpname', 'team_players.email as tpemail', 'team_players.phone_no', 'team_players.*', 'team_players.id as tpid' )
        ->leftjoin( 'teams', 'team_players.team_id', '=', 'teams.id' )
        ->leftjoin( 'gamers', 'teams.gamer_id', '=', 'gamers.id' )
        ->where( 'team_players.is_deleted', 0 )
        ->get();
        return view( 'website.home.profile', compact( 'platforms', 'country', 'teams', 'teamplayer', 'upcoming_tournaments', 'gamerplatfromdetails' ) );
    }

    public function deleteteamplayer( Request $request )
 {
        $TeamPlayers = TeamPlayers::find( $request->id );
        $status = $TeamPlayers->is_deleted;
        if ( $status == 0 ) {
            $TeamPlayers->is_deleted = '1';
        } else {
            $TeamPlayers->is_deleted = '0';
        }
        $TeamPlayers->save();
        echo json_encode( array( 'status' => 1, 'message' => 'You have successfully updated your team' ) );
    }

    public function edit () {

        $today = date( 'Y-m-d' );
        $upcoming_tournaments = DB::table( 'tournaments' )
        ->join( 'games', 'tournaments.game_id', '=', 'games.id' )
        ->select( 'tournaments.*', 'games.name as game_name' )
        ->where( 'tournaments.is_active', 1 )
        ->where( 'tournaments.is_deleted', 0 )
        ->where( 'tournaments.start_date', '>', $today )
        ->get();

        return view( 'website.home.edit', compact( 'upcoming_tournaments' ) );
    }

    public function logout( Request $request )
 {
        Auth::guard( 'gamer' )->logout();
        return redirect( route( 'home.index' ) );
    }

    public function editsave( Request $request )
 {

        $id = $request->id;
        $Gamer = Gamer::find( $id );
        $Gamer->fname = $request->fname;
        $Gamer->lname = $request->lname;
        $Gamer->email = $request->email;
        $Gamer->gender = $request->gender;
        $Gamer->mobile = $request->mobile;
        $Gamer->dob = $request->dob;
        $valid_images = array( 'png', 'jpg', 'jpeg', 'gif' );

        if ( $request->hasFile( 'image' ) && in_array( $request->image->extension(), $valid_images ) )
 {

            $profile_image = $request->image;
            $imageName = time().'.'.$profile_image->getClientOriginalName();
            $profile_image->move( 'new-theme/images/gamer/', $imageName );
            $uploadedImage = 'new-theme/images/gamer/'.$imageName;
            $Gamer->image = $uploadedImage;
        }

        $Gamer->save();
        return redirect( route( 'home.index' ) );
    }

    Public function updateteamplayer( Request $request ) {

        $Players = TeamPlayers:: find( $request->tpid ) ;
        $Players->name = $request->playername;
        $Players->email = $request->playeremail;
        $Players->phone_no = $request->playermobile;
        $Players->platform_id = $request->platform_id;
        $Players->ingame_name = $request->platfromname;
        $Players->ingame_id = $request->platfromnumber;
        $Players->is_captain = '1';
        $res3 = $Players->save();
        Session::flash( 'message', 'Team Player Updated' );
        Session::flash( 'alert-class', 'alert-success' );

        return redirect()->back();
    }

    public function forgetpassword( Request $request ) {
        $otp = rand( 100000, 999999 );
        if ( $request->playeremail == '' )
 {
            $playeremail = '';
        } else {
            $playeremail = $request->playeremail;
        }
        if ( $request->playermobile == '' )
 {
            $playermobile = '';
        } else {
            $playermobile = $request->playermobile;
        }

        $gamer = Gamer::where( 'mobile', $request->playermobile )
        ->orWhere( 'email', $playeremail )
        ->where( 'gamer_type', $request->gamer_type )
        ->count();

        if ( $gamer>0 ) {
            $thisGamer = Gamer::where( 'mobile', $request->playermobile )
            ->orWhere( 'email', $playeremail )
            ->where( 'gamer_type', $request->gamer_type )
            ->first();

            DB::table( 'password_resets' )->where( 'mobile', $playermobile )
            ->orWhere( 'email', $playeremail )
            ->where( 'gamer_id', $thisGamer->id )
            ->delete();

            DB::table( 'password_resets' )->insert(
                [
                    'email' => $playeremail,
                    'otp' => $otp,
                    'gamer_id'=>$thisGamer->id,
                    'mobile' => $playermobile,
                ]
            );

            $fname = $thisGamer->fname;
            $mobile = $thisGamer->mobile;
            $email = $thisGamer->email;
            $msg1 = "Hi%20$fname,%20you%20OTP%20for%20LetsGameNow%20is%20$otp.%20Please%20verify%20your%20account%20to%20continue.";

            $customer_mobile = $mobile;
            $ch = curl_init();
            // Set query data here with the URL
            $url1 = "https://103.229.250.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=$customer_mobile&from=LGNEST&text=$msg1";
            curl_setopt( $ch, CURLOPT_URL, $url1 );

            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 3 );
            $content = curl_exec( $ch );
            //echo $content;
            //die();
            curl_close( $ch );

            $to = $email;
            $subject = 'Welcome to GosuGamers site';

            $message = "Hi $fname,<br>
                You're receiving this email because you requested a password reset for your GosuGamers Account. If you did not request this change, <br>you can safely ignore this email.<br>
                To choose a new password and complete your request, Please verify your account  with this OTP and continue:<br>
                OTP : $otp<br>
                With your GosuGamers Account, you can now<br>
                - Compete against friends and other players<br>
                - Stand a chance to win weekly and monthly cash prizes to play your favourite games<br>
                - Qualify for International Tournaments<br>
                <br>
                Kind Regards,<br>
                Team - GosuGamers<br>
                ";

            $header = 'From: GosuGamers<info@gosugamers.net> \r\n';
            $header .= 'MIME-Version: 1.0\r\n';
            $header .= 'Content-type: text/html\r\n';
            $retval = mail( $to, $subject, $message, $header );

            return $this->verifyotpforget( $thisGamer );

        } else {
            Session::flash( 'message', 'Pleaes Enter the Correct Mobile No ,Email Or User Type' );
            Session::flash( 'alert-class', 'alert-success' );

            return redirect()->back();
        }

    }

    Public function verifyotpforget( $thisGamer ) {

        $gamer = $thisGamer;

        return view ( 'website.home.verifyotpforget', compact( 'gamer' ) );

    }

    public function otpverifyforget( Request $request ) {

        $verify = DB::table( 'password_resets' )->where( 'mobile', $request->mobile )
        ->orWhere( 'email', $request->email )
        ->where( 'otp', $request->otp )
        ->where( 'gamer_id', $request->id )
        -> get();

        $count = count( $verify );

        if ( $count > 0 ) {
            DB::table( 'password_resets' )->where( 'mobile', $request->mobile )
            ->orWhere( 'email', $request->email )
            ->where( 'otp', $request->otp )
            ->where( 'gamer_id', $request->id )
            ->delete();
            return redirect()->route( 'home.passwordreset', [$request->id] );
        } else {

            Session::flash( 'message', 'Wrong OTP. Please try with correct one.' );
            Session::flash( 'alert-class', 'alert-success' );
            $thisGamer = Gamer::where( 'id', $request->id )->first();

            return $this->verifyotpforget( $thisGamer );
        }

    }

    public function passwordreset( $id ) {
        $id = $id;
        return view ( 'website.home.resetpassword', compact( 'id' ) );

    }

    public function passwordresetstore( Request $request ) {
        if ( $request->password == $request->conpassword ) {

            Gamer::where( 'id', $request->id )->update( ['password'=> md5( $request->password )] );
            Session::flash( 'message', 'Your Password has been Changed' );
            Session::flash( 'alert-class', 'alert-success' );

            return redirect( 'home/login' );
        }

        Session::flash( 'message', 'Pleaes confirm the password Correctly' );
        Session::flash( 'alert-class', 'alert-success' );

        return $this->passwordreset( $request->id );
    }

}

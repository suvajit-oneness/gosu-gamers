<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GamerPlatfromDetail;
use App\Models\Gamer;
use App\Models\Teams;
use App\Models\TeamPlayers;
use App\Models\TextLocalSmsResponse;
use App\Models\Platform;
use Auth;
use DB;
use Session;

class GamerOtpController extends Controller {

    public function otplogin () {
        session(['link' => url()->previous()]);
        return view( 'website.otplogin.otplogin' );
    }

    public function otploginpost( Request $request ) {

        if ( $request->email == '' AND  $request->mobile == '' ) {
            Session::flash( 'message', 'Please enter your email id or mobile number for login' );
            Session::flash( 'alert-class', 'alert-success' );
            return redirect()->back();
        }
        if ( isset( $request->mobile ) ) {
            $email = $request->email;
            $mobile = $request->mobile;
            $thisGamer = Gamer::where( 'mobile', $request->mobile )->first();
            if ( isset( $thisGamer ) ) {
                $fname = $thisGamer->fname;
                // $otp = rand( 100000, 999999 );
                $otp = "123456";
                $msg1 = "Hi%20$fname,%20your%20OTP%20for%20login%20in%20LetsGameNow%20is%20$otp.%20Please%2enter%20to%20continue.";
                $customer_mobile = $request->mobile;

                $ch = curl_init();
                // Set query data here with the URL
                // $url1 = "http://203.212.70.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=$customer_mobile&from=LGNEST&text=$msg1";
                $url1 = "https://103.229.250.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=$customer_mobile&from=LGNESP&text=$msg1";
                curl_setopt( $ch, CURLOPT_URL, $url1 );

                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $ch, CURLOPT_TIMEOUT, 3 );
                $content = curl_exec( $ch );
                // echo $content;
                // die();
                curl_close( $ch );

                $thisGamer->otp = $otp;
                $thisGamer->password = md5( $otp );
                $thisGamer->save();

                    // Mobile SMS Account details
                    $fname = $thisGamer->fname;
                    $mobile = $thisGamer->mobile;
                    $apiKey = urlencode('NmM2ZDQxNTYzMDY3NGY3YTZjNWE1MDZiMzc3NTU4NTY=');

                    // Message details
                    $numbers = urlencode($mobile);
                    $sender = urlencode('LGNESP');
                    $message = rawurlencode('Hi '.$fname.', your OTP for LetsGameNow is '.$otp.' Please verify your account to continue');

                    // Prepare data for POST request
                    $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;

                    // Send the GET request with cURL
                    $ch = curl_init('https://api.textlocal.in/send/?' . $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    // query
                    $textdata = new TextLocalSmsResponse;
                    $textdata->name = $thisGamer->fname;
                    $textdata->mobile = $thisGamer->mobile;
                    $textdata->sender_id = $sender;
                    $textdata->message = $message;
                    $textdata->response = $response;
                    // dd($textdata);
                    $textdata->save();


                $to = $thisGamer->email;
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
                        Team - GosuGamers IN<br>
                        ";

                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=UTF-8';
                        $headers[] = 'From: GosuGamers <info@gosugamers.net>';
                
                        $retval = mail($to, $subject, $message, implode("\r\n", $headers));
                
                return view( 'website.otplogin.otploginmobile', compact( 'thisGamer' ) );

            }
            Session::flash( 'message', 'Please enter your email id or mobile number for login' );
            Session::flash( 'alert-class', 'alert-success' );
            return redirect( 'gamer/register' );
        } else {
            $thisGamer = Gamer::where( 'email', $request->email )->first();
            if ( isset( $thisGamer ) ) {
                $fname = $thisGamer->fname;
                // $otp = rand( 100000, 999999 );
                $otp = "123456";

                //echo $request->email."<br>";

                // $to = $request->email;
                // $subject = 'Welcome to LetsGameNow site';

                // $message = 'Hi $fname,<br>
                //     You are receiving this email because you requested for login in your LetsGameNow Account. 
                //     OTP : '.$otp.'<br>
                //     With your LGN Account, you can now<br>
                //     - Compete against friends and other players<br>
                //     - Stand a chance to win weekly and monthly cash prizes to play your favourite games<br>
                //     - Qualify for International Tournaments<br>
                //     <br>
                //     Kind Regards,<br>
                //     Team - LetsGameNow<br>
                //     ';

                // $header = 'From: LetsGameNow<info@gosugamers.net> \r\n';
                // $header .= 'MIME-Version: 1.0\r\n';
                // $header .= 'Content-type: text/html\r\n';
                // $retval = mail( $to, $subject, $message, $header );
                // echo "email : ".$retval;
                // die("xyz");

                // $email_json = '{
                //     "personalizations": [{
                //         "to": [{
                //             "email": "'.$to.'"
                //         }]
                //     }],
                //     "from": {
                //         "email": "info@gosugamers.net"
                //     },
                //     "subject": "'.$subject.'",
                //     "content": [{
                //         "type": "text/html",
                //         "value": "Hi '.$fname.',<br>You are receiving this email because you requested for login in your LetsGameNow Account.<br>OTP : '.$otp.'<br>- Compete against friends and other players<br>- Stand a chance to win weekly and monthly cash prizes to play your favourite games<br>- Qualify for International Tournaments<br><br>Kind Regards,<br>Team - LetsGameNow<br>"
                //     }]
                // }';

                // $appkey= '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';
                // $url = 'https://api.sendgrid.com/v3/mail/send';

                // $headers = array(
                //     'Authorization: Bearer ' . $appkey,
                //     'Content-Type: application/json'
                // );

                // $ch = curl_init();
                // // Set the url, number of POST vars, POST data
                // curl_setopt($ch, CURLOPT_URL, $url);
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // // Disabling SSL Certificate support temporarly
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $email_json);
                // // Execute post
                // $result = curl_exec($ch);

                // // echo $result."<br>";
                // // die("xyz");

                // curl_close($ch);

                $thisGamer->otp = $otp;
                $thisGamer->password = md5( $otp );
                
                $thisGamer->save();
                // dd($thisGamer);
                $to = $thisGamer->email;
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
                        Team - GosuGamers IN<br>
                        ";

                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=UTF-8';
                        $headers[] = 'From: GosuGamers <info@gosugamers.net>';
                
                        $retval = mail($to, $subject, $message, implode("\r\n", $headers));
                return view( 'website.otplogin.otploginmobile', compact( 'thisGamer' ) );
            }
            Session::flash( 'message', 'Since you are not Registered Please Register Yourself Here' );
            Session::flash( 'alert-class', 'alert-success' );

            return redirect( 'gamer/register' );
        }

    }

    public function otploginsubmit( Request $request ) {
        // dd($request);
        // Validate the form data
        $this->validate( $request, [
            'email'   => 'required|email',
            'password' => 'required'
        ] );

        if ( Auth::guard( 'gamer' )->attempt( ['email' => $request->email, 'password' => $request->password ], $request->remember ) ) {

            // dd(\Session::get('url.intended'));
            // dd(redirect()->intended($this->redirectPath()));
            // return redirect( route( 'home.index' ) );
            return redirect(session('link'));
            // return redirect()->intended();
        } else {
            Session::flash( 'message', 'You Have Enterd Wrong OTP. Please try Again.' );
            Session::flash( 'alert-class', 'alert-success' );
            return redirect( 'home/otplogin' );
        }

        return redirect( route( 'home.login' ) );
    }

    public function socialLogin(Request $request){
        // dd($request->all());
        //die();
        // echo $request->email."<br>";
        // echo $request->password."<br>";
        $gamer = Gamer::where( 'email', $request->email )
        ->get();

        //print_r($gamer);
        //echo $gamer[0]->id;

        if ( count($gamer)>0) {
            //die("xyz");
            $id = $gamer[0]->id;
            Auth::guard( 'gamer' )->loginUsingId($id); 

            return redirect( route( 'home.index' ) );
        }else{
            //die("abc");
            $Gamer = new Gamer;
            $Gamer->country_id = '99';
            $Gamer->fname = $request->fname;
            $Gamer->lname = $request->lname;
            $Gamer->email = $request->email;
            // $Gamer->mobile = $request->mobile;
            $Gamer->mobile = '0';
            $Gamer->dob = '';
            $Gamer->otp = 0;
            $Gamer->password = md5($request->password);
            $Gamer->gamer_type = 1;
            $Gamer->is_verified = 1;
            $Gamer->save();

            $gamer = Gamer::where( 'email', $request->email )->get();

            // if ( Auth::guard( 'gamer' )->attempt( ['email' => $request->email, 'password' => $request->password ], $request->remember ) ) {

            //     return redirect( route( 'home.index' ) );
            // }else{
            //         Session::flash( 'message', 'Some error occurred. Please try Again.' );
            //         Session::flash( 'alert-class', 'alert-success' );
            //         return redirect( 'home/otplogin' );
            //     }
            // }

            if(count($gamer)>0){
                $id = $gamer[0]->id;
                Auth::guard( 'gamer' )->loginUsingId($id); 

                return redirect( route( 'home.index' ) );
            }else{
                Session::flash( 'message', 'Some error occurred. Please try Again.' );
                Session::flash( 'alert-class', 'alert-success' );
                return redirect( 'home/otplogin' );
            }

        // if ( Auth::guard( 'gamer' )->attempt( ['email' => $request->email, 'password' => $request->password ], $request->remember ) ) {

        //     return redirect( route( 'home.index' ) );
        // } else {
        //     Session::flash( 'message', 'You Have Enterd Wrong OTP. Please try Again.' );
        //     Session::flash( 'alert-class', 'alert-success' );
        //     return redirect( 'home/otplogin' );
        // }

        // return redirect( route( 'home.login' ) );
        }
    }


}

<?php

namespace App\Http\Controllers\Website\FlipKart;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Country;
use App\Models\Game;
use App\Models\Gamer;
use App\Models\GamerPlatfromDetail;
use App\Models\Platform;
use App\Models\TeamPlayers;
use App\Models\Teams;
use App\Models\Tournaments;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;
use Illuminate\Support\Facades\File;
use App\Models\News;
use App\Models\News_category;
use Carbon\Carbon;
use App\Mail\GenericEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class FlipKartController extends Controller
{
    /*
     * Show the index page for FlipKart
     */
    public function index()
    {
        $banners = Banner::where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('partner', 'flipkart')
            ->orderBy('sequence', 'DESC')
            ->get();

        $gamerplatfromdetails = array();
        $teamplayer = array();

        if (false or Auth::guard('gamer')->check()) {
            $id = Auth::guard('gamer')->user()->id;
            $partner = Auth::guard('gamer')->user()->partner;
//            if ($partner != "flipkart") {
//                Alert::Html('Error', '<h2> You do not have access to this resource </h2>', 'error');
//                return redirect('flipkart-gaming');
//            }

            $gamerplatfromdetails = GamerPlatfromDetail::where('gamer_id', $id)
                ->select('gamer_platfrom_details.*', 'platforms.name as pfname')
                ->leftjoin('platforms', 'platforms.id', '=', 'gamer_platfrom_details.platfrom_id')
                ->get();

            $teamplayer = TeamPlayers::where('gamers.id', $id)
                ->select('team_players.name as tpname', 'team_players.email as tpemail', 'team_players.phone_no', 'team_players.*', 'team_players.id as tpid')
                ->leftjoin('teams', 'team_players.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->where('team_players.is_deleted', 0)
                ->get();
        } else {
//            Alert::Html('Error', '<h2> You do not have access to this resource </h2>', 'error');
//            return redirect('flipkart-gaming');
        }

        $today = date("Y-m-d");
//        echo  $today;
        $upcoming_tournaments = DB::table('tournaments')
            ->join('games', 'tournaments.game_id', '=', 'games.id')
            ->select('tournaments.*', 'games.name as game_name')
            ->where('tournaments.is_active', 1)
            ->where('tournaments.is_deleted', 0)
            ->where('tournaments.partner', "=", "flipkart")
//            ->whereRaw(' (tournaments.reg_start_date >= ? OR tournaments.reg_end_date <= ? )', [$today, $today])
            ->where('tournaments.reg_start_date', '<=', $today)
            ->where('tournaments.end_date', '>=', $today)
            ->get();
//        echo "bla";
//        print_r($upcoming_tournaments);
//        die("aaa");

        $platforms = Platform::all();
        $country = Country::all();
        $teams = Teams::all();

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();

        $tournaments = Tournaments::where('is_active', 1)->where('is_deleted', 0)->get();

//        $news = DB::table('news')
//            ->join('news_categories', 'news.category_id', '=', 'news_categories.id')
//            ->select('news.*', 'news_categories.name as category_name')
//            ->where('news.is_active', 1)
//            ->where('news.is_deleted', 0)
////            ->where('news.partner', "flipkart")
//            ->orderBy('id', 'DESC')
//            ->limit('10')
//            ->get();


        $news_categories = DB::table('news_categories')
            ->select('news_categories.*')
            ->get()
            ->toArray();
        $news_categories_arr = array();
        foreach ($news_categories as $news_category) {
            $news_categories_arr[$news_category->id] = $news_category->name;
        }
//        print_r($news_categories_arr);

        $news = DB::table('news')
//            ->join('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->select('news.*')
            ->where('news.is_active', 1)
            ->where('news.is_deleted', 0)
//            ->where('news.partner', "flipkart")
            ->orderBy('id', 'DESC')
            ->limit('10')
            ->get();
//        print_r($news);



        return view('website.flipkart.index', compact('banners', 'games', 'tournaments', 'news', 'news_categories', 'news_categories_arr', 'platforms', 'country', 'teams', 'teamplayer', 'upcoming_tournaments', 'gamerplatfromdetails'));
    }


    public function register($ref_code = "")
    {
        $country = Country::all();

        if ($ref_code != "") {
            return view('website.flipkart.register', compact('country', 'ref_code'));
        } else {
            return view('website.flipkart.register', compact('country'));
        }
    }


    public function registerSave(Request $request)
    {
        $validator = Validator::make(
            array(
                'country_id' => $request->country_id,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'username' => $request->username,
                'dob' => $request->dob,
                'email' => $request->email,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
                'password' => $request->password,
                'reg_ref_code' => $request->reg_ref_code,
            ),
            array(
                'country_id' => 'required',
                'fname' => 'required|min:2',
                'lname' => 'required|min:2',
                'username' => 'required|min:6|unique:gamers',
                'dob' => 'required',
                'email' => 'required|email|unique:gamers',
                'gender' => 'required',
                'mobile' => 'required|unique:gamers',
                //                'password' => 'required|between:4,20|confirmed',
                'password' => 'required|between:4,20',
                'reg_ref_code' => 'nullable|exists:referrer_code_union,referrer_code',
            ),
            array(
                'fname.required' => 'First Name is required.',
                'fname.min' => 'First Name must be at least 2 characters.',
                'lname.required' => 'Last Name is required.',
                'lname.min' => 'Last Name must be at least 2 characters.',
                'username.required' => 'UserName is required.',
                'username.min' => 'UserName must be at least 6 characters.',
                'username.unique' => 'This UserName is already used.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email needs to be in valid format',
                'email.unique' => 'This Email is already used.',
                'mobile.required' => 'Mobile is required.',
                'mobile.unique' => 'This Mobile is already used.',
                'reg_ref_code.exists' => 'Invalid Referral Code.',
            )
        );

        // check for custom validation
        // https://stackoverflow.com/questions/44437772/laravel-validation-exists-two-column-same-row

        if ($validator->fails()) {
            return redirect('flipkart-gaming/register')
                ->withErrors($validator)->withInput();
        } else {
            $country_row = Country::find($request->country_id);

            $Gamer = new Gamer();
            $Gamer->country_id = $request->country_id;
            $Gamer->num_code = $country_row->phonecode;
            $Gamer->fname = $request->fname;
            $Gamer->lname = $request->lname;
            $Gamer->username = $request->username;
            $Gamer->dob = $request->dob;
            $Gamer->email = $request->email;
            $Gamer->gender = $request->gender;
            $Gamer->mobile = $request->mobile;
            $Gamer->password = md5($request->password);
            $Gamer->gamer_type = 1;

            $valid_images = array(
                'png',
                'jpg',
                'jpeg',
                'gif'
            );

            if (
                $request->hasFile('id_proof') && in_array($request
                    ->id_proof
                    ->extension(), $valid_images)
            ) {
                $id_proof_image = $request->id_proof;
                $imageName = time() . '.' . $id_proof_image->getClientOriginalName();
                $id_proof_image->move('new-theme/images/id_proof/', $imageName);
                $uploadedImage = 'new-theme/images/id_proof/' . $imageName;
                $Gamer->id_proof = $uploadedImage;
            }

            $Gamer->is_verified = 0;
            $Gamer->is_active = 0;
            $Gamer->partner = "flipkart";

            $reg_ref_code = Gamer::where('reg_ref_code', $request->reg_ref_code)->count();

            if($request->reg_ref_code){
                if($reg_ref_code >= 10){
                    return Redirect::back()->withInput()->withErrors(['This referrer code is already used 10 time !']);
                }
            }
            $ref_points = 0;
            if ($request->reg_ref_code != "") {
                $Gamer->reg_ref_code = $request->reg_ref_code;

                $ref_points_rec = DB::table('referrer_code_union')
                    ->select('*')
                    ->where('referrer_code', $request->reg_ref_code)
                    ->get();

                if (isset($ref_points_rec[0])) {
                    $ref_points = $ref_points_rec[0]->points;
                }
            }
            $bytes = random_bytes(5);
            $Gamer->user_ref_code = strtoupper(bin2hex($bytes));

            $otp = '123456';
            $Gamer->otp = $otp;
            $Gamer->save();

            


            // get registration points
            $reg_points = 0;
            $reg_points_rec = DB::table('point_structure')
                ->select('*')
                ->where('trigger_event', '=', 'registration')
                ->where('channel', '=', 'flipkart')
                ->where('active', '=', 1)
                ->get();
            if (isset($reg_points_rec[0])) {
                $reg_points = $reg_points_rec[0]->points;
            }


            // save points
            if ($ref_points > 0) {
                DB::insert(
                    'insert into gamer_points (gamer_id, trigger_event, points, channel) values (?, ?, ?, ?)',
                    [
                        $Gamer->id,
                        'registration_referral',
                        $ref_points,
                        'flipkart'
                    ]
                );
            }

            if ($reg_points > 0) {
                DB::insert(
                    'insert into gamer_points (gamer_id, trigger_event, points, channel) values (?, ?, ?, ?)',
                    [
                        $Gamer->id,
                        'registration',
                        $reg_points,
                        'flipkart'
                    ]
                );
            }

            $this->sendOTP($Gamer->id);

//            echo "here: " . $Gamer->id . " > " . $Gamer->reg_ref_code . " > " . $Gamer->user_ref_code . " > " . $Gamer->otp . " > " . $ref_points . " > " . $reg_points;
//            die();

            Alert::Html('Success', '<h2> User Added Successfully, please check your Email / Mobile for OTP. </h2>', 'success');

            return redirect('flipkart-gaming');
        }
    }


    public function login()
    {
        return view('website.flipkart.login');
    }


    public function loginDo(Request $request)
    {
        $this->validate($request, [
            'identity' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('gamer')->attempt(['username' => $request->identity, 'password' => $request->password, 'is_active' => 1, 'is_verified' => 1], $request->remember)) {
            Alert::Html('Success', '<h2> Logged in Successfully </h2>', 'success');
            return redirect(route('flipkart.gaming'));
        } elseif (Auth::guard('gamer')->attempt(['email' => $request->identity, 'password' => $request->password, 'is_active' => 1, 'is_verified' => 1], $request->remember)) {
            Alert::Html('Success', '<h2> Logged in Successfully </h2>', 'success');
            return redirect(route('flipkart.gaming'));
        } elseif (Auth::guard('gamer')->attempt(['mobile' => $request->identity, 'password' => $request->password, 'is_active' => 1, 'is_verified' => 1], $request->remember)) {
            Alert::Html('Success', '<h2> Logged in Successfully </h2>', 'success');
            return redirect(route('flipkart.gaming'));
        } else {
            // check if the user present at all
            $gamer = DB::table('gamers')
                ->select('*')
                ->where('username', '=', $request->identity)
                ->orWhere('email', '=', $request->identity)
                ->orWhere('mobile', '=', $request->identity)
                ->get();

            if (!isset($gamer[0])) {
                $custom_erros[] = "No such user.";
            } elseif ($gamer[0]->password != md5($request->password)) {
                $custom_erros[] = "Incorrect Password";
            } elseif ($gamer[0]->is_verified != 1) {
                Alert::Html('Error', '<h2> Please verify your account </h2>', 'error');
                return redirect(route('flipkart.verify.account'));
            } elseif ($gamer[0]->is_active != 1) {
                Alert::Html('Error', '<h2> Account inactive, please contact administrator </h2>', 'error');
                return redirect(route('flipkart.gaming'));
            }

            return redirect(route('flipkart.login'))
                ->withErrors($custom_erros)->withInput();

//            Session::flash('message', 'Incorrect credentials or account is inactive or unverified.');
//            Session::flash('alert-class', 'alert-warning');
//            return redirect('flipkart-gaming/login');
        }

        return redirect('flipkart-gaming/login')
            ->withErrors($validator)->withInput();
    }


    public function logoutDo(Request $request)
    {
        Auth::guard('gamer')->logout();
        return redirect(route('flipkart.gaming'));
    }



    public function forgotPassword()
    {
        return view('website.flipkart.forgot-password');
    }


    public function forgotPasswordDo(Request $request)
    {
        $validator = Validator::make(
            array(
                'identity' => $request->identity
            ),
            array(
                'identity' => 'required'
            ),
            array(
                'identity.required' => 'Username / Email / Mobile is required.'
            )
        );


        if ($validator->fails()) {
            return redirect(route('flipkart.forgot.password'))
                ->withErrors($validator)->withInput();
        } else {
            $custom_erros = array();

            $gamer = DB::table('gamers')
                ->select('*')
                ->where('username', '=', $request->identity)
                ->orWhere('email', '=', $request->identity)
                ->orWhere('mobile', '=', $request->identity)
                ->get();
//                ->toArray();

            if (!isset($gamer[0])) {
                $custom_erros[] = "No such user.";
            } else {
                $bytes = random_bytes(32);
                $forgot_password_hash = strtoupper(bin2hex($bytes));

                DB::table('gamers')
                    ->where('id', $gamer[0]->id)
                    ->update(
                        [
                            'forgot_password_hash' => $forgot_password_hash
                        ]
                    );

                // send email
                $reset_password_url = route(
                    'flipkart.reset.password',
                    [
                        'forgot_password_hash' => $forgot_password_hash
                    ]
                );
                $email = $gamer[0]->email;
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $subject = "Reset Password for LetsGameNow. Link inside";
                    $message = 'Hi ' . $gamer[0]->fname . ' ' . $gamer[0]->lname . ",<br><br>Greetings!<br>Please click the link below to reset your password.<br>" . $reset_password_url . "<br><br>Kind Regards,<br>Team - LetsGameNow<br>";
                    // $this->sendEMAIL($email, $subject, $message);
                }

                Alert::Html('Success', '<h2> Please check your email for password reset link. </h2>', 'success');
                return redirect(route('flipkart.gaming'));
            }

            return redirect(route('flipkart.forgot.password'))
                ->withErrors($custom_erros)->withInput();
        }

    }



    public function resetPassword($forgot_password_hash)
    {
            $custom_erros = array();

            $gamer = DB::table('gamers')
                ->select('*')
                ->where('forgot_password_hash', '=', $forgot_password_hash)
                ->get();
//                ->toArray();

            if (!isset($gamer[0])) {
                Alert::Html('Error', '<h2> Incorrect Password Reset Hash. Please click the Password Reset link properly. </h2>', 'error');
                return redirect(route('flipkart.gaming'));
            } else {
                return view('website.flipkart.reset-password', compact('forgot_password_hash'));
            }

    }



    public function resetPasswordDo(Request $request)
    {
        DB::table('gamers')
            ->where('forgot_password_hash', $request->forgot_password_hash)
            ->update(
                [
                    'forgot_password_hash' => null,
                    'password' => md5($request->password)
                ]
            );

        Alert::Html('Success', '<h2> Password updated successfully. Please login to continue. </h2>', 'error');
        return redirect(route('flipkart.login'));
    }


//'password' => 'required|between:4,20|confirmed',



    public function profile()
    {
        $today = date('Y-m-d');
        $upcoming_tournaments = DB::table('tournaments')
            ->join('games', 'tournaments.game_id', '=', 'games.id')
            ->select('tournaments.*', 'games.name as game_name')
            ->where('tournaments.is_active', 1)
            ->where('tournaments.is_deleted', 0)
            ->where('tournaments.start_date', '>', $today)
            ->get();
        return view('website.flipkart.profile', compact('upcoming_tournaments'));
    }


    public function profileSave(Request $request)
    {
        if (false or Auth::guard('gamer')->check()) {
            $id = Auth::guard('gamer')->user()->id;
            $partner = Auth::guard('gamer')->user()->partner;
            if ($partner != "flipkart") {
                Alert::Html('Error', '<h2> You do not have access to this resource </h2>', 'error');
                return redirect('flipkart-gaming');
            }
        } else {
            Alert::Html('Error', '<h2> You do not have access to this resource </h2>', 'error');
            return redirect('flipkart-gaming');
        }

        $validator = Validator::make(
            array(
                'fname' => $request->fname,
                'lname' => $request->lname,
                'username' => $request->username,
                'dob' => $request->dob,
                'email' => $request->email,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
            ),
            array(
                'fname' => 'required|min:2',
                'lname' => 'required|min:2',
                'username' => 'required|min:6|unique:gamers,username,' . $id,
                'dob' => 'required',
                'email' => 'required|email|unique:gamers,email,' . $id,
                'gender' => 'required',
                'mobile' => 'required|unique:gamers,mobile,' . $id,
            ),
            array(
                'fname.required' => 'First Name is required.',
                'fname.min' => 'First Name must be at least 2 characters.',
                'lname.required' => 'Last Name is required.',
                'lname.min' => 'Last Name must be at least 2 characters.',
                'username.required' => 'UserName is required.',
                'username.min' => 'UserName must be at least 6 characters.',
                'username.unique' => 'This UserName is already used.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email needs to be in valid format',
                'email.unique' => 'This Email is already used.',
                'mobile.required' => 'Mobile is required.',
                'mobile.unique' => 'This Mobile is already used.',
            )
        );

        if ($validator->fails()) {
            return redirect('flipkart-gaming/profile')
                ->withErrors($validator)->withInput();
        } else {
            $Gamer = Gamer::find($id);
            $Gamer->fname = $request->fname;
            $Gamer->lname = $request->lname;
            $Gamer->username = $request->username;
            $Gamer->email = $request->email;
            $Gamer->mobile = $request->mobile;
            $Gamer->gender = $request->gender;
            $Gamer->dob = $request->dob;
            $valid_images = array('png', 'jpg', 'jpeg', 'gif');

            if ($request->hasFile('image') && in_array($request->image->extension(), $valid_images)) {
                if ($Gamer->image != "") {
                    $fn = ltrim($Gamer->image, 'new-theme/images/gamer/');
                    $current_image = base_path('public') . '/new-theme/images/gamer/' . $fn;

                    if (File::exists($current_image)) {
                        File::delete($current_image);
                    }
                }

                $profile_image = $request->image;
                $imageName = time() . '.' . $profile_image->getClientOriginalName();
                $profile_image->move('new-theme/images/gamer/', $imageName);
                $uploadedImage = 'new-theme/images/gamer/' . $imageName;
                $Gamer->image = $uploadedImage;
            }

            if ($request->password != "") {
                $Gamer->password = md5($request->password);
            }
            $Gamer->save();

            Alert::Html('Success', '<h2> Profile Updated </h2>', 'success');
            return redirect('flipkart-gaming');
        }
    }



    public function verifyAccountDirect($random_multiplier, $multiplied_gamer_id, $otp_sha256_hash)
    {
        if (
            !isset($random_multiplier)
            || $random_multiplier == ""
            || !isset($multiplied_gamer_id)
            || $multiplied_gamer_id == ""
            || !isset($otp_sha256_hash)
            || $otp_sha256_hash == ""
        ) {
            Alert::Html('Error', '<h2> Incomplete Parameters </h2>', 'error');
            return redirect(route('flipkart.gaming'));
        }

        $gamer_id = $multiplied_gamer_id / $random_multiplier;
        $gamer_row = Gamer::find($gamer_id);

        if (!isset($gamer_row)) {
            Alert::Html('Error', '<h2> Unknown User </h2>', 'error');
            return redirect(route('flipkart.gaming'));
        }
        $in_rec_otp_hashed = hash("sha256", $gamer_row->otp);

        if ($in_rec_otp_hashed != $otp_sha256_hash) {
            Alert::Html('Error', '<h2> Incorrect OTP </h2>', 'error');
            return redirect(route('flipkart.gaming'));
        }

        $gamer_row->otp = null;
        $gamer_row->is_active = 1;
        $gamer_row->is_verified = 1;
        $gamer_row->save();

        // credit referrer points, if any
        $this->creditReferrerPoints($gamer_row->id);

        Alert::Html('Success', '<h2> Account verified and activated successfully. Please login to continue. </h2>', 'success');
        return redirect(route('flipkart.login'));
    }




    public function verifyAccount()
    {
        return view('website.flipkart.verify-account');
    }





    public function verifyAccountDo(Request $request)
    {
        $validator = Validator::make(
            array(
                'identity' => $request->identity,
                'password' => $request->password,
                'otp' => $request->otp,
            ),
            array(
                'identity' => 'required',
                'password' => 'required',
                'otp' => 'required',
            ),
            array(
                'identity.required' => 'Username / Email / Mobile is required.',
                'password.required' => 'Password is required.',
                'otp.required' => 'OTP is required.',
            )
        );


        if ($validator->fails()) {
            return redirect(route('flipkart.verify.account'))
                ->withErrors($validator)->withInput();
        } else {
            $custom_erros = array();

            $gamer = DB::table('gamers')
                ->select('*')
                ->where('username', '=', $request->identity)
                ->orWhere('email', '=', $request->identity)
                ->orWhere('mobile', '=', $request->identity)
                ->get();
//                ->toArray();

            if (!isset($gamer[0])) {
                $custom_erros[] = "No such user.";
            } elseif ($gamer[0]->password != md5($request->password)) {
                $custom_erros[] = "Incorrect Password";
            } elseif ($gamer[0]->otp != $request->otp) {
                $custom_erros[] = "Incorrect OTP";
            } else {
                DB::table('gamers')
                    ->where('id', $gamer[0]->id)
                    ->update(
                        [
                            'otp' => null,
                            'is_active' => 1,
                            'is_verified' => 1
                        ]
                    );

                // credit referrer points, if any, proceed if reg_ref_points_credited is 0
                if ($gamer[0]->reg_ref_points_credited == 0) {
                    $this->creditReferrerPoints($gamer[0]->id);
                }

                Alert::Html('Success', '<h2> Account verified and activated successfully. Please login to continue. </h2>', 'success');
                return redirect(route('flipkart.login'));
            }

            return redirect(route('flipkart.verify.account'))
                ->withErrors($custom_erros)->withInput();
        }
    }



    public function creditReferrerPoints($gamer_id)
    {
        // load gamer
        $gamer = DB::table('gamers')
            ->select('*')
            ->where('id', '=', $gamer_id)
            ->get();

        // proceed if gamer is_verified is 1, is_active is 1, is_deleted is 0, reg_ref_points_credited is 0 and reg_ref_code is not null
        if (isset($gamer[0])) {
            if (
                $gamer[0]->is_verified == 1
                && $gamer[0]->is_active == 1
                && $gamer[0]->is_deleted == 0
                && $gamer[0]->reg_ref_points_credited == 0
                && $gamer[0]->reg_ref_code != ""
            ) {
                // lookup in referrer_code_union for the reg_ref_code and type is user, get the id and points
                $referrer = DB::table('referrer_code_union')
                    ->select('*')
                    ->where('referrer_code', '=', $gamer[0]->reg_ref_code)
                    ->get();

                if (isset($referrer[0]) && $referrer[0]->type == "user") {
                    // insert into gamer_points
                    DB::table('gamer_points')->insert([
                        'gamer_id' => $referrer[0]->id,
                        'trigger_event' => 'registration_referrer',
                        'points' => $referrer[0]->points,
                        'channel' => 'flipkart',
                        'ref_user' => $gamer[0]->id,
                        'created_at' => Carbon::now()
                    ]);
                }
            }

            DB::table('gamers')
                ->where('id', $gamer[0]->id)
                ->update(
                    [
                        'reg_ref_points_credited' => 1
                    ]
                );
        }







        // update gamer and set reg_ref_points_credited to 1 nevertheless
    }



    public function sendOTP($user_id)
    {
        $otp = "";

        // get the OTP of the user from gamers
        $gamer_row = Gamer::find($user_id);
        if (isset($gamer_row)) {
//            print_r($gamer_row);
            $otp = $gamer_row->otp;

            // OTP not found, or null, create one and set to db
            if ($otp == "") {
                $otp = sprintf("%06d", mt_rand(1, 999999));

                $gamer_row->otp = $otp;
                $gamer_row->save();

                $gamer_row = Gamer::find($user_id);
            }


            // send sms
            $mobile_country_code = $gamer_row->num_code;
            $mobile_num = $gamer_row->mobile;

            if ($mobile_num != "" && $mobile_country_code != "") {
                $full_mobile_num = "";
                if ($mobile_country_code == 91) {
                    $full_mobile_num = $mobile_num;
                } else {
                    $full_mobile_num = $mobile_country_code . $mobile_num;
                }

                if ($full_mobile_num != "") {
                    $sms_body = "Hi " . $gamer_row->fname . ", your OTP for LetsGameNow is " . $otp . " Please verify your account to continue";

                    $ret = $this->sendSMS($full_mobile_num, $sms_body, true);
//                    echo "Resp: " . $ret;
                }
            }


            // send email
            $random_multiplier = rand(1, 9);
            $verify_account_url = route(
                'flipkart.verify.account.direct',
                [
                    'random_multiplier' => $random_multiplier,
                    'multiplied_gamer_id' => ($gamer_row->id * $random_multiplier),
                    'otp_sha256_hash' => hash("sha256", $otp)
                ]
            );
            $email = $gamer_row->email;
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $subject = "Welcome to LetsGameNow. OTP inside";
                $message = 'Hi ' . $gamer_row->fname . ' ' . $gamer_row->lname . ",<br><br>Welcome to LetsGameNow!!!<br>Your OTP to verify your account is <b>" . $otp . "</b><br>Please visit " . $verify_account_url . " to verify your accuont.<br><br>Kind Regards,<br>Team - LetsGameNow<br>";
                // $this->sendEMAIL($email, $subject, $message);
            }
        }

//        die("peace");
    }



    public function resendOTP()
    {
        return view('website.flipkart.resend-otp');
    }



    public function resendOTPDo(Request $request)
    {
        $gamer = DB::table('gamers')
            ->select('*')
            ->where('username', '=', $request->identity)
            ->orWhere('email', '=', $request->identity)
            ->orWhere('mobile', '=', $request->identity)
            ->get();

        $custom_erros = array();
        if (!isset($gamer[0])) {
            $custom_erros[] = "No such user.";
        } elseif ($gamer[0]->is_verified == 1) {
            $custom_erros[] = "Given user already verified";
        } else {
            $this->sendOTP($gamer[0]->id);
            $custom_erros[] = "OTP Resent, please check email / mobile";

            return redirect(route('flipkart.verify.account'))
                ->withErrors($custom_erros)->withInput();

//            Alert::Html('Success', '<h2> Account verified and activated successfully. Please login to continue. </h2>', 'success');
//            return redirect(route('flipkart.login'));
        }

        return redirect(route('flipkart.resend.otp'))
            ->withErrors($custom_erros)->withInput();
    }



    public function newsIndex()
    {
        $news = News::where('is_active', 1)
            ->where('is_deleted', 0)
//            ->where('partner', 'flipkart')
            ->orderby('post_date', 'desc')
            ->paginate(16);

        $news_categories = News_category::where('is_active', 1)->where('is_deleted', 0)->orderby('id', 'desc')->get();

        return view('website.flipkart.news.index', compact('news', 'news_categories'));
    }


    public function upcomingTournaments()
    {
        $date = (isset($_GET['date']) && $_GET['date'] != '') ? $_GET['date'] : date("Y-m-d");
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';

        $tournaments = array();
        if ($game_id != '') {
            $tournamentDatas = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
                ->where('partner', "flipkart")
                ->where('reg_start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->where('game_id', $game_id)
                ->orderby('id', 'desc')
                ->get();
        } else {
            $tournamentDatas = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
                ->where('partner', "flipkart")
                ->where('reg_start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->orderby('id', 'desc')
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

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('website.flipkart.tournament.index', compact('tournaments', 'games'));
    }



    public function completedTournaments()
    {
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';

        $tournaments = array();
        if ($game_id != '') {
            $tournaments = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('partner', "flipkart")->where('stop_joining', 1)->where('game_id', $game_id)->orderby('id', 'desc')->paginate(16);
        } else {
            $tournaments = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('partner', "flipkart")->where('stop_joining', 1)->orderby('id', 'desc')->paginate(16);
        }

        $tournaments_player_joined = array();

        foreach ($tournaments as $tournament) {
            $tournament_id = $tournament->id;
            $tournament_type = $tournament->user_type;

            if ($tournament_type == '1') {
                $joined_qry = DB::select(DB::raw("SELECT COUNT(id) as count FROM `gamers_tournaments` where tournament_id='$tournament_id'"));
            } else {
                $joined_qry = DB::select(DB::raw("SELECT COUNT(id) as count FROM `teams_tournaments` where tournament_id='$tournament_id'"));
            }

            if (count($joined_qry) > 0) {
                $tournaments_player_joined[$tournament_id] = $joined_qry[0]->count;
            } else {
                $tournaments_player_joined[$tournament_id] = "?";
            }
        }

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('website.flipkart.tournament.complete', compact('tournaments', 'games', 'tournaments_player_joined'));
    }


    public function getUserPoints()
    {
        if (false or Auth::guard('gamer')->check()) {
            $id = Auth::guard('gamer')->user()->id;
            $registration_referrer_count = DB::table('gamer_points')->where('gamer_id', '=', $id)->where('trigger_event', '=', 'registration_referrer')->count();

            if ($registration_referrer_count == 10) {
                $total_points = DB::table('gamer_points')
                ->where('gamer_id', "=", $id)
                ->sum('points');
            return $total_points;
            } else {
                $total_points = DB::table('gamer_points')->where('gamer_id', '=', $id)->where('trigger_event', '=', 'registration')->sum('points');
            return $total_points;
            }
        } else {
            return 0;
        }
    }


    public function getRedeemCount()
    {
        if (false or Auth::guard('gamer')->check()) {
            $id = Auth::guard('gamer')->user()->id;
            $redeem_counts = DB::table('gift_vouchers')
                ->where('gamer_id', "=", $id)
                ->where('is_used', "=", 1)
                ->count('id');
            return $redeem_counts;
        } else {
            return 0;
        }
    }


    public function earnPoints()
    {
        return view('website.flipkart.earn-points');
    }


    public function comingSoon()
    {
        return view('website.flipkart.coming-soon');
    }



    public function spreadTheWord()
    {
        $desc_text = "Be a part of Flipkart's Fleet Of Gamers & earn 500 Off Coupon Code upon registration. *T&C Apply #FlipkartFleetOfGamers Link URL: https://letsgamenow.com/flipkart-gaming/register";
        return view('website.flipkart.spread-the-word', compact('desc_text'));
    }



    public function referAFriend()
    {
        if (Auth::guard('gamer')->check()) {
            $id = Auth::guard('gamer')->user()->id;
            $user_ref_code = Auth::guard('gamer')->user()->user_ref_code;
            $referral_link = route('flipkart.register', ['ref_code' => $user_ref_code]);
        } else {
            Alert::Html('Error', '<h2> You need to login first to access to this resource </h2>', 'error');
            return redirect(route('flipkart.login'));
        }

        return view('website.flipkart.refer-a-friend', compact('user_ref_code', 'referral_link'));
    }


    public function redeemPoints()
    {
        //Alert::Html('Success', '<h2> Redeem option will be available on 30th September, 2021 </h2>', 'success');
        //return redirect(route('flipkart.gaming'));

        return view('website.flipkart.redeem-points');
    }


    public function redeemPointsDo($points)
    {
//        Alert::Html('Success', '<h2> Redeem option will be available on 30th September, 2021 </h2>', 'success');
//        return redirect(route('flipkart.gaming'));

        if (Auth::guard('gamer')->check()) {
            $id = Auth::guard('gamer')->user()->id;
            $email = Auth::guard('gamer')->user()->email;
            $first_name = Auth::guard('gamer')->user()->fname;
            $last_name = Auth::guard('gamer')->user()->lname;

            $mobile_country_code = Auth::guard('gamer')->user()->num_code;
            $mobile_num = Auth::guard('gamer')->user()->mobile;

            if ($mobile_num != "" && $mobile_country_code != "") {
                $full_mobile_num = "";
                if ($mobile_country_code == 91) {
                    $full_mobile_num = $mobile_num;
                } else {
                    $full_mobile_num = $mobile_country_code . $mobile_num;
                }
            }
        } else {
            Alert::Html('Error', '<h2> You need to login first to access to this resource </h2>', 'error');
            return redirect(route('flipkart.redeem.points'));
        }

        $my_points = $this->getUserPoints();
        if ($my_points < $points) {
            Alert::Html('Error', "<h2> You don't have $points points. </h2>", 'error');
            return redirect(route('flipkart.redeem.points'));
        }


        $redeem_count = $this->getRedeemCount();
        if ($redeem_count >= 1) {
            Alert::Html('Error', "<h2> You already have redeemed " . $redeem_count . " vouchers. Only 1 is allowed. </h2>", 'error');
            return redirect(route('flipkart.redeem.points'));
        }

        
        // if all good
        $assinged_coupon = DB::table('gift_vouchers')
            ->select('*')
            ->where('points', "=", $points)
            ->where('is_used', "=", 0)
            ->where('partner', '=', 'flipkart')
            ->limit('1')
            ->get()
            ->toArray();

//        print_r($assinged_coupon);



        if (!isset($assinged_coupon[0])) {
            Alert::Html('Error', "<h2> No voucher available for $points points. </h2>", 'error');
            return redirect(route('flipkart.redeem.points'));
        } else {
            // mark voucher assigned to user
            DB::table('gift_vouchers')
                ->where('id', $assinged_coupon[0]->id)
                ->update(
                    [
                        'is_used' => 1,
                        'gamer_id' => $id,
                        'voucher_redeemed_at' => Carbon::now()
                    ]
                );

            // insert into gamer_points for transaction record
            $points_m = 0 - $points;
            DB::table('gamer_points')->insert([
                'gamer_id' => $id,
                'trigger_event' => 'redeem',
                'points' => $points_m,
                'voucher' => $assinged_coupon[0]->voucher,
                'channel' => 'flipkart',
                'created_at' => Carbon::now()
            ]);


            // SMS the voucher to the user
            if ($full_mobile_num != "") {
                $sms_content = "Congratulations " . $first_name . "! Your Flipkart voucher code for Rs. " . $assinged_coupon[0]->amount . " is " . $assinged_coupon[0]->voucher;
//                $this->sendSMS($full_mobile_num, $sms_content, true);
            }

            // email the voucher to the user
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $redeem_points_url = route('flipkart.redeem.points');

                $subject = "Congratulations! Your voucher code is inside.";
                $message = 'Hi ' . $first_name . ' ' . $last_name . ",<br><br>Congratulations!!!<br>Your voucher code for Rs " . $assinged_coupon[0]->amount . " is <b>" . $assinged_coupon[0]->voucher . "</b><br>Please visit " . $redeem_points_url . " to see the redemption options.<br><br>Kind Regards,<br>Team - LetsGameNow<br>";
                // $this->sendEMAIL($email, $subject, $message);
            }

            Alert::Html('Success', "<h2> Voucher issued for $points points. </h2>", 'success');
            return view('website.flipkart.redeem-points', compact('assinged_coupon'));
        }
    }



    public function sendSMS($to, $plain_text_content, $return_response = false, $return_final_url = false)
    {
        $text = rawurlencode($plain_text_content);

        $username = "lgnestapi";
        $password = "lgnestapi123";
        $from = "LGNESP";

        $url = "https://103.229.250.200/smpp/sendsms";
//        $url = "https://letsgamenow.com/route-sms.php";

        $final_url = $url . "?username=" . $username . "&password=" . $password . "&to=" . $to . "&from=" . $from . "&text=" . $text;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $final_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $content = curl_exec($ch);
        curl_close($ch);

//        die($content);
//        die($final_url . " >> Response >>> " . $content);

        if ($return_response) {
            if ($return_final_url) {
                return $final_url . " >>> " . $content;
            }
            return $content;
        }
    }



    // public function sendEMAIL($to_email, $subject, $mail_body)
    // {
    //     $data = [
    //         'subject' => $subject,
    //         'mail_body' => $mail_body
    //     ];
    //     Mail::to($to_email)->send(new GenericEmail($data));
    // }



    public function testEmail()
    {
        $mytime = Carbon::now('Asia/Kolkata');

        // test email to nirjhareswar@gmail.com
        $subject = "Test email at " . $mytime->toDateTimeString();
        $message = "Hi Nir Banerjee,<br><br>Congratulations!!!<br>Your voucher code for Rs 50000 is <b>ABC123</b><br>Please visit https://letsgamenow.com to see the redemption options.<br><br>Kind Regards,<br>Team - LetsGameNow<br>";
        // $this->sendEMAIL("nirjhareswar@gmail.com", $subject, $message);

        echo "mail sent at " . $mytime->toDateTimeString() . "<br>";
        die("peace");
    }



    public function testSMS()
    {
        $sms_body = "Hi Nir, your OTP for LetsGameNow is 3254 Please verify your account to continue";
        $ret = $this->sendSMS('9830701260', $sms_body, true, true);
        print_r($ret);

        $mytime = Carbon::now('Asia/Kolkata');
        echo "<br>SMS sent at " . $mytime->toDateTimeString() . "<br>";
        die("peace");
    }

}

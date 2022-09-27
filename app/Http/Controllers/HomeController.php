<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Tournaments;
use App\Models\Gamer;
use Carbon\Carbon;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tournaments= Tournaments::where('tournaments.is_deleted',0)->take(10)->orderBy('id', 'desc')->get();
        $gamer= Gamer::where('is_deleted',0)->take(10)->orderBy('id', 'desc')->get();

        $data['total_gamers'] = DB::select("select count(*) as total_gamers from gamers where is_verified=1 and gamer_type=1");

        $data['total_teams'] = DB::select("select count(*) as total_gamers from teams where is_active=1 and is_deleted=0");

        $data['total_tournaments'] = DB::select("select count(*) as total_tournaments from tournaments where is_active=1 and is_deleted=0");

        $data['ongoing_tournaments'] = DB::select("select count(*) as ongoing_tournaments from tournaments where is_active=1 and is_deleted=0 and is_completed=0");

        $totalreferrer = DB::select("select count(id) as count, reg_ref_code as referrer from gamers WHERE reg_ref_code IS NOT NULL GROUP BY reg_ref_code ORDER BY count(id) DESC limit 10");

        $gamer_points = DB::select("select count(id) as count, points as points from gamer_points GROUP BY points ORDER BY count(id) DESC");
        $social_media_share = DB::select("select gamer_id as gamer_id, count as count from social_media_counts ORDER BY id ASC limit 10");


        $one_week_ago = Carbon::now()->subDays(10)->format('Y-m-d');
        $dates = Gamer::where('created_at', '>=', $one_week_ago)
        ->groupBy('date')->orderBy('date', 'DESC')
        ->get(array(
             DB::raw('Date(created_at) as date'),
             DB::raw('COUNT(*) as "count"')
          ));
        return view('admin.layouts.admin', compact('tournaments', 'gamer', 'social_media_share', 'data', 'gamer_points', 'dates', 'totalreferrer'));
    }

    public function profile()
    {
       
        return view('admin.layouts.profile');
    }

    public function saveprofile(Request $request)
    {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->contact_no;
            $user->address = $request->address;

           
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/gamer/",$imageName);
                $uploadedImage = "new-theme/images/gamer/".$imageName;
                $user->image = $uploadedImage;
            }
            
            $user->save();
            
           Alert::Html('Success', '<h2> User Update Successfully </h2>','success');
            
            return redirect("/dashboard");   
               }


    public function changePassword() {

        return view('admin.layouts.change_password');
    }

    public function changePasswordSave(Request $request) {
       
          $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);   

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

         Alert::Html('Success', '<h2> Your Password Changed Successfully </h2>','success');
            
            return redirect("/dashboard");   
        
    }



}

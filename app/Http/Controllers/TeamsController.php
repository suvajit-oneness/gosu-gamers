<?php
namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Country;
use App\Models\Subscription_type;
use Illuminate\Http\Request;
use App\Models\TeamPlayers;
use App\Models\Gamer;
use App\Models\Platform;
use Alert;
use Session;
use DB;
use DataTables;
use URL;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_name = (isset($_GET['team_name']) && $_GET['team_name'] != '') ? $_GET['team_name'] : '';

        //$teams= Teams::where('is_deleted',0)->orderBy('id', 'desc')->simplePaginate(100);
        $teams = array();

        if ($team_name != '')
        {
            $teams = Teams::where('teams.is_deleted', 0)->where('teams.team_name', 'like', '%' . $team_name . '%')->select('teams.*', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile', 'gamers.created_at')
                ->join('gamers', 'gamers.id', '=', 'teams.gamer_id')
                ->orderBy('teams.id', 'desc')
                ->paginate(100);
        }
        else
        {
            $teams = Teams::where('teams.is_deleted', 0)->select('teams.*', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile', 'gamers.created_at')
                ->join('gamers', 'gamers.id', '=', 'teams.gamer_id')
                ->orderBy('teams.id', 'desc')
                ->paginate(100);
        }

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscription = Subscription_type::all();
        $country = Country::all();
        return view('admin.teams.create', compact('country', 'subscription'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['team_name' => 'required', 'first_name' => 'required', 'last_name' => 'required', 'country_id' => 'required', 'email' => 'required', 'mobile' => 'required', 'password' => 'required', ]);
        $Gamer = new Gamer;
        $Gamer->country_id = $request->country_id;
        $Gamer->fname = $request->first_name;
        $Gamer->lname = $request->last_name;
        $Gamer->email = $request->email;
        $Gamer->mobile = $request->mobile;
        $Gamer->password = md5($request->password);
        $Gamer->is_verified = '1';
        $Gamer->gamer_type = 2;

        if ($Gamer->save())
        {
            $res = $Gamer->id;
            $Team = new Teams;
            $Team->team_name = trim($request->input('team_name'));
            $Team->subscription_type = 0;
            $Team->gamer_id = $res;
            $Team->country_id = trim($request->input('country_id'));
            if ($Team->save())
            {
                $res1 = $Team->id;
                $Players = new TeamPlayers;
                $Players->team_id = $res1;
                $Players->name = $Gamer->fname . ' ' . $Gamer->lname;
                $Players->email = $Gamer->email;
                $Players->email = strtolower($Gamer->email);
                $Players->phone_no = trim($request->input('mobile'));
                $Players->is_captain = '2';
                $Players->save();
            }
        }
        Alert::Html('Success', '<h2> Team Created Successfully </h2>', 'success');
        return redirect("teams");
    }

    public function addteamplayers($id)
    {

        $platforms = Platform::all();

        return view('admin.teams.addteamplayers', compact('id', 'platforms'));

    }

    public function addteammembers(Request $request)
    {
        $count = TeamPlayers::where('team_id', $request->team_id)
            ->count();
        if ($count >= 6)
        {
            Alert::Html('<h2> Max Player is already full </h2>', 'Warning');
            return redirect()->back();
        }
        else
        {
            $Players = new TeamPlayers;
            $Players->team_id = $request->team_id;
            $Players->name = $request->name;
            $Players->email = $request->email;
            $Players->phone_no = $request->mobile;
            $Players->platform_id = $request->platform_id;
            $Players->ingame_name = $request->platfromname;
            $Players->ingame_id = $request->platfromnumber;
            $Players->is_captain = '1';
            $Players->save();
            Alert::Html('Success', '<h2> Team Players Created Successfully </h2>', 'success');
            return redirect("teams");
        }
    }

    public function show($id)
    {
        $teams = Teams::find($id);
        return view('admin.teams.show', compact('teams'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teams  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teams = Teams::findOrFail($id);
        $subscription = Subscription_type::all();
        $subscriptionname = Subscription_type::find($teams->subscription_type);
        $country = Country::all();
        $countryname = Country::find($teams->country_id);
        return view('admin.teams.edit', compact('country', 'subscription', 'teams', 'subscriptionname', 'countryname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $Teams_id = $request->id;
        $Teams = Teams::find($Teams_id);
        $Teams->team_name = $request->team_name;
        // $Teams->subscription_type = $request->subscription_name;
        // $Teams->fname = $request->fname;
        // $Teams->lname = $request->lname;
        // $Teams->country_id = $request->country_id;
        // $Teams->email = $request->email;
        $Teams->save();
        Alert::Html('Success', '<h2> Team Updated Successfully </h2>', 'success');
        return redirect("teams");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teams  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Teams = Teams::find($id);
        $status = $Teams->is_deleted;
        if ($status == 0)
        {
            $Teams->is_deleted = '1';
        }
        else
        {
            $Teams->is_deleted = '0';
        }
        $Teams->save();
        Alert::Html('Success', '<h2> Teams Deleted Successfully </h2>', 'success');
        return redirect('teams');
    }
    public function changeStatus($id)
    {
        $teams = Teams::find($id);
        $status = $teams->is_active;
        if ($status == 1)
        {
            $teams->is_active = '0';
        }
        else
        {
            $teams->is_active = '1';
        }
        $teams->save();
        Alert::Html('Success', '<h2> Team Status Changed </h2>', 'success');
        return redirect('teams');
    }

    public function datatable(Request $request)
    {

        if ($request->ajax())
        {
            $data = Teams::where('teams.is_deleted', 0)->select('teams.*', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile', 'gamers.created_at')
                ->join('gamers', 'gamers.id', '=', 'teams.gamer_id')
                ->orderBy('teams.id', 'desc')
                ->get();
            return Datatables::of($data)->addIndexColumn()->editColumn("created_at", function ($data)
            {
                return date("d-M-Y h:i a", strtotime($data->created_at));
            })->editColumn("status", function ($data)
            {
                if ($data->is_active == 0) return '<a class="badge bg-danger" href="' . URL::to('teams/change-status/' . $data->id) . '">Inactive</a>';
                if ($data->is_active == 1) return '<a class="badge bg-success" href="' . URL::to('teams/change-status/' . $data->id) . '">Active</a> ';
            })->editColumn("action_btns", function ($data)
            {
                return '<a class="badge bg-primary" href="' . route('addteamplayers', $data->id) . '"></i>Add Team Member </a>
                            <a href="javascript:void(0)" class="badge bg-success showmyModal"data-id="' . $data->id . '" >Show Team Member</a>';
            })
                ->rawColumns(['action', 'action_btns', 'status'])
                ->make(true);
        }
        $teamsplayers = TeamPlayers::where('is_deleted', 0)->get();

        return view('teamsdatatable');

    }

    public function teammemberdatatable(Request $request)
    {

        if ($request->ajax())
        {
            $data = TeamPlayers::latest()->Where('team_id', $request->id)
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->make(true);
        }
        return view('teamsdatatable');

    }

    public function sendEmail(Request $request)
    {
        $subject = $request->subject;
        $message = $request->message;
        $to = $request->to;

        $header = "From: LetsGameNow<info@letsgamenow.com> \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $retval = mail($to, $subject, $message, $header);

        Alert::Html('Success', '<h2> Email has been successfully sent to all selected gamers</h2>', 'success');
        return redirect()->back();
    }
}


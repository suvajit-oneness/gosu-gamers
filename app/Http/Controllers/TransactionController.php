<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = (isset($_GET['transaction']) && $_GET['transaction'] != '') ? $_GET['transaction'] : '';
        $from_date = (isset($_GET['from_date']) && $_GET['from_date'] != '') ? $_GET['from_date'] : '';
        $to_date = (isset($_GET['to_date']) && $_GET['to_date'] != '') ? $_GET['to_date'] : '';
        if ($from_date != '' && $to_date != '')
        {
            $gamers = DB::table('gamer_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'gamer_tournament_payments.*', DB::raw("CONCAT(gamers.fname,' ',gamers.lname) as name"))
                ->leftjoin('tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->whereBetween(DB::raw('DATE(gamer_tournament_payments.created_at)') , array(
                $from_date,
                $to_date
            ));
            $teams = DB::table('team_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'team_tournament_payments.*', "teams.team_name as name")
                ->leftjoin('tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('teams', 'team_tournament_payments.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->whereBetween(DB::raw('DATE(team_tournament_payments.created_at)') , array(
                $from_date,
                $to_date
            ))->union($gamers)->get();
        }
        elseif ($transaction != '')
        {
            $gamers = DB::table('gamer_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'gamer_tournament_payments.*', DB::raw("CONCAT(gamers.fname,' ',gamers.lname) as name"))
                ->leftjoin('tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')->where(function ($query) use ($transaction)
            {
                $query->where('gamers.fname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.lname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.email', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.mobile', 'like', '%' . $transaction . '%');
                $query->orWhere('tournaments.name', 'like', '%' . $transaction . '%');
                $query->orWhere('gamer_tournament_payments.transaction_id', 'like', '%' . $transaction . '%');
                $query->orWhere('currencies.currency_name', 'like', '%' . $transaction . '%');
            });
            $teams = DB::table('team_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'team_tournament_payments.*', "teams.team_name as name")
                ->leftjoin('tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('teams', 'team_tournament_payments.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')->where(function ($query) use ($transaction)
            {
                $query->where('gamers.fname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.lname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.email', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.mobile', 'like', '%' . $transaction . '%');
                $query->orWhere('tournaments.name', 'like', '%' . $transaction . '%');
                $query->orWhere('teams.team_name', 'like', '%' . $transaction . '%');
                $query->orWhere('team_tournament_payments.transaction_id', 'like', '%' . $transaction . '%');
                $query->orWhere('currencies.currency_name', 'like', '%' . $transaction . '%');
            })->union($gamers)->get();
        }
        else
        {
            $gamers = DB::table('gamer_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'gamer_tournament_payments.*', DB::raw("CONCAT(gamers.fname,' ',gamers.lname) as name"))
                ->leftjoin('tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id');
            $teams = DB::table('team_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'team_tournament_payments.*', "teams.team_name as name")
                ->leftjoin('tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('teams', 'team_tournament_payments.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->union($gamers)->get();
        }
        return view('admin.transaction.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indivtransac()
    {
        $transaction = (isset($_GET['transaction']) && $_GET['transaction'] != '') ? $_GET['transaction'] : '';
        $from_date = (isset($_GET['from_date']) && $_GET['from_date'] != '') ? $_GET['from_date'] : '';
        $to_date = (isset($_GET['to_date']) && $_GET['to_date'] != '') ? $_GET['to_date'] : '';
        if ($from_date != '' && $to_date != '')
        {
            $gamers = DB::table('gamer_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'gamer_tournament_payments.*', DB::raw("CONCAT(gamers.fname,' ',gamers.lname) as name"))
                ->leftjoin('tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->whereBetween(DB::raw('DATE(gamer_tournament_payments.created_at)') , array(
                $from_date,
                $to_date
            ))->get();
        }
        elseif ($transaction != '')
        {
            $gamers = DB::table('gamer_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'gamer_tournament_payments.*', DB::raw("CONCAT(gamers.fname,' ',gamers.lname) as name"))
                ->leftjoin('tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')->where(function ($query) use ($transaction)
            {
                $query->where('gamers.fname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.lname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.email', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.mobile', 'like', '%' . $transaction . '%');
                $query->orWhere('tournaments.name', 'like', '%' . $transaction . '%');
                $query->orWhere('gamer_tournament_payments.transaction_id', 'like', '%' . $transaction . '%');
                $query->orWhere('currencies.currency_name', 'like', '%' . $transaction . '%');
            })->get();
        }
        else
        {
            $gamers = DB::table('gamer_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'gamer_tournament_payments.*', DB::raw("CONCAT(gamers.fname,' ',gamers.lname) as name"))
                ->leftjoin('tournaments', 'gamer_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('gamers', 'gamer_tournament_payments.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->get();

        }
        return view('admin.transaction.gamers', compact('gamers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function teamtransac()
    {
        $transaction = (isset($_GET['transaction']) && $_GET['transaction'] != '') ? $_GET['transaction'] : '';
        $from_date = (isset($_GET['from_date']) && $_GET['from_date'] != '') ? $_GET['from_date'] : '';
        $to_date = (isset($_GET['to_date']) && $_GET['to_date'] != '') ? $_GET['to_date'] : '';
        if ($from_date != '' && $to_date != '')
        {
            $teams = DB::table('team_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'team_tournament_payments.*', "teams.team_name as name")
                ->leftjoin('tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('teams', 'team_tournament_payments.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->whereBetween(DB::raw('DATE(team_tournament_payments.created_at)') , array(
                $from_date,
                $to_date
            ))->get();
        }
        elseif ($transaction != '')
        {
            $teams = DB::table('team_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'team_tournament_payments.*', "teams.team_name as name")
                ->leftjoin('tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('teams', 'team_tournament_payments.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')->where(function ($query) use ($transaction)
            {
                $query->where('gamers.fname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.lname', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.email', 'like', '%' . $transaction . '%');
                $query->orWhere('gamers.mobile', 'like', '%' . $transaction . '%');
                $query->orWhere('tournaments.name', 'like', '%' . $transaction . '%');
                $query->orWhere('teams.team_name', 'like', '%' . $transaction . '%');
                $query->orWhere('team_tournament_payments.transaction_id', 'like', '%' . $transaction . '%');
                $query->orWhere('currencies.currency_name', 'like', '%' . $transaction . '%');
            })->get();
        }
        else
        {
            $teams = DB::table('team_tournament_payments')->select("tournaments.name as tournaments", "tournaments.part_amount as amount", "currencies.currency_name as cname", "gamers.*", 'team_tournament_payments.*', "teams.team_name as name")
                ->leftjoin('tournaments', 'team_tournament_payments.tournament_id', '=', 'tournaments.id')
                ->leftjoin('teams', 'team_tournament_payments.team_id', '=', 'teams.id')
                ->leftjoin('gamers', 'teams.gamer_id', '=', 'gamers.id')
                ->leftjoin('currencies', 'tournaments.part_currency', '=', 'currencies.id')
                ->get();
        }

        return view('admin.transaction.teams', compact('teams'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
    }
}


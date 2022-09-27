<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Gamer;
use App\Models\GamerPoint;
use App\Models\SocialMediaCount;
use App\Models\SocialDailyCount;
use App\Models\Teams;
use App\Models\GiftVoucher;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GamersExport;
use App\Exports\RegistrationExport;
use App\Exports\ReferrerExport;
use App\Exports\VoucherExport;
use App\Exports\SocialMediaExport;
use App\Exports\SocialDailyExport;
use App\Exports\TeamsExport;
use App\Imports\VoucherImport;
use Session;

class ReportController extends Controller {
    public function gamer_count() {

        return view( 'admin.report.index' );

    }

    public function countUser() {
        $dataBag = array();
        $fdate = date( 'Y-m-d', strtotime( $_REQUEST['from_date'] ) );
        $tdate = date( 'Y-m-d', strtotime( $_REQUEST['to_date'] ) );
        $utype = $_REQUEST['utype'];

        $list = array();

        // $interval = new DateInterval( 'P1D' );
        if ( $utype == 0 ) {
            $dataBag['total'] = Gamer::whereBetween( 'created_at', array(
                $fdate,
                $tdate
            ) )->get()
            ->count();

            $from = strtotime( $fdate );
            $to = strtotime( $tdate );
            //    $list = Users::where( 'created_at', 'like', $to.'%' )->get()->count();
            for ( $i = $from; $i < $to; $i += 86400 ) {

                $dt = date( 'Y-m-d', $i );

                //    echo $dt.'<br>';
                $list[date( 'Y-m-d', $i ) ] = Gamer::where( 'created_at', 'like', $dt . '%' )->get()
                ->count();

            }
        } else {
            $dataBag['total'] = Gamer::where( 'gamer_type', $utype )->whereBetween( 'created_at', array(
                $fdate,
                $tdate
            ) )->get()
            ->count();

            $from = strtotime( $fdate );
            $to = strtotime( $tdate );
            //    $list = Users::where( 'created_at', 'like', $to.'%' )->get()->count();
            for ( $i = $from; $i < $to; $i += 86400 ) {

                $dt = date( 'Y-m-d', $i );

                //    echo $dt.'<br>';
                $list[date( 'Y-m-d', $i ) ] = Gamer::where( 'gamer_type', $utype )->where( 'created_at', 'like', $dt . '%' )->get()
                ->count();

            }

        }

        $dataBag['list'] = $list;

        //    echo '<pre>';
        // print_r( $list );
        // die();
        return view( 'admin.report.count_user_list', $dataBag );
    }

    public function gamer_details() {

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {

            $gamer = Gamer::where( 'is_deleted', 0 )
            ->whereBetween( DB::raw( 'DATE(gamers.created_at)' ), array(
                $from_date,
                $to_date
            ) )->orderBy( 'id', 'desc' )
            ->paginate( 100 );
        } else {
            $gamer = $gamer = null;
        }

        return view( 'admin.report.gamer_details', compact( 'gamer' ) );

    }

    public function team_details() {

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {

            $gamer = Teams::where( 'teams.is_deleted', 0 )->select( 'teams.*', 'gamers.fname', 'gamers.lname', 'gamers.email', 'gamers.mobile', 'gamers.created_at' )
            ->join( 'gamers', 'gamers.id', '=', 'teams.gamer_id' )
            ->whereBetween( DB::raw( 'DATE(gamers.created_at)' ), array(
                $from_date,
                $to_date
            ) )->orderBy( 'id', 'desc' )
            ->paginate( 100 );
        } else {
            $gamer = null;

        }

        return view( 'admin.report.team_details', compact( 'gamer' ) );

    }
    public function registration_details() {

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {
            $registration = Gamer::where( 'is_deleted', 0)
            ->whereBetween( DB::raw( 'DATE(gamers.created_at)' ), array(
                $from_date,
                $to_date
            ))
            ->groupBy('date')->orderBy('date', 'DESC')->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "count"')
             ));
        } else {
            $registration = null;
        }

        return view( 'admin.report.registration_details', compact('registration' ) );

    }
    public function social_daily_details() {

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {
            $dailyreport = SocialDailyCount::where( 'is_deleted', 0)
            ->whereBetween( DB::raw( 'DATE(social_daily_counts.created_at)' ), array(
                $from_date,
                $to_date
            ))
            ->groupBy('date')->orderBy('date', 'DESC')->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "count"')
             ));
        } else {
            $dailyreport = null;
        }

        return view( 'admin.report.social_daily_details', compact('dailyreport' ) );

    }
    public function referrer_details() {

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {

            $referrer = Gamer::where( 'is_deleted', 0)->whereBetween( DB::raw( 'DATE(created_at)' ), array(
                $from_date,
                $to_date
            ))->groupBy('reg_ref_code')->orderBy('reg_ref_code', 'DESC')->get(array(
                DB::raw('reg_ref_code as referrer'),
                DB::raw('reg_ref_code is not null'),
                DB::raw('COUNT(*) as "count"')
             ));
        } else {
            $referrer = null;
        }
        return view( 'admin.report.referrer_details', compact('referrer' ) );

    }
    public function voucher_details() {

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {

            $voucher = GamerPoint::where('is_deleted', 0)->whereBetween( DB::raw( 'DATE(created_at)' ), array(
                $from_date,
                $to_date
            ))->groupBy('points')->orderBy('points', 'DESC')->get(array(
                DB::raw('points as points'),
                DB::raw('COUNT(*) as "count"')
             ));
            //  $gamer_points = DB::select("select count(id) as count, points as points from gamer_points GROUP BY points ORDER BY count(id) DESC");
        } else {
            $voucher = null;
        }
        return view( 'admin.report.voucher_details', compact('voucher' ) );

    }
    public function social_details(){

        $from_date = ( isset( $_GET['from_date'] ) && $_GET['from_date'] != '' ) ? $_GET['from_date'] : '';
        $to_date = ( isset( $_GET['to_date'] ) && $_GET['to_date'] != '' ) ? $_GET['to_date'] : '';

        if ( $from_date != '' && $to_date != '' ) {

            $socialreport = SocialMediaCount::where('is_deleted', 0)->whereBetween( DB::raw( 'DATE(created_at)' ), array(
                $from_date,
                $to_date
            ))->orderBy('id', 'DESC')->get(array(
                DB::raw('gamer_id as gamer_id'),
                DB::raw('count as "count"')
             ));
             $social_media_share = DB::select("select gamer_id as gamer_id, count as count from social_media_counts ORDER BY id ASC");
        } else {
            $socialreport = null;
        }
        return view( 'admin.report.socialmedia_details', compact('socialreport' ) );

    }

    public function gamer_details_export( $from_date, $to_date ) {

        return Excel::download( new GamersExport( $from_date, $to_date ), 'gamers.xlsx' );

    }

    public function team_details_export( $from_date, $to_date ) {

        return Excel::download( new TeamsExport( $from_date, $to_date ), 'teams.xlsx' );

    }
    public function registration_details_export( $from_date, $to_date ) {

        return Excel::download( new RegistrationExport( $from_date, $to_date ), 'registration.xlsx' );

    }
    public function social_daily_details_export( $from_date, $to_date ) {

        return Excel::download( new SocialDailyExport( $from_date, $to_date ), 'SocialDailyReport.xlsx' );

    }
    public function referrer_details_export( $from_date, $to_date ) {

        return Excel::download( new ReferrerExport( $from_date, $to_date ), 'referrerData.xlsx' );

    }
    public function voucher_details_export( $from_date, $to_date ) {

        return Excel::download( new VoucherExport( $from_date, $to_date ), 'VoucherRedeemedData.xlsx' );

    }
    public function socialmedia_details_export( $from_date, $to_date ) {

        return Excel::download( new SocialMediaExport( $from_date, $to_date ), 'SocialMediaData.xlsx' );

    }


    // import data
        public function importFile(Request $request){
        return view( "admin.report.gift_voucher_import_file");
    }
    // public function VoucherImport(Request $request){
    //     dd($request->file('file'));
    //     Excel::store(new GiftVoucher, $request->file('file')->store('files'));
    //     return redirect()->back();
    // }

    public function VoucherImport(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'extra';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {

                        $insertData = array(
                            "voucher" => isset($importData[0]) ? $importData[0] : null,
                            "points" => isset($importData[1]) ? $importData[1] : null,
                            "amount" => isset($importData[2]) ? $importData[2] : null,
                            "is_used" => isset($importData[3]) ? $importData[3] : 0,
                            "gamer_id" => isset($importData[4]) ? $importData[4] : null,
                            "voucher_redeemed_at" => isset($importData[6]) ? $importData[6] : null,
                        );
                        // echo '<pre>';print_r($insertData);exit();
                // dd($insertData);
                        GiftVoucher::insertData($insertData);
                    }
                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }
        return redirect()->back();
    }
}


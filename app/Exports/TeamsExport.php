<?php

namespace App\Exports;

use App\Models\Gamer;
use App\Models\Teams;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TeamsExport implements FromCollection, WithHeadings {
    public function __construct( $from_date, $to_date ) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection() {
        return Teams::where( 'teams.is_deleted', 0 )
        ->select( 'teams.team_name', 'gamers.email', 'gamers.mobile', 'gamers.created_at' )
        ->join( 'gamers', 'gamers.id', '=', 'teams.gamer_id' )
        ->whereBetween( DB::raw( 'DATE(gamers.created_at)' ), array( $this->from_date, $this->to_date ) )
        ->orderBy( 'teams.id', 'desc' )
        ->get();
    }

    public function headings(): array {

        return [

            'Name',

            'Email',

            'Mobile',

            'Created at',

        ];

    }
}

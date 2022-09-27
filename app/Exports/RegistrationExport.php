<?php

namespace App\Exports;

use App\Models\Gamer;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationExport implements FromCollection, WithHeadings {
    public function __construct( $from_date, $to_date ) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection() {
        return Gamer::where( 'is_deleted', 0 )
            ->whereBetween( DB::raw( 'DATE(gamers.created_at)' ), array($this->from_date, $this->to_date))
            ->groupBy('date')->orderBy('date', 'DESC')->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "count"')
             ));
    }

    public function headings(): array {

        return [
            'Date',

            'Total Registration',

        ];

    }
}

<?php

namespace App\Exports;

use App\Models\Gamer;
use App\Models\GamerPoint;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VoucherExport implements FromCollection, WithHeadings {
    public function __construct( $from_date, $to_date ) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection() {
        return GamerPoint::where( 'is_deleted', 0 )->where('points', -500)
            ->whereBetween( DB::raw( 'DATE(gamer_points.created_at)' ), array($this->from_date, $this->to_date))
            ->groupBy('points')->orderBy('points', 'DESC')->get(array(
                DB::raw('points as points'),
                DB::raw('COUNT(*) as "count"')
        ));
    }

    public function headings(): array {

        return [
            'Points',
            'Total Count',

        ];

    }
}

<?php

namespace App\Exports;

use App\Models\SocialMediaCount;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SocialMediaExport implements FromCollection, WithHeadings {
    public function __construct( $from_date, $to_date ) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection() {
        return SocialMediaCount::where( 'is_deleted', 0 )
        ->whereBetween( DB::raw( 'DATE(social_media_counts.created_at)' ), array($this->from_date, $this->to_date))
            ->orderBy('id', 'DESC')->get(array(
                DB::raw('gamer_id as gamer_id'),
                DB::raw('count as "count"')
        ));
    }

    public function headings(): array {

        return [
            'Gamer ID',
            'Total Count',

        ];

    }
}

<?php

namespace App\Exports;

use App\Models\Gamer;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GamersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($from_date,$to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection()
    {
       return Gamer::where('is_deleted',0)
        //  ->where('gamer_type','1')
         ->select('fname','lname','email','mobile')
         ->whereBetween(DB::raw('DATE(gamers.created_at)'), array($this->from_date, $this->to_date))
        ->orderBy('id', 'desc')->get();
    }

        public function headings(): array

    {

        return [

            
            'First Name',

            'Last Name',

            'Email',

            'Mobile',

        ];

    }
}


// class GamersExport implements FromView
// {
//     public function view(): View
//     {
//         return view('admin.report.table', [
//            'gamer'=> Gamer::where('is_deleted',0)
//          ->where('gamer_type','1')         
//         ->orderBy('id', 'desc')
//         ->get()
//         ]);
//     }
// }
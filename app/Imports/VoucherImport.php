<?php

namespace App\Imports;

use App\Models\GiftVoucher;
use Maatwebsite\Excel\Concerns\ToModel;

class VoucherImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GiftVoucher([
            'voucher' => $row[0],
            'points' => $row[1],
            'amount' => bcrypt($row[2]),
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class GiftVoucher extends Model
{

    public static function insertData($data) {
        $value = DB::table('gift_vouchers')->where('voucher', $data['voucher'])->get();
        if($value->count() == 0) {
           DB::table('gift_vouchers')->insert($data);
        }
    }
}

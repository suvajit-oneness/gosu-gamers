<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Gamer extends Authenticatable {
    use Notifiable;
    protected $guard = 'gamer';

    // protected $fillable = [
    //     'firstname', 'midname', 'lastname', 'email', 'address', 'password',
    // ];

    protected $fillable = [
        'username', 'fname', 'lname', 'country_id', 'email', 'password', 'mobile', 'num_code', 'image', 'id_proof', 'gender', 'dob', 'gamer_type', 'ref_code', 'otp', 'is_verified', 'is_active', 'is_deleted', 'partner', 'reg_ref_code', 'user_ref_code', 'reg_ref_points_credited', 'forgot_password_hash', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function team() {

        return $this->hasOne( 'App\Models\Teams', 'gamer_id', 'id' );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
        protected $table = 'subscriptions';
    protected $primaryKey = "id";

    public function subscription_types(){
        return $this->belongsTo(\App\Models\Subscription_types::class, 'type_id', 'id');
    }

    public function country(){
        return $this->belongsTo(\App\Models\Country::class, 'country_id', 'id');
    }
}

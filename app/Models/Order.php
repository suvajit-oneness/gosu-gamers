<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = "id";

    public function subscription()
    {
    	return $this->belongsTo(\App\Models\Subscriptions::class, 'subscription_id', 'id');
    }
}

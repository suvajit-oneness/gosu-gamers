<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $partners = ["lgn" => "Lets Game Now", "flipkart" => "FlipKart"];

    public function getPartners()
    {
        return $this->partners;
    }
}

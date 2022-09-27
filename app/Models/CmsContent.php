<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    public function getcontentAttribute($value)
    {
      return  strip_tags(html_entity_decode($value));
    }
}
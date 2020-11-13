<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daily_detail extends Model
{
    Public function dailies()
    {
      return $this->hasOne('App\Dailies', 'product_dailies_id');
    }
}

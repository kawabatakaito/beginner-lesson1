<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{

  Public function daily_details()
  {
    return $this->hasMany('App\DailyDetail');
  }
}

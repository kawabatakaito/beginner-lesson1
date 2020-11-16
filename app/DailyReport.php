<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    Public function daily_detail()
    {
      return $this->hasOne('App\DailyDetail');
    }
}

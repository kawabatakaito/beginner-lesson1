<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyDetail extends Model
{
    protected $guarded = ['id'];

    Public function daily_report()
    {
      return $this->belongsTo('App\DailyReport');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dailies extends Model
{
    Public function Daily_deteil()
    {
      return $this->hasOne('App\Daily_detail', 'product_dailies_id');
    }
}

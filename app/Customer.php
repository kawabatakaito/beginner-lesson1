<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'code',
        'postal_code',
        'address',
        'tel',
        'fax',
    ];
}

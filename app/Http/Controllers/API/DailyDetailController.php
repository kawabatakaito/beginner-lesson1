<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DailyReport;
use App\DailyDetail;

class DailyDetailController extends Controller
{
    public function index()
    {
        return DailyDetail::all();
    }

}

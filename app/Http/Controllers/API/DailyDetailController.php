<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dailies;
use App\Daily_detail;

class DailyDetailController extends Controller
{
    public function index()
    {
        return Daily_detail::all();
    }

}

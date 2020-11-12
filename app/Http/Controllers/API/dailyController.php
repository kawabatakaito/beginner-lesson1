<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Daily;

class dailyController extends Controller
{
    public function index()
    {
        return Daily::all();
    }
}

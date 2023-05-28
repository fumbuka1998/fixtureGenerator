<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchReportController extends Controller
{
    // a function to get the view of report
    public function index(){
        return view('matchReport');
    }
}

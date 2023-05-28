<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchController extends Controller
{
    //match page
    public function index(){
        return view('matches');
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class BoardMemberController extends Controller
{
    //fetch the forms to add the board members
    public function index(){
        return view('addMembers/addBoardMembers');
    }
}

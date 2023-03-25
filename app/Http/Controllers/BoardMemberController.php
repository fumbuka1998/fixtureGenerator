<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoardMemberController extends Controller
{
    public function index()
    {
        return view('addMembers.addBoardMembers');
    }

    public function fetchMembers()
    {
        $member = BoardMember::all();

        return response()->json([
            'students' => $member,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'member_id'=>
            'member_name' => 'required|max:200',
            'member_email' => 'required|email|max:200',
            'member_pic' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages(),
            ]);
        } else {
            $member = new BoardMember;
            $member->member_name = $request->input('member_name');
                $member->member_email = $request->input('member_email');
                $member->member_pic = $request->input('member_pic');
            $member->save();
            return response()->json([
                'status' => 200,
                'message' => 'Student was added successfully'
            ]);
        }
    }

    //a function to edit member
    public function edit($id)
    {
        $std = BoardMember::find($id);

        if ($std) {
            return response()->json([
                'status' => 200,
                'message' => 'member was found',
                'member' => $std
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'member not found'
            ]);
        }
    }

    //function to update member details to the database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'member_name' => 'required|max:200',
            'member_email' => 'required|email|max:200',
            'member_pic' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages(),
            ]);
        } else {
            $member = BoardMember::find($id);

            if ($member) {
                $member->member_name = $request->input('member_name');
                $member->member_email = $request->input('member_email');
                $member->member_pic = $request->input('member_pic');
                $member->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'member was updated successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'member not found'
                ]);
            }
        }
    }

    //a function to delete a member data from the database
    public function deleteMember($id)
    {
        $member = BoardMember::find($id);
        $member->delete();
        return response()->json([
            'status' => 200,
            'message' => 'member deleted successfully'
        ]);
    }
}

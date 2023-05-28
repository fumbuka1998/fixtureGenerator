<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
// use DB;

class BoardMemberController extends Controller
{
    //     public function index()
    //     {
    //         return view('addMembers.addBoardMembers');
    //     }

    //     public function fetchMembers()
    //     {
    //         $member = BoardMember::all();

    //         return response()->json([
    //             'students' => $member,
    //         ]);
    //     }

    //     public function store(Request $request)
    //     {
    //         $validator = Validator::make($request->all(), [
    //             // 'member_id'=>
    //             'member_name' => 'required|max:200',
    //             'member_email' => 'required|member_email|max:200',
    //             'member_pic' => 'required',

    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 400,
    //                 'error' => $validator->messages(),
    //             ]);
    //         } else {
    //             $member = new BoardMember;
    //             $member->member_name = $request->input('member_name');
    //                 $member->member_email = $request->input('member_email');
    //                 $member->member_pic = $request->input('member_pic');
    //             $member->save();
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Student was added successfully'
    //             ]);
    //         }
    //     }

    //     //a function to edit member
    //     public function edit($member_id)
    //     {
    //         $std = BoardMember::find($member_id);

    //         if ($std) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'member was found',
    //                 'member' => $std
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'member not found'
    //             ]);
    //         }
    //     }

    //     //function to update member details to the database
    //     public function update(Request $request, $member_id)
    //     {
    //         $validator = Validator::make($request->all(), [
    //             'member_name' => 'required|max:200',
    //             'member_email' => 'required|member_email|max:200',
    //             'member_pic' => 'required',

    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 400,
    //                 'error' => $validator->messages(),
    //             ]);
    //         } else {
    //             $member = BoardMember::find($member_id);

    //             if ($member) {
    //                 $member->member_name = $request->input('member_name');
    //                 $member->member_email = $request->input('member_email');
    //                 $member->member_pic = $request->input('member_pic');
    //                 $member->update();
    //                 return response()->json([
    //                     'status' => 200,
    //                     'message' => 'member was updated successfully'
    //                 ]);
    //             } else {
    //                 return response()->json([
    //                     'status' => 404,
    //                     'message' => 'member not found'
    //                 ]);
    //             }
    //         }
    //     }

    //     //a function to delete a member data from the database
    //     public function deleteMember($member_id)
    //     {
    //         $member = BoardMember::find($member_id);
    //         $member->delete();
    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'member deleted successfully'
    //         ]);
    //     }
    // }
    // 336a1411d485e6a9223e7d2923b0ff07420903c9

    // 7e66e95c781be8ae5e8833e426a2e443b98f2b44

    // new with sweetalert

    // set index page view
    public function index()
    {
        return view('addMembers.addBoardMembers');
    }

    // handle fetch all eamployees ajax request
    public function fetchAll()
    {

        $membr = BoardMember::all();
        $output = '';
        if ($membr->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
        <thead>
          <tr>
            <th>Member ID</th>
            <th>Member Pic</th>
            <th>Member Name</th>
            <th>Member E-mail</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
            foreach ($membr as $membs) {
                $output .= '<tr>
            <td>' . $membs->member_id . '</td>
            <td><img src="../../storage/images/'.$membs->member_pic . '" width="50" class="img-thumbnail rounded-circle"></td>
            <td>' . $membs->member_name . '</td>
            <td>' . $membs->member_email . '</td>
            
            <td>
              <a href="#" member_id="' . $membs->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editMemberModal"><i class="bi-pencil-square h4"></i></a>

              <a href="#" member_id="' . $membs->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
            </td>
          </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Member ajax request
    public function store(Request $request)
    {
        // print_r($_POST);
        // print_r($_FILES);
        // exit();
        $file = $request->file('member_pic');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/storage/images/', $fileName);

        $membData = ['member_name' => $request->member_name, 'member_id' => $request->member_id, 'member_email' => $request->member_email,  'member_pic' => $fileName];
        // var_dump($membData);
        // exit();
        // $membData->save();

        BoardMember::create($membData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit  Member ajax request
    public function edit(Request $request)
    {
        $member_id = $request->member_id;
        $membs = BoardMember::find($member_id);
        return response()->json($membs);
    }

    // handle update an Member ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $membs = BoardMember::find($request->id);
        if ($request->hasFile('member_pic')) {
            $file = $request->file('member_pic');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/storage/images', $fileName);
            if ($membs->member_pic) {
                Storage::delete('../../storage/images/' . $membs->member_pic);
            }
        } else {
            $fileName = $request->member_pic;
        }

        $membData = ['member_name' => $request->member_name, 'member_id' => $request->member_id, 'member_email' => $request->member_email,  'member_pic' => $fileName];

        $membs->update($membData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Member ajax request
    public function delete(Request $request, $id)
    {
        $id = $request->member_id;
        $membs = BoardMember::find($id);
        // var_dump($membs);
        // exit();

        if (Storage::delete('../../storage/images/' . $membs->member_pic)) {
            BoardMember::destroy($id);
        }
    }
}

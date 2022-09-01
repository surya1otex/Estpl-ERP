<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\User;
use App\District;
use App\Block;
class Apicontroller extends Controller
{
    public function listusers()
    {
        $u_Details = [];
        $users = User::all(); 
        foreach($users as $user) {
            array_push($u_Details, array('name' => $user->fullname, 'email' => $user->email, 'date' => $user->created_at->format('F d, Y h:ia'), 'role' => $user->roles()->pluck('name')->implode(' ')));
        }
        return response()->json($u_Details);
    }

    public function getDistricts()
    {
        $data = District::get();
   
        return response()->json($data, 200);
    }

    public function getBlocks(Request $request)
    {
        $data = Block::where('dist_id', $request->district_id)->get();
   
        return response()->json($data);
    }

    public function loadBlocks(Request $request)
    {
       $data = Block::where('dist_id', $request->district_id)->get();
       return response()->json($data);
    }

    public function getAttributes(Request $request)
    {
        $data = Client::where('id', $request->id)->get();
        return response()->json($data);   
    }

}

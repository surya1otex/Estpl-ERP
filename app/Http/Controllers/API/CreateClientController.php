<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CreateClientController extends Controller
{
    public $successStatus = 200;
    
     public function listclients() {
         $data = Client::all();
         return response()->json(['success'=> $data], $this->successStatus);
     }

    public function createSchool(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'client_name' => 'required', 
            'email' => 'required|email', 
            'phone' => 'required',  
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $client = Client::create($input);
        //$client->save();
        return response()->json(['success'=>$client], 201); 
    }
}
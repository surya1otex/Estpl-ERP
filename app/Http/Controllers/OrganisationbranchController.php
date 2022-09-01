<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Organisationbranch;
use App\Organisation;
use Auth;
use URL;
use Session;
use Illuminate\Support\Facades\DB;

class OrganisationbranchController extends Controller
{
    public function index()
    {
        $branchs=Organisationbranch::all();
        $organisations = Organisation::all(); 
        return view ('organisationbranch.index')->with(compact('branchs','organisations'));
    }

    public function addorganisationbranch(Request $request)
    { 
       $organisations=Organisation::all();
       if($request->isMethod('post')){
            
        $organisation_name = $request['organisation_name'];

        $organisation_branchname = count($_REQUEST['organisation_branchname']);


        for($i=0; $i < $organisation_branchname; $i++){
            $Organisationbranch = new Organisationbranch();

            $Organisationbranch->organisation_name = $request['organisation_name'];
            $Organisationbranch->organisation_branchname = $request['organisation_branchname'][$i];
            $Organisationbranch->organisation_address = $request['organisation_address'][$i];
            $Organisationbranch->organisation_city = $request['organisation_city'][$i];
            $Organisationbranch->organisation_state = $request['organisation_state'][$i];
            $Organisationbranch->organisation_pin = $request['organisation_pin'][$i];

            $Organisationbranch->save();

            

        }



     return redirect('/organisationbranch')->with('flash_message_success','Organisationbranch Added Successfully!!!');

     }
        
        return view ('organisationbranch.create')->with(compact('organisations'));
    }

    public function editorganisationbranch(Request $request, $id){
        


if($request->isMethod('post')){

     
         // $organisation_branchname= $request->organisation_branchname; 
         // $organisation_address= $request->organisation_address; 
         // $dept_fetch =array(
         //                'organisation_branchname' => $organisation_branchname,
         //                'organisation_address' => $organisation_address
         //                    );
         // $update_Data=DB::table('organisationbranches')
         //              ->where('id',$id)
         //              ->update($dept_fetch); 
            
            $branchid = $request['branch_id'];
            $organisation_branchname = $request['organisation_branchname'];
       
            $values=array(
                'id'=>$branchid,
                'organisation_branchname'=>$request['organisation_branchname']
            );

            //print_r($values);
                       
            Organisationbranch::where('organisation_name',$id)->update($values);

         
           
        
       return redirect('/organisationbranch')->with('flash_message_success','Updated Successfully!!!');
        
    }

         $branchs = DB::table('organisationbranches')
                      ->where('organisation_name', $id)
                      ->get();


                      //print_r($branchs);

         $organisationname =  DB::table('organisations')
                            ->where('id', $id)
                            ->get();            
                                             

       $organisations=Organisation::all();
       $organisations_dropdown = "<option value='' disabled>Select</option>";
        foreach($organisations as $organisation){
          if($organisation->id==$branchs[0]->organisation_name){
            $selected = "selected";
          }else{
            $selected = "";
          }
          
          $organisations_dropdown .= "<option value='".$organisation->id."' ".$selected.">".$organisation->company_name."</option>";
        }

        return view ('organisationbranch.edit')->with(compact('branchs','organisationname','organisations_dropdown'));

    }

}

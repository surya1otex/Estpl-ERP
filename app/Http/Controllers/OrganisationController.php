<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Organisationbranch;
use App\Organisation;
use App\Organisation_location;
use App\Organisation_contact_info;
use Auth;
use URL;
use Session;
use Illuminate\Support\Facades\DB;

class OrganisationController extends Controller
{
    public function index(){

        $organisations = Organisation::all(); 
        return view('organisations.index')->with(compact('organisations'));
    }

    public function addorganisation(Request $request){

         $organisations=Organisation::all();
         $organisation_locations=Organisation_location::all();

          if($request->isMethod('post')){

              $params['company_name'] = $request->company_name;
              $params['company_parent_name'] = $request->company_parent_name;
              $params['office_city'] = $request->office_city;
              $params['office_state'] = $request->office_state;
              $params['office_pin'] = $request->office_pin;

              $params['mailing_address'] = $request->mailing_address;
              $params['mailing_city'] = $request->mailing_city;
              $params['mailing_state'] = $request->mailing_state;
              $params['mailing_pin'] = $request->mailing_pin;
              $params['fax'] = $request->fax; 
              $params['primary_contact_name'] = $request->primary_contact_name;
              $params['primary_contact_email'] = $request->primary_contact_email;
              $params['Primary_contact_phone'] = $request->Primary_contact_phone;
              $params['Primary_contactalt_phone'] = $request->Primary_contactalt_phone;
              $params['Primary_contaddr'] = $request->Primary_contaddr;                                         

              $organisation = Organisation::create($params);

              // $lastInsertedId= $organisation->id;

              //  if($organisation->id != 0) {
                
              //      for($i = 0; $i < count($request->organisation_location_name); $i++) {
                      
              //          $locations['organisation_name'] = $lastInsertedId;
              //          $locations['organisation_location_name'] = $request->organisation_location_name[$i];
              //          $locations['organisation_address'] = $request->organisation_address[$i];
              //          $locations['organisation_city'] = $request->organisation_city[$i];
              //          $locations['organisation_state'] = $request->organisation_state[$i];
              //          $locations['organisation_pin'] = $request->organisation_pin[$i];
                       
              //          Organisation_location::create($locations);

              //      }
                  
              //  }


           return redirect('/organisation')->with('flash_message_success','organisation Added Successfully!!!');
            }

         return view ('organisations.create')->with(compact('organisations','organisation_locations'));
      }


    public function addcontactperson(Request $request){
                
            $organisation = DB::table('organisations')->pluck("company_name","id");

            $organisation_contact_infos=Organisation_contact_info::select('id','organisation_contact_name','organisation_contact_email','organisation_contact_phone','organisation_contact_altphone','organisation_contact_address')
             ->orderBy('id', 'DESC')
             ->get();
             
            if($request->isMethod('post')){

               for($i = 0; $i < count($request->organisation_contact_name); $i++) {
                      
                       $contactinfos['organisation_name'] = $request->organisation_name;
                       $contactinfos['organisation_address'] = $request->organisation_address;
                       $contactinfos['organisation_contact_name'] = $request->organisation_contact_name[$i];
                       $contactinfos['organisation_contact_email'] = $request->organisation_contact_email[$i];
                       $contactinfos['organisation_contact_phone'] = $request->organisation_contact_phone[$i];
                       $contactinfos['organisation_contact_altphone'] = $request->organisation_contact_altphone[$i];
                       $contactinfos['organisation_contact_address'] = $request->organisation_contact_address[$i];
                       
                       Organisation_contact_info::create($contactinfos);
                   }
                  
              return redirect('/organisation')->with('flash_message_success','Organisation Address Added Successfully!!!');
             
             }
            return view('organisations.contactpersoncreate',compact('organisation','organisation_contact_infos'));
    }

    public function editorganisation(Request $request, $id = null){

        $organisations=Organisation::all();
        $updatorganisationDetails = Organisation::where(['id'=>$id])->first();

        $updatorganisationlocationDetails = Organisation_location::where(['organisation_name'=>$id])->get();

        return view ('organisations.edit')->with(compact('organisations','updatorganisationDetails','updatorganisationlocationDetails'));
    }


    public function getaddress($id) 
        {
            $organisation_address = DB::table("organisation_locations")->where("organisation_name",$id)->pluck("organisation_location_name","id");
            return json_encode($organisation_address);
        }

    public function addlocation(Request $request, $id = null){

            $organisations=Organisation::where(['id'=>$id])->first();
            //$organisation_locations=Organisation_location::all();

            $organisation_locations=Organisation_location:: select('id','organisation_location_name','organisation_address','organisation_city','organisation_state','organisation_pin')
            ->where('organisation_name',$request->id)
            ->orderBy('id', 'DESC')
            ->get();

             if($request->isMethod('post')){

               $locations['organisation_name'] = $request->organisation_name;
               $locations['organisation_location_name'] = $request->organisation_location_name;
               $locations['organisation_address'] = $request->organisation_address;
               $locations['organisation_city'] = $request->organisation_city;
               $locations['organisation_state'] = $request->organisation_state;
               $locations['organisation_pin'] = $request->organisation_pin;                                         
               $organisationlocation = Organisation_location::create($locations);

             //return redirect('/organisation')->with('flash_message_success','organisation Added Successfully!!!');
             return redirect()->back()->with('flash_message_success', 'organisation location Added Successfully!!!');
            }

             return view ('organisations.locationadd')->with(compact('organisations','organisation_locations'));
        }


        public function editlocation(Request $request, $id = null){

            if($request->isMethod('post')){
               
            $data = $request->all();

            Organisation_location::where(['id'=>$id])->update([
                  'organisation_location_name'=>$data['organisation_location_name'],
                  'organisation_name'=>$data['organisation_name'],
                  'organisation_address'=>$data['organisation_address'],
                  'organisation_city'=>$data['organisation_city'],
                  'organisation_state'=>$data['organisation_state'],
                  'organisation_pin'=>$data['organisation_pin']
                  ]);

            return redirect()->back()->with('flash_message_success', 'Organisation location Updated Successfully!!!');
             //return redirect('/organisation')->with('flash_message_success','Organisation location Updated Successfully!!!');

            }
             
            // $locations=Organisation_location::all();
            $organisation_locations = Organisation_location::where(['id'=>$id])->first();

            $edit_locations=Organisation_location:: select('id','organisation_location_name','organisation_address','organisation_city','organisation_state','organisation_pin')
            ->where('id',$request->id)->get();

            return view ('organisations.locationedit')->with(compact('organisation_locations','edit_locations'));

        }

 
}

<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\User;
use App\Organisation_location;
use App\Models\Assignment;
use App\Models\AssignmentDetails;
use App\Models\Organisation;
use App\Models\ActionTaken;
use App\Models\AssignmentImage;
use App\Services_task;
use App\Actionlogs;
use App\ActionImages;
use Auth;
use App\Http\Controllers\BaseController;

class AssignmentController extends BaseController
{
    public function index() {
        //$assignments  = Assignment::all();
        $currentuserid = Auth::user()->id;
        $role = Auth::user()->roles->pluck('name')->first();

          //if($role == "Admin") {
              $assignments = Assignment::all();
          //}
         // else {
           //$assignments  = Assignment::where('user_id', $currentuserid)->get();
          //}       
        $this->setPageTitle('Project Orders', 'List of all Project Orders');
        return view('Assignments.index', compact('assignments', 'role'));
    }

    public function create() {
        $clients = Organisation::all();
        //$users = User::all();
        $users = User::role('Support Manager')->get();
        $items = Product::all();
        $this->setPageTitle('Project Orders', 'Create new Project orders');
        return view('Assignments.create', compact('clients', 'users', 'items'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'client_id'    =>  'required|not_in:0',
            'subject'      =>  'required|max:191',
            'district_id'  =>  'required|not_in:0',
            'block_id'     =>  'required|not_in:0'
           ]);

          $params['subject'] = $request->subject;
          $params['district_id'] = $request->district_id;
          $params['block_id'] = $request->block_id;
          $params['organisation_id'] = $request->client_id;

          $params['items'] = $request->item_id;
       

          $assignment = Assignment::create($params);
          
           if(!$assignment) {
            return $this->responseRedirectBack('Error occurred while updating action.', 'error', true, true);
          }
         
          return $this->responseRedirect('assignment.index', 'Assignment created successfully' ,'success',false, false);

    }
    public function edit($id) {
        //echo 'hello test';
          $sld_actions = [];
          $assignment = Assignment::find($id);
          $users = User::role('Support Manager')->get();
          
          $assignments_details = AssignmentDetails::where('assignment_id', $id)->get();
          // $process_asgnmnts = ActionTaken::where('assignment_id', $id)->get();
          $process_asgnmnts = Services_task::where('assignment_id', $id)->get();
 
          foreach($process_asgnmnts as $actions) {
              array_push($sld_actions, $actions->assignmnt_item_id);
          }
          //$msg = 'Client Details';
          // return $client_data;
          $this->setPageTitle('Project Order Details', 'View List of Items For: '.$assignment->subject);
          return view('Assignments.details', compact('assignments_details', 'sld_actions', 'users', 'assignment'));

         //return $assinment;
    }

    public function additems($id) {
      $assignment = Assignment::find($id);
      $items = Product::all();
      $locationid = $assignment->organisation_id;
      $locations = Organisation_location::where('organisation_name', $locationid)->get();
      $this->setPageTitle('Add Items', 'Add items to Project Orders');
      return view('Assignments.additems', compact('items', 'assignment','locations'));

    }

  public function deleteItem($id=0){
    // Call deleteData() method of Page Model
    //Page::deleteData($id);

    AssignmentDetails::where('id',$id)->delete();
    echo "Item Removed";
    exit;
  }
    public function saveitemtoPO(Request $request) {

      $newrow = [];
       $poitems['assignment_id'] = $request->assignmentID;
       $poitems['product_id'] = $request->productID;
       $poitems['serial_number'] = $request->slno;
       $poitems['model'] = $request->model;
       $poitems['organisation_location_id'] = $request->location;
       $poitems['distributor'] = $request->distributor;
       $poitems['war_issued_at'] = $request->warissue;
       $war_exp = $request->warexp;

       $poitems['war_expires_at'] = date('Y-m-d', strtotime('+' . $request->warexp. 'year', strtotime($request->warissue)));
       $poitems['status'] = 1;
       $addpoitems = AssignmentDetails::create($poitems);

       array_push($newrow, ['id' => $addpoitems->id, 'product' => ($addpoitems->product) ? $addpoitems->product->name: 'No Name', 'model' => $addpoitems->model, 'location' =>$addpoitems->Organisation_location->organisation_location_name, 'distributor' => $addpoitems->distributor, 'serial' => $addpoitems->serial_number, 'war_issue' => $addpoitems->war_issued_at, 'war_exp' => $addpoitems->war_expires_at]);
       return response()->json($newrow);

       //echo json_encode($newrow);
    }
    public function services() {
      $assmntsdetails = [];
      $currentuserid = Auth::user()->id;
      $services  = Services_task::where('user_id', $currentuserid)->get();

      $assnmnt_id_frmaction = Services_task::where('user_id', $currentuserid)->first();

      if($assnmnt_id_frmaction) {

        //$usr_asmntID = ActionTaken::where('assignment_id', $assnmnt_id_frmaction->assignment_id)->get();

         $usr_asmntID = ActionTaken::all();
        foreach($usr_asmntID as $asgmnt) {
          array_push($assmntsdetails, $asgmnt->assign_details_id);
        }
      }
      
      //$process_asgnmnts = Services_task::where('user_id', $currentuserid)->get();


      //$assignmentslist = AssignmentDetails::all();
      //$assignmentslist = AssignmentDetails::where('assignment_id', )
 


      $this->setPageTitle('Project Orders', 'Subject: PO');
      return view('Assignments.services', compact('services', 'assmntsdetails'));
    }
    public function takeaction($id) {

        $job_details = Services_task::find($id);
       // $job_details = AssignmentDetails::find($id);
       //$job_details = AssignmentDetails::where('product_id', $id)->first();
        $this->setPageTitle('Update Job Status', 'Job Name: '.$job_details->product->name);
        $this->SetSubTitle($job_details->assignment->subject);

        return view('Assignments.action', compact('job_details'));
    }

    public function editaction($id) {
        //$job_details = AssignmentDetails::find($id);
        //$job_details = AssignmentDetails::where('product_id', $id)->first();

        $job_details = Services_task::find($id);
        $action_details_list = ActionTaken::where('assign_details_id', $id)->first();

        $action_images = ActionImages::where('service_task_id', $id)->get();

        //$actionlogs = Actionlogs::where('assign_details_id', $id)->get();

        $actionlogs = DB::select("SELECT actionlogs.update_status,products.name,actionlogs.assignment_id,actionlogs.comments,actionlogs.image FROM
        actionlogs
        INNER JOIN services_tasks ON actionlogs.assign_details_id = services_tasks.id
        INNER JOIN products ON services_tasks.product_id = products.id WHERE actionlogs.assign_details_id='".$id."'");

        $this->setPageTitle('Update Job Status', 'Job Name: '.$job_details->product->name);
        $this->SetSubTitle($job_details->assignment->subject);

        return view('Assignments.action_details', compact('job_details', 'action_details_list', 'actionlogs', 'action_images'));
    }
    public function updateaction(Request $request) {
        $this->validate($request, [
            'update_status'    =>  'required|not_in:0'
           ]);
          
           $action['update_status'] = $request->update_status;
           $action['assign_details_id'] = $request->action_takenID;
           $action['assignment_id'] = $request->assignment_id;
           $action['comments'] = $request->comments;
           //if($request->update_status == '2') {
            //$action['counts'] = $counts;

              //$assg_details = AssignmentDetails::find($request->action_takenID);

              //$assg_details->status = 0;
              //$assg_details->save();
          // }
           //else {
            //$action['counts'] = $request->counts;
           //}
           
           $action['lat'] = '1477.58';
           $action['long'] = '8874.44';

           $action_status = ActionTaken::create($action);

           print_r($action_status);

           if($action_status->assign_details_id != 0) {
             for($i=0; $i< count($request->file); $i++) {
               $imgfile = $request->file('file')[$i];
               $imageName = $imgfile->getClientOriginalName();
               $imgsel['service_task_id'] = $action_status->assign_details_id;
               $imgsel['image'] = $imageName;
               print_r($imageName);
               $request->file('file')[$i]->storeAs('actionimages', $imageName, 'public');
               ActionImages::create($imgsel);
             }

           }
        //  if($request->hasFile('file')){
        //      $image = $request->file('file');
        //      $imageName = $image->getClientOriginalName();
        //      $action['image'] = $imageName;
        //      $request->file('file')->storeAs('actionimages', $imageName, 'public');
        //    }

          //  $check_assg_status = AssignmentDetails::where('status', '!=', 0)->where('assignment_id', $request->assignment_id )->get();
          //  $chk_row_cnt = $check_assg_status->count();
          //  if($chk_row_cnt == '0') {
          //      $assgnment = Assignment::find($request->assignment_id);
          //      $assgnment->status = 0;
          //      $assgnment->save();
          //  }
          
           //$action_status = ActionTaken::create($action);


           //print_r($imgsel);

           $aclog = Actionlogs::create($action);
           if(!$action_status) {
             //return $this->responseRedirectBack('Error occurred while updating action.', 'error', true, true);
           }
          
           //return $this->responseRedirect('assignment.index', 'action updated successfully' ,'success',false, false);
           
    }

    public function saveaction(Request $request) {
        $this->validate($request, [
            'update_status'    =>  'required|not_in:0'
           ]);

           //$counts = $request->count_t_install;

           $actn_tkn_id =  ActionTaken::find($request->action_takenID);

           //if($request->update_status == '2') {
            //$actn_tkn_id->counts = $counts;

             // $assg_details = AssignmentDetails::find($request->action_takenID);

            //  $assg_details = AssignmentDetails::where('product_id', '=', $request->action_takenID);
            //   $assg_details->comments = $request->comments;
            //   $assg_details->status = 0;
            //   $assg_details->save();
           //}

          //  else {
          //    $actn_tkn_id->counts = $request->counts;
          //  }

         //  if($request->hasFile('file')){
           // $image = $request->file('file');
           // $imageName = $image->getClientOriginalName();
            // Removing field image when update
             //$actn_tkn_id->image = $imageName;
            //end of line
            //$action['image'] = $imageName;
           // $request->file('file')->storeAs('actionimages', $imageName, 'public');
          //}


            $actn_tkn_id->update_status = $request->update_status;
            $actn_tkn_id->comments = $request->comments;

            // Remove existing images
           // $res=ActionImages::where('service_task_id',$request->action_takenID)->delete();
            //edn of remove existing images

            // Action taken images upload section

            for($i=0; $i< count($request->file); $i++) {
              $imgfile = $request->file('file')[$i];
              $imageName = $imgfile->getClientOriginalName();
              $imgsel['service_task_id'] = $request->action_takenID;
              $imgsel['image'] = $imageName;
              print_r($imageName);
              $request->file('file')[$i]->storeAs('actionimages', $imageName, 'public');
              ActionImages::create($imgsel);
            }
       
            // end of Action taken images upload section



            // $check_assg_status = AssignmentDetails::where('status', '!=', 0)->where('assignment_id', $request->assignment_id )->get();

            // $chk_row_cnt = $check_assg_status->count();

            // if($chk_row_cnt == '0') {
            //     $assgnment = Assignment::find($request->assignment_id);
            //     $assgnment->status = 0;
            //     $assgnment->save();
            // }

          $uptac = $actn_tkn_id->save();

          $actionlog['update_status'] = $request->update_status;
          $actionlog['assign_details_id'] = $request->action_takenID;
          $actionlog['assignment_id'] = $request->assignment_id;
          $actionlog['comments'] = $request->comments;
          //if($request->hasFile('file')){
          // $actionlog['image'] = $imageName;
          //}
          $actionlog['lat'] = '120.11';
          $actionlog['long'] = '211.11';
          Actionlogs::create($actionlog);
          //return $chk_row_cnt;
          if(!$uptac) {
            return $this->responseRedirectBack('Error occurred while updating action.', 'error', true, true);
          }
         
          return $this->responseRedirect('assignment.index', 'action updated successfully' ,'success',false, false);
    }

    public function assignto(Request $request) {

         $items = $request->itemids;
         $asn_items = $request->taskids;
         $poid = $request->po_id;
         $engg_code = $request->engg_code;

         for($i=0; $i < count($items); $i++) {
            $taksdtls['product_id'] = $items[$i];
            $taksdtls['assignmnt_item_id'] = $asn_items[$i];
            $taksdtls['assignment_id'] = $poid;
            $taksdtls['user_id'] = $engg_code;
            $taksdtls['status'] = 1;
            
            Services_task::create($taksdtls);
            
         }
        // return count($items);
         return response()->json(['lists' => $items, 'asnitms' => $asn_items]);
    }

    public function getitems(Request $request) {
     
          $assg_id = $request->assignmentID;
          $item_details = AssignmentDetails::where('assignment_id', $assg_id)->get();
          $service_details = Services_task::where('assignment_id', $assg_id)->get();

          $items = [];
          $ser_ids = [];
          foreach($service_details as $service){
           array_push($ser_ids, $service->assignmnt_item_id);
         }
          foreach($item_details as $product) {
            array_push($items, ['id' => $product->id, 'product' => $product->product->name, 'model' => $product->model, 'location' => $product->Organisation_location->organisation_location_name, 'distributor' => ($product->distributor) ? $product->distributor : 'Unknown', 'serial' => $product->serial_number,  'war_issue' => $product->war_issued_at, 'war_exp' => $product->war_expires_at, 'serviceids' => $ser_ids]);
          }
          
           echo json_encode($items);
    }

    public function upload(Request $request)
    {
    $assignment = AssignmentDetails::find($request->actiontaken_id);
    

    if ($request->has('image')) {

       // $image = $this->uploadOne($request->image, 'products');

       $image = $request->file('image');
       $imageName = $image->getClientOriginalName();

        $image = $request->file('image')->storeAs('actionimages', $imageName, 'public');

        $assignmentImage = new AssignmentImage([
            'full'      =>  $image,
        ]);

        $assignment->images()->save($assignmentImage);
    }

    return response()->json(['status' => 'Success']);
}

}
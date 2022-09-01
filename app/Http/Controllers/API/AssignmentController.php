<?php

namespace App\Http\Controllers\API;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentDetails;
use App\Models\ActionTaken;
use App\Services_task;
use App\Actionlogs;
use App\ActionImages;
use Auth;

class AssignmentController extends Controller
{
    public $successStatus = 200;

    public function listassignments() {

        $asg_details = [];
        $currentuserid = Auth::user()->id;
        $server = $_SERVER['HTTP_HOST'].'/storage/';
       // $assignments  = Assignment::where('user_id', $currentuserid)->get();
       $assignments = Services_task::where('user_id', $currentuserid)->get();
         foreach($assignments as $asg) {
             array_push($asg_details, ['id' => $asg->id, 'subject' => $asg->assignment->subject, 'assignment_id' => $asg->assignment_id, 'item' => $asg->product->name, 'image' => $server.$asg->product->image, 'status' => $asg->status]);
         }
        return response()->json([ 'Assignments' => $asg_details, $this->successStatus]);
    }

    // public function assignmentdetails($id) {
    //     $assignment = Assignment::find($id);
    //     $assignments_details = AssignmentDetails::where('assignment_id', $id)->get();
      
    //     $job_details = [];

    //        foreach($assignments_details as $job) {
    //            array_push($job_details, ['id' => $job->id,'product' => $job->product->name, 'Install Count' => $job->counts, 'status' => $job->status] );
    //        }
    //      //return $assignments_details->assignment_id;
    //      //$assignment_collections = [ 'id' => $assignments_details['assignment_id'] ];

    //     return response()->json(['name' => $assignment->subject, 'jobs' => $job_details]);
    // }

    public function checkprocessactions() {
        $currentuserid = Auth::user()->id;
        $sld_actions = [];
        
        $assnmnt_id_frmaction = Services_task::where('user_id', $currentuserid)->first();

        //$process_asgnmnts = ActionTaken::where('assignment_id', $assnmnt_id_frmaction->assignment_id)->get();

        $process_asgnmnts = ActionTaken::all();
 
        foreach($process_asgnmnts as $actions) {
            array_push($sld_actions, $actions->assign_details_id);
        }

        return response()->json(['action_started'  => $sld_actions, $this->successStatus]);
    }

    public function takeaction(Request $request) {
        $this->validate($request, [
            'update_status'    =>  'required|not_in:0'
           ]);

           $action['update_status'] = $request->update_status;
           $action['assign_details_id'] = $request->action_takenID;
           $action['assignment_id'] = $request->assignment_id;
           $action['comments'] = $request->comments;

           //$counts = $request->count_t_install;

        //    if($request->update_status == '2') {
        //     $action['counts'] = $counts;

        //       $assg_details = AssignmentDetails::find($request->action_takenID);

        //       $assg_details->status = 0;
        //       $assg_details->save();
        //    }
        //    else {
        //     $action['counts'] = $request->counts;
        //    }
           
           $action['lat'] = $request->lat;
           $action['long'] = $request->long;

        //    if($request->hasFile('file')){
        //     $image = $request->file('file');
        //     $imageName = $image->getClientOriginalName();
        //     $action['image'] = $imageName;
        //     $request->file('file')->storeAs('actionimages', $imageName, 'public');
        //   }

        //   $check_assg_status = AssignmentDetails::where('status', '!=', 0)->where('assignment_id', $request->assignment_id )->get();
        //   $chk_row_cnt = $check_assg_status->count();
        //   if($chk_row_cnt == '0') {
        //       $assgnment = Assignment::find($request->assignment_id);
        //       $assgnment->status = 0;
        //       $assgnment->save();
        //   }
          $actiontake = ActionTaken::create($action);
          if($request->hasFile('file')){
          if($actiontake->assign_details_id != 0) {
            for($i=0; $i< count($request->file); $i++) {
              $imgfile = $request->file('file')[$i];
              $imageName = $imgfile->getClientOriginalName();
              $imgsel['service_task_id'] = $actiontake->assign_details_id;
              $imgsel['image'] = $imageName;
              print_r($imageName);
              $request->file('file')[$i]->storeAs('actionimages', $imageName, 'public');
              ActionImages::create($imgsel);
            }

            }
          }
          $aclog = Actionlogs::create($action);

          return response()->json(['action_status'  => $actiontake, $this->successStatus]);
    }

    public function getactionDetails($id) {
        $ac_response = [];
        $server = $_SERVER['HTTP_HOST'].'/storage/';
        //$job_details = AssignmentDetails::where('product_id', $id)->first();
        $job_details = Services_task::find($id);
        $action_details_list = ActionTaken::find($id);
        $action_response = ['item' => $job_details->product->name, 'update_status' => $action_details_list->update_status, 'actiontaken_id' => $action_details_list->assign_details_id, 'comments' => $action_details_list->comments, 'image' => $server.$action_details_list->image];

        return response()->json(['actiondetails' => $action_response]);

    }

    public function getactionLogs($id) {
        $logs_res = [];
        $acl_response = DB::select("SELECT actionlogs.update_status,products.name,actionlogs.assignment_id,actionlogs.comments,actionlogs.image FROM
        actionlogs
        INNER JOIN services_tasks ON actionlogs.assign_details_id = services_tasks.id
        INNER JOIN products ON services_tasks.product_id = products.id WHERE actionlogs.assign_details_id='".$id."'");

        foreach($acl_response as $logres) {
            array_push($logs_res, ['item' => $logres->name, 'comments' => $logres->comments, 'update_status' => $logres->update_status, 'image' => $logres->image]);
        }
        return response()->json(['actionlogs' => $logs_res, $this->successStatus]);

    }
    public function updateAction(Request $request) {
        $this->validate($request, [
            'update_status'    =>  'required|not_in:0'
           ]);
           $actn_tkn_id =  ActionTaken::find($request->action_takenID);

           if($request->hasFile('file')){
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $actn_tkn_id->image = $imageName;
            //$action['image'] = $imageName;
            $request->file('file')->storeAs('actionimages', $imageName, 'public');
          }

          $actn_tkn_id->update_status = $request->update_status;
          $actn_tkn_id->comments = $request->comments;

          $uptac = $actn_tkn_id->save();
          $actionlog['update_status'] = $request->update_status;
          $actionlog['assign_details_id'] = $request->action_takenID;
          $actionlog['assignment_id'] = $request->assignment_id;
          $actionlog['comments'] = $request->comments;
          if($request->hasFile('file')){
           $actionlog['image'] = $imageName;
          }
          $actionlog['lat'] = '120.11';
          $actionlog['long'] = '211.11';
          Actionlogs::create($actionlog);

          return response()->json(['action_status'  => $uptac, $this->successStatus]);

    }
}

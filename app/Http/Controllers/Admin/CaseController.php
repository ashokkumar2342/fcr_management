<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use PDF;

class CaseController extends Controller
{
//------------Case Details----------------------------------------------
    public function newCaseIndex(Request $request)
    {
        try 
        {                  
            $users= DB::select(DB::raw("select * from `admins`"));    
            return view('admin.master.caseDetails.index',compact('users'));
        } catch (Exception $e) {}
   }

   public function NewCaseStore(Request $request,$id=null)
   {  
        $rules=[
            'case_no' => 'required', 
            'case_title' => 'required', 
            'case_year' => 'required', 
            'task_details' => 'required', 
            'due_date' => 'required', 
            'case_releted_to' => 'required', 
            'attachment' => 'required', 
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
        }
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $unique_id = uniqid(); 

        
        $vpath='';
        $file_path = "/app/attachment/".$unique_id.".pdf";
        if ($request->hasFile('attachment')) { 
            $dirpath = Storage_path() . '/app/attachment';
            $vpath = '/attachment/'.$unique_id.'.pdf';
            @mkdir($dirpath, 0755, true);
            $file =$request->attachment;
            $attachment = file_get_contents($file); 
            $store= \Storage::put($vpath,$attachment);
        }

        $l_case_id = 0;
        if(!empty($id)) {
            $l_case_id = $id;

        }

        $l_case_no = MyFuncs::removeSpacialChr($request->case_no);
        $l_case_title = MyFuncs::removeSpacialChr($request->case_title);
        $l_case_year = MyFuncs::removeSpacialChr($request->case_year);
        $l_case_detail = MyFuncs::removeSpacialChr($request->task_details);
        $l_due_date = $request->due_date;
        $l_related_to = $request->case_releted_to;
        
        $rs_save = DB::select(DB::raw("call `up_save_case_details`($l_case_id, $user_id, '$l_case_title', '$l_case_no', '$l_case_year', '$l_case_detail', '$file_path', '$l_due_date', $l_related_to, '$unique_id');"));

        $response=['status'=>$rs_save[0]->s_status,'msg'=>$rs_save[0]->result];
        return response()->json($response);
       
         
      
    }

//     //------------task-Remarks------------------task-Remarks----------------------------

    public function outbox($click_id=null)
    {           
        return view('admin.master.outbox.index' , compact('click_id'));
    }
    
    // public function outboxfilter($rs_condition)
    // {   
    //     $status_condition = '';
    //     if($rs_condition !=3){
    //         $status_condition = " and `tk`.`status` = $rs_condition ";   
    //     }

    //     $admin=Auth::guard('admin')->user();
    //     $rs_outbox= DB::select(DB::raw("select * from `case_details`"));      
    //     return view('admin.master.outbox.table' , compact('rs_outbox'));
    // }

    public function outboxfilter($rs_condition)
    {   
        $status_condition = '';
        if($rs_condition !=2){
            $status_condition = " and `cd`.`status` = $rs_condition ";   
        }
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $rs_outbox= DB::select(DB::raw("select `cd`.`id`, date_format(`cd`.`create_date`,'%d %b %Y') as `date_create`, `cd`.`title`, `cd`.`case_no`, `cd`.`case_year`, `cd`.`case_details`, `cd`.`attachment`, date_format(`cd`.`due_date`,'%d %b %Y') as `date_due`, `cd`.`status`, case `cd`.`status` when 0 then 'Pending' When 1 then 'Completed' Else '' end as `case_status`, `usr`.`first_name`, `clh`.`remarks` from `case_details` `cd` inner join `admins` `usr` on `usr`.`id` = `cd`.`case_related_to` inner join `case_latest_history` `clh` on `clh`.`case_id` = `cd`.`id` where `cd`.`created_by` = $user_id $status_condition order by `cd`.`id`;"));
        return view('admin.master.outbox.table' , compact('rs_outbox'));
    }


    public function caseRemarks($rs_id)
    {   
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $rs_Remarks= DB::select(DB::raw("select `crh`.`id`, date_format(`crh`.`entry_date_time`,'%d %b %Y %H:%i') as `remark_date_time`, `crh`.`entry_by`, `crh`.`remarks`, `crh`.`attachment` from `case_remarks_history` `crh` where `crh`.`case_id` = $rs_id order by `crh`.`id` desc;"));
        return view('admin.master.caseDetails.remarks' , compact('rs_Remarks' , 'rs_id', 'user_id'));
    }

    public function caseRemarksAdd($rs_id)
    {
        return view('admin.master.caseDetails.add_remarks' , compact('rs_id'));
    }

    public function caseRemarksStore(Request $request, $rs_id)
    {
        $rules=[
            'remarks' => 'required',
            'attachment' => 'required', 
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
        }
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $unique_id = uniqid();
        $l_case_id = $rs_id;
        $remarks = MyFuncs::removeSpacialChr($request->remarks);

        
        $vpath='';
        $file_path = "/app/attachment/".$unique_id.".pdf";
        if ($request->hasFile('attachment')) { 
            $dirpath = Storage_path() . '/app/attachment';
            $vpath = '/attachment/'.$unique_id.'.pdf';
            @mkdir($dirpath, 0755, true);
            $file =$request->attachment;
            $attachment = file_get_contents($file); 
            $store= \Storage::put($vpath,$attachment);
        }

       
        
        $rs_save = DB::select(DB::raw("call `up_save_new_remarks`($l_case_id, $user_id, '$remarks', '$file_path');"));

        $response=['status'=>$rs_save[0]->s_status,'msg'=>$rs_save[0]->result];
        return response()->json($response);
    }
//     public function outboxremarksstore(Request $request,$rs_id)
//     {   
//         $rules=[
//             'remarks' => 'required', 
//         ]; 
//         $validator = Validator::make($request->all(),$rules);
//         if ($validator->fails()) {
//           $errors = $validator->errors()->all();
//           $response=array();
//           $response["status"]=0;
//           $response["msg"]=$errors[0];
//           return response()->json($response);// response as json
//         }
//         $vpath='';
//         if ($request->hasFile('attachment')) { 
//             $dirpath = Storage_path() . '/app/attachment';
//             $vpath = '/attachment/'.date('dmY').'.pdf';
//             @mkdir($dirpath, 0755, true);
//             $file =$request->attachment;
//             $attachment = file_get_contents($file); 
//             $store= \Storage::put($vpath,$attachment);
//         }
//         $admin=Auth::guard('admin')->user();
//         $departments= DB::select(DB::raw("call `up_save_task_remarks`($admin->id , $rs_id , '$request->remarks' , '$vpath')"));
//         $response=['status'=>1,'msg'=>'Submit Successfully'];
//         return response()->json($response);
//     }
    public function caseAttachment($id)
    {   
        $tasksatch= DB::select(DB::raw("select * from `case_details` where `id` = $id limit 1;"));
        $file_path=Storage_path().$tasksatch[0]->attachment;
        return response()->file($file_path);
    }
    
    public function remaksattachment($id)
    {   
        $tasksatch= DB::select(DB::raw("select * from `case_remarks_history` where `id` = $id limit 1;"));
        $file_path=Storage_path().$tasksatch[0]->attachment;
        return response()->file($file_path);
    }
    
    public function markcomplete($rs_id)
    {
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $l_case_id = $rs_id;
        $rs_save = DB::select(DB::raw("call `up_mark_complete_case`($l_case_id, $user_id);"));

        $response=['status'=>$rs_save[0]->s_status,'msg'=>$rs_save[0]->result];
        return response()->json($response);
    }
//     //------------change-Task-Status------------------change-Task-Status----------------------------

    public function inbox($click_id=null)
    {   
        
        return view('admin.master.inbox.index' , compact('click_id'));
    }

    public function inboxfilter($rs_condition)
    {   
        $status_condition = '';
        if($rs_condition !=2){
            $status_condition = " and `cd`.`status` = $rs_condition ";   
        }
        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $rs_inbox= DB::select(DB::raw("select `cd`.`id`, date_format(`cd`.`create_date`,'%d %b %Y') as `date_create`, `cd`.`title`, `cd`.`case_no`, `cd`.`case_year`, `cd`.`case_details`, `cd`.`attachment`, date_format(`cd`.`due_date`,'%d %b %Y') as `date_due`, `cd`.`status`, case `cd`.`status` when 0 then 'Pending' When 1 then 'Completed' Else '' end as `case_status`, `usr`.`first_name`, `clh`.`remarks` from `case_details` `cd` inner join `admins` `usr` on `usr`.`id` = `cd`.`created_by` inner join `case_latest_history` `clh` on `clh`.`case_id` = `cd`.`id` where `cd`.`case_related_to` = $user_id $status_condition order by `cd`.`id`;"));
        return view('admin.master.inbox.table' , compact('rs_inbox'));
    }

    public function notification($bv_condition=0)
    {   
        $status_condition = '';
        if($bv_condition !=2){
            $status_condition = " and `nfs`.`status` = $bv_condition ";   
        }

        $admin = Auth::guard('admin')->user();
        $user_id = $admin->id;
        $role_id = $admin->role_id;
        
        if($role_id == 5){
            $rs_notification = DB::select(DB::raw("select `nfs`.`id`, date_format(`nfs`.`entry_date_time`, '%d %b %Y %H:%i') as `remark_date_time`, `nfs`.`remarks`, `nfs`.`attachment`, `nfs`.`case_id`, `usr`.`first_name`, `cd`.`case_no`, `cd`.`title`, `nfs`.`status` from `notifications` `nfs` inner join `case_details` `cd` on `cd`.`id` = `nfs`.`case_id` inner join `admins` `usr` on `usr`.`id` = `cd`.`created_by` where `nfs`.`notification_for` = $user_id $status_condition order by `nfs`.`id`;"));
        }else{
            $rs_notification = DB::select(DB::raw("select `nfs`.`id`, date_format(`nfs`.`entry_date_time`, '%d %b %Y %H:%i') as `remark_date_time`, `nfs`.`remarks`, `nfs`.`attachment`, `nfs`.`case_id`, `usr`.`first_name`, `cd`.`case_no`, `cd`.`title`, `nfs`.`status` from `notifications` `nfs` inner join `case_details` `cd` on `cd`.`id` = `nfs`.`case_id` inner join `admins` `usr` on `usr`.`id` = `cd`.`case_related_to` where `nfs`.`notification_for` = $user_id $status_condition order by `nfs`.`id`;"));
        }
        return view('admin.master.notification.notification' , compact('rs_notification', 'role_id'));
    }

//     public function inboxstatus($rs_id)
//     {   
//         $admin=Auth::guard('admin')->user();
//         $rs_update= DB::select(DB::raw("call `up_change_task_status`($admin->id , $rs_id , 1);"));
//         // $rs_update= DB::select(DB::raw("update `tasks` set `status` = 1 where `id` =$rs_id limit 1 ;"));
//         $response=['status'=>1,'msg'=>'Mark Complete Successfully'];
//         return response()->json($response); 
//     }

}

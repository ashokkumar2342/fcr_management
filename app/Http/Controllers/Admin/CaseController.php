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
    
//     public function outboxfilter($rs_condition)
//     {   
//         $status_condition = '';
//         if($rs_condition !=3){
//             $status_condition = " and `tk`.`status` = $rs_condition ";   
//         }

//         $admin=Auth::guard('admin')->user();
//         $rs_outbox= DB::select(DB::raw("select * from `case_details`"));      
//         return view('admin.master.outbox.table' , compact('rs_outbox'));
//     }
//     public function outboxremarks($rs_id)
//     {   
//         $tasksRemarks= DB::select(DB::raw("select `tr`.`id` , `tr`.`remarks_date`, `tr`.`remarks`, `tr`.`attachment`, `off`.`officer_name`, `off`.`designation` from `task_remarks` `tr` inner join `officers` `off` on `off`.`id` = `tr`.`officer_id` where `tr`.`task_id` = $rs_id order by `tr`.`id` desc;"));
//         return view('admin.master.outbox.remarks' , compact('tasksRemarks' , 'rs_id'));
//     }
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
//     public function outboxattachment($id)
//     {   
//         $tasksatch= DB::select(DB::raw("select * from `tasks` where `id` =$id;"));
//         $file_path=Storage_path().'/app'.$tasksatch[0]->attachment;
//         return response()->file($file_path);
//     }
//     public function remaksattachment($id)
//     {   
//         $tasksatch= DB::select(DB::raw("select * from `task_remarks` where `id` =$id;"));
//         $file_path=Storage_path().'/app'.$tasksatch[0]->attachment;
//         return response()->file($file_path);
//     }
    
//     public function markcomplete($rs_id)
//     {
//         $rs_update= DB::select(DB::raw("update `tasks` set `status` = 2 where `id` =$rs_id limit 1 ;"));
//         $rs_update= DB::select(DB::raw("update `task_assigned` set `status` = 2 where `task_id` =$rs_id ;"));
//         $response=['status'=>1,'msg'=>'Mark Complete Successfully'];
//         return response()->json($response); 
//     }
//     //------------change-Task-Status------------------change-Task-Status----------------------------

//     public function inbox($click_id=null)
//     {   
        
//         return view('admin.master.inbox.index' , compact('click_id'));
//     }
//     public function inboxfilter($rs_condition)
//     {   
//         $status_condition = '';
//         if($rs_condition !=3){
//             $status_condition = " and `tk`.`status` = $rs_condition ";   
//         }
//         $admin=Auth::guard('admin')->user();
//         $rs_inbox= DB::select(DB::raw("select `tk`.`id`, `cat`.`category_name`, `tk`.`task_details`, `tk`.`create_date`, `tk`.`due_date`, `tk`.`attachment`, `tk`.`status`, `ts`.`name` as `status_type`, 
//             CASE  when `tk`.`status` < 2 then datediff(`tk`.`due_date`, now()) else 0 end as `days_left`,
//             `uf_task_departments`(`tk`.`id`) as `departments`, `uf_task_officers`(`tk`.`id`) as `task_officers`, `uf_latest_remarks`(`tk`.`id`) as `latest_remarks`
//             from `task_assigned` `ta`
//             inner join `tasks` `tk` on `tk`.`id` = `ta`.`task_id`
//             inner join `categorys` `cat` on `cat`.`id` = `tk`.`category_id` 
//             inner join `task_status` `ts` on `ts`.`id` = `tk`.`status`
//             where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id)  $status_condition 
//             order by `cat`.`category_name`, `tk`.`task_details`;"));
//         return view('admin.master.inbox.table' , compact('rs_inbox'));
//     }
//     public function inboxstatus($rs_id)
//     {   
//         $admin=Auth::guard('admin')->user();
//         $rs_update= DB::select(DB::raw("call `up_change_task_status`($admin->id , $rs_id , 1);"));
//         // $rs_update= DB::select(DB::raw("update `tasks` set `status` = 1 where `id` =$rs_id limit 1 ;"));
//         $response=['status'=>1,'msg'=>'Mark Complete Successfully'];
//         return response()->json($response); 
//     }

}

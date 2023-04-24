<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\BlocksMc;
use App\Model\GramPanchayat;

use App\Model\District;
use App\Model\Gender;
use App\Model\State;
use App\Model\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use PDF;

class MasterController extends Controller
{
   public function index()
   { 
     try {
          $departments= DB::select(DB::raw("select * from `department`;"));   
          return view('admin.master.department.index',compact('departments'));
        } catch (Exception $e) {
            
        }
     
   }
   public function departmentStore(Request $request,$id=null)
   {  
        $rules=[
            'department_name' => 'required|unique:department,department_name,'.$id, 
            'officer_name' => 'required',  
            'mobile_no' => 'required',  
            'email_id' => 'required',  
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
        }
        $department_name=MyFuncs::removeSpacialChr($request->department_name);
        $officer_name=MyFuncs::removeSpacialChr($request->officer_name);
        $mobile_no=MyFuncs::removeSpacialChr($request->mobile_no);
        $email_id=MyFuncs::removeSpacialChr($request->email_id);
        $designation=MyFuncs::removeSpacialChr($request->designation);
        $password_rs=random_int(100000, 999999);
        $password=bcrypt($password_rs);
        $id=0;
        if (!empty($id)) {
           $id=$id;  
        } 
        $officers= DB::select(DB::raw("call `up_save_new_department`('$department_name' , '$officer_name' , '$designation' , '$mobile_no' , '$email_id' , '$password')"));
        if ($officers[0]->save_status > 0){
            if ($id==0) {
                $data["email"] = $email_id;
                $data["user_name"] = $officer_name.'('.$designation.')';
                $data["password"] = $password_rs;
                $data["subject"] = "Account Created on DMSJhajjar.in";
                $data["from"] = "info@dmsjhajjar.in";
                \Mail::send('emails.send_password', $data, function($message)use($data) {
                $message->to($data['email'])->from( $data['from'], 'Account Created on DMSJhajjar.in' )->subject($data["subject"]); 
                });
                    
            }
        }
        $response=['status'=>$officers[0]->save_status,'msg'=>$officers[0]->save_remarks];
        return response()->json($response);
      
    }
    public function departmentEdit($id)
     { 
       try {  
            $department= DB::select(DB::raw("select * from `department` where `id` = $id;")); 
            return view('admin.master.department.edit',compact('department'));
        } catch (Exception $e) {
              
        }
       
     }

    public function departmentDelete($id)
    {
        try { 
            $id=(Crypt::decrypt($id));  
            $department= DB::select(DB::raw("delete from `department` where `id` = $id;"));
            return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
        } catch (Exception $e) {
              
        }  
    }


    public function districts(Request $request)
    {
        try {             
            $States=DB::select(DB::raw("select * from `states` Order by `name_e`"));  
            return view('admin.master.districts.index',compact('States'));
        } catch (Exception $e) {
            
        }
    }
    public function districtsStore(Request $request,$id=null)
    {  
       $rules=[
            'states' => 'required', 
            'code' => 'required|unique:districts,code,'.$id, 
            'name_english' => 'required', 
            'name_local_language' => 'required', 
            // 'syllabus' => 'required', 
      ];

      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
      }
      else {
        if (!empty($id)) {
        $rs_district = DB::select(DB::raw("update `districts` set `state_id` ='$request->states' , `code` ='$request->code' , `name_e` = '$request->name_english' , `name_l` ='$request->name_local_language' where `id` =$id")); 
        }
        elseif (empty($id)) { 
        $rs_district = DB::select(DB::raw("insert into `districts` (`state_id` , `code` , `name_e` , `name_l`) values ('$request->states' , '$request->code' , '$request->name_english' , '$request->name_local_language')")); 
        }
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }

    public function DistrictsTable(Request $request)
    {
        $Districts=DB::select(DB::raw("select * from `districts` where `state_id` =$request->id"));
        return view('admin.master.districts.district_table',compact('Districts'));
    }
    
    public function districtsEdit($id)
    {
       try {
          $Districts=DB::select(DB::raw("select * from `districts`  where `id` =$id"));
          $States=DB::select(DB::raw("select * from `states` Order by `name_e`"));   
          return view('admin.master.districts.edit',compact('Districts','States'));
        } catch (Exception $e) {
            
        }
    } 
    public function districtsDelete($id)
    {
       $id=Crypt::decrypt($id);  
       $District=DB::select(DB::raw("delete from `districts` where `id` =$id"));
       return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);  
    }
//-------category--------------category--------------category---------------category----//


    public function category(Request $request)
   {
      try {             
             
          $categorys= DB::select(DB::raw("select * from `categorys`;"));    
          return view('admin.master.category.index',compact('categorys'));
        } catch (Exception $e) {
            
        }
   }

   public function categoryStore(Request $request,$id=null)
   {  
        $rules=[
            'category_name' => 'required', 
            
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
        }
        if (empty($id)) {
            $departments= DB::select(DB::raw("insert into `categorys` (`category_name`) values ('$request->category_name')"));
            $response=['status'=>1,'msg'=>'Submit Successfully'];
            return response()->json($response);
        }
        if (!empty($id)) {
            $departments= DB::select(DB::raw("update `categorys` set `category_name` ='$request->category_name' where `id` = $id"));
            $response=['status'=>1,'msg'=>'Update Successfully'];
            return response()->json($response);
        } 
      
    }
    public function categoryEdit($id)
    {
       try {
          $categorys= DB::select(DB::raw("select * from `categorys` where `id` = '$id';")); 
          return view('admin.master.category.edit',compact('categorys'));
        } catch (Exception $e) {
            
        }
    }
    public function categoryDelete($id)
    {
       try { 
            $id=(Crypt::decrypt($id));  
            $categorys= DB::select(DB::raw("delete from `categorys` where `id` = $id;"));
            return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
        } catch (Exception $e) {
              
        }  
    }

//------------task------------------task----------------------------
    public function task(Request $request)
   {
      try {             
             
          $categorys= DB::select(DB::raw("select * from `categorys`;"));    
          $users= DB::select(DB::raw("select * from `admins`"));    
          return view('admin.master.tasks.index',compact('categorys','users'));
        } catch (Exception $e) {
            
        }
   }

   public function taskStore(Request $request,$id=null)
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
        $admin=Auth::guard('admin')->user();
        $user_id = $admin->id;
        $vpath='';
        if ($request->hasFile('attachment')) { 
            $dirpath = Storage_path() . '/app/attachment';
            $vpath = '/attachment/'.date('dmY').'.pdf';
            @mkdir($dirpath, 0755, true);
            $file =$request->attachment;
            $attachment = file_get_contents($file); 
            $store= \Storage::put($vpath,$attachment);
        }
        $unique_id = uniqid(); 
        $create_date = date('Y-m-d'); 
        $rs_insert = DB::select(DB::raw("insert into `case_details` (`unique_id` ,`create_date` , `created_by` , `title` , `case_no` , `case_year`,`task_details`,`attachment`, `due_date`, `case_related_to`,`status`) values ('$unique_id','$create_date' ,'$user_id','$request->title','$request->case_no','$request->case_year','$request->task_details','$vpath','$request->due_date' ,'$request->case_releted_to', '0')"));


        $rs_newid = DB::select(DB::raw("select `id` from `case_details` where `unique_id` = '$unique_id' limit 1;"));
        $newid = $rs_newid[0]->id;  

        // $taskAssingns= DB::select(DB::raw("insert into `case_latest_history` (`entry_date`, `entry_date_time`, `entry_by`,`case_id`, `remarks`, `attachment`, `status`) values ('$create_date',now() ,'$user_id','$newid','$rs_newid[0]->task_details','$vpath', '0')"));

        

        $response=['status'=>1,'msg'=>'Submit Successfully'];
        return response()->json($response);
       
         
      
    }

    //------------task-Remarks------------------task-Remarks----------------------------

    public function outbox($click_id=null)
    {   
        
        return view('admin.master.outbox.index' , compact('click_id'));
    }
    public function outboxfilter($rs_condition)
    {   
        $status_condition = '';
        if($rs_condition !=3){
            $status_condition = " and `tk`.`status` = $rs_condition ";   
        }

        $admin=Auth::guard('admin')->user();
        $rs_outbox= DB::select(DB::raw("select * from `case_details`"));      
        return view('admin.master.outbox.table' , compact('rs_outbox'));
    }
    public function outboxremarks($rs_id)
    {   
        $tasksRemarks= DB::select(DB::raw("select `tr`.`id` , `tr`.`remarks_date`, `tr`.`remarks`, `tr`.`attachment`, `off`.`officer_name`, `off`.`designation` from `task_remarks` `tr` inner join `officers` `off` on `off`.`id` = `tr`.`officer_id` where `tr`.`task_id` = $rs_id order by `tr`.`id` desc;"));
        return view('admin.master.outbox.remarks' , compact('tasksRemarks' , 'rs_id'));
    }
    public function outboxremarksstore(Request $request,$rs_id)
    {   
        $rules=[
            'remarks' => 'required', 
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
        }
        $vpath='';
        if ($request->hasFile('attachment')) { 
            $dirpath = Storage_path() . '/app/attachment';
            $vpath = '/attachment/'.date('dmY').'.pdf';
            @mkdir($dirpath, 0755, true);
            $file =$request->attachment;
            $attachment = file_get_contents($file); 
            $store= \Storage::put($vpath,$attachment);
        }
        $admin=Auth::guard('admin')->user();
        $departments= DB::select(DB::raw("call `up_save_task_remarks`($admin->id , $rs_id , '$request->remarks' , '$vpath')"));
        $response=['status'=>1,'msg'=>'Submit Successfully'];
        return response()->json($response);
    }
    public function outboxattachment($id)
    {   
        $tasksatch= DB::select(DB::raw("select * from `tasks` where `id` =$id;"));
        $file_path=Storage_path().'/app'.$tasksatch[0]->attachment;
        return response()->file($file_path);
    }
    public function remaksattachment($id)
    {   
        $tasksatch= DB::select(DB::raw("select * from `task_remarks` where `id` =$id;"));
        $file_path=Storage_path().'/app'.$tasksatch[0]->attachment;
        return response()->file($file_path);
    }
    
    public function markcomplete($rs_id)
    {
        $rs_update= DB::select(DB::raw("update `tasks` set `status` = 2 where `id` =$rs_id limit 1 ;"));
        $rs_update= DB::select(DB::raw("update `task_assigned` set `status` = 2 where `task_id` =$rs_id ;"));
        $response=['status'=>1,'msg'=>'Mark Complete Successfully'];
        return response()->json($response); 
    }
    //------------change-Task-Status------------------change-Task-Status----------------------------

    public function inbox($click_id=null)
    {   
        
        return view('admin.master.inbox.index' , compact('click_id'));
    }
    public function inboxfilter($rs_condition)
    {   
        $status_condition = '';
        if($rs_condition !=3){
            $status_condition = " and `tk`.`status` = $rs_condition ";   
        }
        $admin=Auth::guard('admin')->user();
        $rs_inbox= DB::select(DB::raw("select `tk`.`id`, `cat`.`category_name`, `tk`.`task_details`, `tk`.`create_date`, `tk`.`due_date`, `tk`.`attachment`, `tk`.`status`, `ts`.`name` as `status_type`, 
            CASE  when `tk`.`status` < 2 then datediff(`tk`.`due_date`, now()) else 0 end as `days_left`,
            `uf_task_departments`(`tk`.`id`) as `departments`, `uf_task_officers`(`tk`.`id`) as `task_officers`, `uf_latest_remarks`(`tk`.`id`) as `latest_remarks`
            from `task_assigned` `ta`
            inner join `tasks` `tk` on `tk`.`id` = `ta`.`task_id`
            inner join `categorys` `cat` on `cat`.`id` = `tk`.`category_id` 
            inner join `task_status` `ts` on `ts`.`id` = `tk`.`status`
            where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id)  $status_condition 
            order by `cat`.`category_name`, `tk`.`task_details`;"));
        return view('admin.master.inbox.table' , compact('rs_inbox'));
    }
    public function inboxstatus($rs_id)
    {   
        $admin=Auth::guard('admin')->user();
        $rs_update= DB::select(DB::raw("call `up_change_task_status`($admin->id , $rs_id , 1);"));
        // $rs_update= DB::select(DB::raw("update `tasks` set `status` = 1 where `id` =$rs_id limit 1 ;"));
        $response=['status'=>1,'msg'=>'Mark Complete Successfully'];
        return response()->json($response); 
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\createToken;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    
    public function index()
    {   
        $admin = Auth::guard('admin')->user();
        $role_id = $admin->role_id;

        $box_caption = "";

        if($role_id == 2){
            $rs_total = DB::select(DB::raw("select count(*) as `ttask` from `case_details` where `created_by` =$admin->id;"));

            $rs_pending = DB::select(DB::raw("select count(*) as `ttask` from `case_details` where `created_by` =$admin->id and `status` = 0;"));
            
            $rs_completed = DB::select(DB::raw("select count(*) as `ttask` from `case_details` where `created_by` =$admin->id and `status` = 1;"));

            $box_caption = "Outbox";
        }else{
            $rs_total = DB::select(DB::raw("select count(*) as `ttask` from `case_details` where `case_related_to` =$admin->id;"));

            $rs_pending = DB::select(DB::raw("select count(*) as `ttask` from `case_details` where `case_related_to` =$admin->id and `status` = 0;"));
            
            $rs_completed = DB::select(DB::raw("select count(*) as `ttask` from `case_details` where `case_related_to` =$admin->id and `status` = 1;"));
            $box_caption = "Inbox";
        }
            

        // $inboxTotal =DB::select(DB::raw("select count(*) as `ttask` from `case_details` `ta` where `ta`.`case_related_to` = $admin->id;"));
        // $inboxacknowledgedPending =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id) and `status` = 0;"));
        // $inboxInProgress =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id) and `status` = 1;"));
        // $inboxCompleted =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id) and `status` = 2;"));
        // return view('admin.dashboard.dashboard' , compact('outboxTotal' , 'outacknowledgedPending' ,'outInProgress' , 'outCompleted' , 'inboxTotal' , 'inboxacknowledgedPending' , 'inboxInProgress' ,'inboxCompleted')); 
        return view('admin.dashboard.dashboard' , compact('rs_total' , 'rs_pending' ,'rs_completed', 'box_caption', 'role_id')); 
    }
    
    public function outboxredirect($click_id)
    {
        return redirect()->route('admin.Case.outbox',$click_id);
    }
    public function inboxredirect($click_id)
    {
        return redirect()->route('admin.Master.inbox',$click_id);
    }  
}

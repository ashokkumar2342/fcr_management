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
        $admin=Auth::guard('admin')->user();
        $outboxTotal =DB::select(DB::raw("select count(*) as `ttask` from `tasks` where `created_by` =$admin->id;"));

        $outacknowledgedPending =DB::select(DB::raw("select count(*) as `ttask` from `tasks` where `created_by` =$admin->id and `status` = 0;"));

        $outInProgress =DB::select(DB::raw("select count(*) as `ttask` from `tasks` where `created_by` =$admin->id and `status` = 1;"));
        
        $outCompleted =DB::select(DB::raw("select count(*) as `ttask` from `tasks` where `created_by` =$admin->id and `status` = 2;"));

        // $inboxTotal =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id);"));
        // $inboxacknowledgedPending =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id) and `status` = 0;"));
        // $inboxInProgress =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id) and `status` = 1;"));
        // $inboxCompleted =DB::select(DB::raw("select count(*) as `ttask` from `task_assigned` `ta` where `ta`.`officer_id` in (select `officer_id` from `officer_assigns` where `user_id` = $admin->id) and `status` = 2;"));
        return view('admin.dashboard.dashboard' , compact('outboxTotal' , 'outacknowledgedPending' ,'outInProgress' , 'outCompleted' , 'inboxTotal' , 'inboxacknowledgedPending' , 'inboxInProgress' ,'inboxCompleted')); 
    }
    public function outboxredirect($click_id)
    {
        return redirect()->route('admin.Master.outbox',$click_id);
    }
    public function inboxredirect($click_id)
    {
        return redirect()->route('admin.Master.inbox',$click_id);
    }  
}

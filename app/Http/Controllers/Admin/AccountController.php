<?php

namespace App\Http\Controllers\Admin;

use App\Admin; 
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class AccountController extends Controller
{
    Public function index(){
     
    	return view('admin.account.index');
    }
    Public function list(){
    $admin=Auth::guard('admin')->user();    
    $accounts = DB::select(DB::raw("select `a`.`id`, `a`.`first_name`, `a`.`last_name`, `a`.`email`, `a`.`mobile`, `a`.`status`, `r`.`name`
             from `admins` `a`Inner Join `roles` `r` on `a`.`role_id` = `r`.`id`where`a`.`status` = 1 and `a`.`role_id` >= (Select `role_id` from `admins` where `id` = $admin->id)Order By `a`.`first_name`;")); 
        return view('admin.account.list',compact('accounts'));
    }

    Public function form(Request $request){
        $admin=Auth::guard('admin')->user();       
    	$roles =DB::select(DB::raw("select `id`, `name` from `roles` where `id`  >= (Select `role_id` from `admins` where `id` =$admin->id) Order By `name`;"));
    	return view('admin.account.form',compact('roles'));
    }
   

    Public function store(Request $request){ 
        $rules=[
        'first_name' => 'required|string|min:3|max:50',             
        'email' => 'required|email|unique:admins',
        "mobile" => 'required|unique:admins|numeric|digits:10',
        "role_id" => 'required',
        "password" => 'required|min:6|max:15', 
        
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $password=bcrypt($request['password']);
        $accounts = DB::select(DB::raw("insert into `admins` (`first_name` , `last_name` , `role_id` , `email` , `password` , `mobile` , `password_plain` , `status`) values ('$request->first_name' , '$request->last_name' , '$request->role_id' , '$request->email' , '$password' , '$request->mobile' , '$request->password' , '1')")); 
        $response=['status'=>1,'msg'=>'Account Created Successfully'];
        return response()->json($response);   
    }

    

    Public function edit(Request $request,$account_id){
        $account_id=Crypt::decrypt($account_id);
        $admin=Auth::guard('admin')->user();       
        $roles =DB::select(DB::raw("select `id`, `name` from `roles` where `id`  >= (Select `role_id` from `admins` where `id` =$admin->id) Order By `name`;"));
        $accounts = DB::select(DB::raw("select * from `admins` where `id` =$account_id")); 
        return view('admin.account.edit',compact('accounts','roles')); 
    }

    Public function update(Request $request,$account_id){
      $rules=[
         
        'first_name' => 'required|string|min:3|max:50',
        'email' => 'required|unique:admins,email,'.$account_id,  
        'mobile' => 'required|unique:admins,mobile,'.$account_id,
        "role_id" => 'required',
        "password" => 'nullable|min:6|max:15', 
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
       
        $account = Admin::find($account_id);
        $account->first_name = $request->first_name;
        $account->last_name = $request->last_name;
        $account->email = $request->email;
        $account->mobile = $request->mobile;
        $account->role_id = $request->role_id; 
        if ($request['password']!=null) {
            $account->password = bcrypt($request['password']);
        } 
        $account->save();
         
        $response=['status'=>1,'msg'=>'Account Update Successfully'];
        return response()->json($response);
       
    }

    
    Public function DistrictsAssign(){
        $admin=Auth::guard('admin')->user(); 
        $users=DB::select(DB::raw("select `id`, `first_name`, `last_name`, `email`, `mobile` from `admins` where `status` = 1 and `id` <> 1 Order By `first_name`")); 
        return view('admin.account.assign.district.index',compact('users'));
       
    }

    Public function StateDistrictsSelect(Request $request){  
        $Districts = DB::select(DB::raw("select * from `districts`;"));   
        
        $DistrictBlockAssigns = DB::select(DB::raw("select `uda`.`id`, `dis`.`name_e` from `user_district_assigns` `uda` inner join `districts` `dis` on `dis`.`id` = `uda`.`district_id` where `uda`.`status` = 1 and `uda`.`user_id` = $request->id;"));
        
        $data= view('admin.account.assign.district.select_box',compact('DistrictBlockAssigns','Districts'))->render(); 
        return response($data);
    }

    public function DistrictsAssignDelete($id)
    {
        try {
            $assigned_id = Crypt::decrypt($id);
            $rs_delete = DB::select(DB::raw("delete from `user_district_assigns` where `id` = $assigned_id;"));
            $response['msg'] = 'District Removed Successfully';
            $response['status'] = 1;
            return response()->json($response);   
        } catch (Exception $e) {}
    }

    Public function DistrictsAssignStore(Request $request){    
        $rules=[
            'district' => 'required', 
            'user' => 'required',  
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $rs_save = DB::select(DB::raw("call `up_save_assign_district` ($request->user, $request->district);"));  
        $response['msg'] = 'District Assigned Successfully';
        $response['status'] = 1;
        return response()->json($response);  
    }

    //-----------DepartmentAssign----------------------------------//

    Public function DepartmentAssign(){
        $admin=Auth::guard('admin')->user(); 
        $users=DB::select(DB::raw("select `id`, `first_name`, `last_name`, `email`, `mobile` from `admins` where `status` = 1 and `id` <> 1 Order By `first_name`"));
        $departments=DB::select(DB::raw("select * from `department` Order By `id`"));

        return view('admin.account.assign.department.index',compact('users' , 'departments'));
       
    }
    
    Public function DepartmentAssignStore(Request $request){     
        $rules=[ 
         'user_id' => 'required',  
         'department_id' => 'required',  
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        } 
        $rs_date = DB::select(DB::raw("call `up_assign_department`($request->user_id , $request->department_id)")); 
        $response['msg'] = $rs_date[0]->save_remarks;
        $response['status'] =$rs_date[0]->save_status;
        return response()->json($response);  
    }

    public function UserWiseDepartment(Request $request)
    {   $admin=Auth::guard('admin')->user(); 
        $departmentassigns = DB::select(DB::raw("SELECT `da`.`id` , `dpt`.`department_name` , `dpt`.`officer_name` , `dpt`.`mobile_no` , `dpt`.`email_id` FROM `department_assigns` `da` INNER JOIN `department` `dpt` ON `da`.`department_id` = `dpt`.`id` where `da`.`user_id` =$request->id  order by `dpt`.`department_name`, `dpt`.`mobile_no`;"));
        return view('admin.account.assign.department.table' , compact('departmentassigns'));  
    }
    public function DepartmentAssignDelete($id)
    { 
        $id=(Crypt::decrypt($id));  
        $departmentassigns= DB::select(DB::raw("delete from `department_assigns` where `id` = $id;"));
        return redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
       
    }

    public function changePassword()
    {   
        return view('admin.account.change_password');  
    }
    public function changePasswordstore(Request $request)
    { 
      $rules=[
      'oldpassword'=> 'required',
      'password'=> 'required|min:6',
      'passwordconfirmation'=> 'required|min:6|same:password',
       ];
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
      }        
      $user=Auth::guard('admin')->user();              
        
      if(password_verify($request->oldpassword,$user->password)){
          if ($request->oldpassword == $request->password) {
               $response=['status'=>0,'msg'=>'Old Password And New Password Cannot Be Same'];
               return response()->json($response);
          }else{
                $password=bcrypt($request['password']);
                $rs_date = DB::select(DB::raw("update `admins` set `password` ='$password' , `password_plain` ='$request->password' where `id` = $user->id")); 
                $response=['status'=>1,'msg'=>'Password Change Successfully'];
                return response()->json($response);// response as json 
          }
          
      }else{               
          $response=['status'=>0,'msg'=>'Old Password Is Not Correct'];
          return response()->json($response);// response as json
      }        
    } 

}

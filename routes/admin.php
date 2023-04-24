<?php

use App\Http\Controllers\Admin\reportGenerateBarcode;
//registration start

//registration end 

Route::get('login', 'Auth\LoginController@login')->name('admin.login'); 
Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout.get');
Route::get('refreshcaptcha', 'Auth\LoginController@refreshCaptcha')->name('admin.refresh.captcha');
Route::post('login-post', 'Auth\LoginController@loginPost')->name('admin.login.post'); 

Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
	Route::get('outboxredirect/{click_id}', 'DashboardController@outboxredirect')->name('admin.outboxredirect');
	Route::get('inboxredirect/{click_id}', 'DashboardController@inboxredirect')->name('admin.inboxredirect');

	// Route::prefix('account')->group(function () {
		Route::get('/', 'AccountController@user_list_index')->name('admin.account.index');
	    Route::get('create_user_form', 'AccountController@create_user_form')->name('admin.account.form');
	    Route::post('store', 'AccountController@store_new_user')->name('admin.account.post');
		Route::get('list', 'AccountController@user_list')->name('admin.account.list');
		Route::get('edit/{account}', 'AccountController@edit')->name('admin.account.edit');
	// 	Route::post('update/{account}', 'AccountController@update')->name('admin.account.edit.post');
	// 	Route::get('delete/{account}', 'AccountController@destroy')->name('admin.account.delete');

	// 	Route::get('DistrictsAssign', 'AccountController@DistrictsAssign')->name('admin.account.DistrictsAssign');
	// 	Route::get('StateDistrictsSelect', 'AccountController@StateDistrictsSelect')->name('admin.account.StateDistrictsSelect');
	// 	Route::post('DistrictsAssignStore', 'AccountController@DistrictsAssignStore')->name('admin.Master.DistrictsAssignStore');
	// 	Route::get('DistrictsAssignDelete/{id}', 'AccountController@DistrictsAssignDelete')->name('admin.Master.DistrictsAssignDelete');

	// 	Route::get('DepartmentAssign', 'AccountController@DepartmentAssign')->name('admin.account.DepartmentAssign');//ok
	// 	Route::get('userWiseDepartment', 'AccountController@userWiseDepartment')->name('admin.account.userWiseDepartment');//ok
	// 	Route::post('DepartmentAssignStore', 'AccountController@DepartmentAssignStore')->name('admin.account.DepartmentAssignStore');//ok
	// 	Route::get('UserWiseDepartment', 'AccountController@UserWiseDepartment')->name('admin.account.UserWiseDepartment');//ok
	// 	Route::get('DepartmentAssignDelete/{id}', 'AccountController@DepartmentAssignDelete')->name('admin.account.DepartmentAssignDelete');//ok


		Route::get('changePassword', 'AccountController@changePassword')->name('admin.user.change.password');//ok
		Route::post('changePasswordstore', 'AccountController@changePasswordstore')->name('admin.user.change.password.store');//ok

		

		 
		
	// });

 //    Route::group(['prefix' => 'Master'], function() {
 //    	//-department-//ok
	//     Route::get('/', 'MasterController@index')->name('admin.Master.department');	   
	//     Route::post('Store/{id?}', 'MasterController@departmentStore')->name('admin.Master.department.store');	   
	//     Route::get('Edit{id}', 'MasterController@departmentEdit')->name('admin.Master.department.edit');
	//     Route::get('Delete{id}', 'MasterController@departmentDelete')->name('admin.Master.department.delete');
	//     //district
	//     Route::get('Districts', 'MasterController@districts')->name('admin.Master.districts');	   
	//     Route::post('Districts-Store{id?}', 'MasterController@districtsStore')->name('admin.Master.districtsStore');	   
	//     Route::get('DistrictsTable', 'MasterController@DistrictsTable')->name('admin.Master.DistrictsTable');
	//     Route::get('Districts-Edit/{id}', 'MasterController@districtsEdit')->name('admin.Master.districtsEdit');
	//     Route::get('Districts-delete/{id}', 'MasterController@districtsDelete')->name('admin.Master.districtsDelete');
 //       	//-category-//
	//     Route::get('category', 'MasterController@category')->name('admin.Master.category');	   
	//     Route::post('category-store/{id?}', 'MasterController@categoryStore')->name('admin.Master.category.store');	   
	//     Route::get('category-edit/{id}', 'MasterController@categoryEdit')->name('admin.Master.category.edit');	   
	//     Route::get('category-delete/{id}', 'MasterController@categoryDelete')->name('admin.Master.category.delete');
	//     //-task-//
	//     Route::get('task', 'MasterController@task')->name('admin.Master.task');	   
	//     Route::post('task-store/{id?}', 'MasterController@taskStore')->name('admin.Master.task.store');	   
	//     //-task-remarks//
	//     Route::get('outbox/{click_id?}', 'MasterController@outbox')->name('admin.Master.outbox');
	//     Route::get('outboxfilter/{rs_condition}', 'MasterController@outboxfilter')->name('admin.Master.outboxfilter');
	//     Route::get('outboxremarks/{rs_id}', 'MasterController@outboxremarks')->name('admin.Master.outboxremarks');
	//     Route::post('outboxremarksstore/{rs_id}', 'MasterController@outboxremarksstore')->name('admin.Master.outboxremarksstore');
	//     Route::get('outboxattachment/{rs_id}', 'MasterController@outboxattachment')->name('admin.Master.outboxattachment');
	//     Route::get('remaksattachment/{id}', 'MasterController@remaksattachment')->name('admin.Master.remaksattachment');
	//     Route::get('markcomplete/{id}', 'MasterController@markcomplete')->name('admin.Master.markcomplete');
	    
	//     //-task-remarks//
	//     Route::get('inbox/{click_id?}', 'MasterController@inbox')->name('admin.Master.inbox');  
	//     Route::get('inboxfilter/{rs_condition}', 'MasterController@inboxfilter')->name('admin.Master.inboxfilter');
	//     Route::get('inboxstatus/{rs_condition}', 'MasterController@inboxstatus')->name('admin.Master.inboxstatus');
	    
	// });
	
	// Route::group(['prefix' => 'report'], function() {
	// 	 Route::get('report', 'ReportController@index')->name('admin.report'); 
	// 	 Route::post('report-result', 'ReportController@reportResult')->name('admin.report.result'); 
		 
		 
		 
		  
	// });
    
 });
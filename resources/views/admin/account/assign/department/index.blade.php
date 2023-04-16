@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Department Assigns</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary"> 
                            <form action="{{ route('admin.account.DepartmentAssignStore') }}" method="post" class="add_form"  no-reset="true" select-triger="user_select_box">
                                {{ csrf_field() }}
                                <div class="card-body row">
                                  <div class="col-lg-5 form-group">
                                  <label for="exampleInputEmail1">User</label>
                                  <span class="fa fa-asterisk"></span>
                                  <select name="user_id" class="form-control" id="user_select_box" onchange="callAjax(this,'{{ route('admin.account.UserWiseDepartment') }}','department_table')">
                                    <option selected disabled>Select User</option>                                      
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }} &nbsp;&nbsp;&nbsp;( {{ $user->first_name }} )</option>  
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="col-lg-5 form-group">
                                  <label for="exampleInputEmail1">Department Name</label>
                                  <span class="fa fa-asterisk"></span>
                                  <select name="department_id" class="form-control">
                                    <option selected disabled>Select Department</option>                                      
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->email_id }} &nbsp;&nbsp;&nbsp;({{ $department->department_name }})</option>  
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="col-lg-2 form-group">
                                  <input type="submit" class="btn btn-success form-control" value="Save" style="margin-top:30px">
                                  </div> 
                                </div> 
                            </form>
                        </div> 
                        <div id="department_table"></div>
                    </div>
                </div>
            </div> 
        </div> 
    </section>
    @endsection
    @push('scripts')
    
    @endpush 


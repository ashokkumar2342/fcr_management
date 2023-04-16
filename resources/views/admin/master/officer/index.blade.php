@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Add Officer</h3>
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
                            <form action="{{ route('admin.Master.officer.Store') }}" method="post" class="add_form"  no-reset="true" reset-input-text="officer_name,mobile_no,email_id,designation" select-triger="department_select_box">
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-lg-3 form-group">
                                    <label for="exampleInputEmail1">Department Name</label>
                                    <span class="fa fa-asterisk"></span>
                                    <select name="department_name" class="form-control" id="department_select_box" data-table="officer_datatable" onchange="callAjax(this,'{{ route('admin.Master.officerTable') }}','officer_table')">    
                                        <option selected disabled>Select Department</option>                                      
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>  
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label for="exampleInputEmail1">Officer Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="officer_name" id="officer_name" class="form-control" placeholder="Enter Officer Name"maxlength="100">
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label for="exampleInputPassword1">Mobile No.</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile No." maxlength="10" minlength="10">
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label for="exampleInputPassword1">Email Id</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Enter Email Id" maxlength="100">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="exampleInputPassword1">Designation</label>
                                        
                                        <input type="text" name="designation" id="designation" class="form-control"  maxlength="100">
                                    </div>
                                </div> 
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary" id="officer_table"> 
                             <table id="officer_datatable" class="table table-striped table-hover control-label">
                                 <thead>
                                     <tr>
                                         <th>Department Name</th>
                                         <th>Officer Name</th>
                                         <th>Designation</th>
                                         <th>Mobile No.</th>
                                         <th>Email Id</th>
                                         <th>Action</th>
                                          
                                     </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                             </table>
                        </div> 
                        
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
    @endsection
    @push('scripts')
    
    @endpush 


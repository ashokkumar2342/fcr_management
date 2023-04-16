@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Create Department</h3>
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
                            <form action="{{ route('admin.Master.department.store') }}" method="post" class="add_form" content-refresh="department_table">
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="form-group col-lg-3">
                                        <label for="exampleInputEmail1">Department Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="department_name" class="form-control" placeholder="Enter Department Name" maxlength="100">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="exampleInputPassword1">Officer Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="officer_name" class="form-control" placeholder="Enter H Name" maxlength="100">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="exampleInputPassword1">Mobile No.</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No." maxlength="10" minlength="10">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="exampleInputPassword1">Email Id</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="email_id" class="form-control" placeholder="Enter Email Id" maxlength="100">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="exampleInputPassword1">Designation</label>
                                        
                                        <input type="text" name="designation" id="designation" class="form-control"  maxlength="100" placeholder="Enter Designation Name">
                                    </div>
                                    
                                     
                                </div> 
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary table-responsive"> 
                             <table id="department_table" class="table table-striped table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Department Name</th>
                                         <th>Officer name</th>
                                         <th>Mobile No</th>
                                         <th>Email Id</th>
                                         <th>Designation</th>
                                         {{-- <th>Action</th> --}}
                                          
                                     </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($departments as $department)
                                     <tr>
                                         <td>{{ $department->department_name }}</td>
                                         <td>{{ $department->officer_name }}</td>
                                         <td>{{ $department->mobile_no }}</td>
                                         <td>{{ $department->email_id }}</td>
                                         <td>{{ $department->designation }}</td>
                                         {{-- <td class="text-nowrap">
                                             <a onclick="callPopupLarge(this,'{{ route('admin.Master.department.edit',$department->id) }}')" title="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                             <a href="{{ route('admin.Master.department.delete',Crypt::encrypt($department->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');"  title="" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                         </td> --}}
                                     </tr> 
                                    @endforeach
                                 </tbody>
                             </table>
                        </div> 
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
    @endsection

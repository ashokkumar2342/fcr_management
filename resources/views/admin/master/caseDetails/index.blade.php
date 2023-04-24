@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Create Case</h3>
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
                            <form action="{{ route('admin.Master.Case.store') }}" method="post" class="add_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-lg-3 form-group">
                                        <label for="exampleInputEmail1">Case No</label>
                                        <input type="text" name="case_no"  class="form-control" />
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <label for="exampleInputEmail1">Case Year</label>
                                        <select  name="case_year" id="case_year" class="form-control">
                                        <?php 
                                           for($i = date('Y') ; 1950 < $i; $i--){
                                              echo "<option value=".$i.">$i</option>";
                                           }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-7 form-group">
                                        <label for="exampleInputEmail1">Case Titile</label>
                                        <input type="text" name="case_title"  class="form-control" />
                                    </div>
                                    
                                    
                                    <div class="form-group col-lg-12">
                                        <label for="exampleInputEmail1">Case Details</label> 
                                        <textarea class="form-control" name="task_details" maxlength="200"></textarea>
                                    </div>
                                    
                                   <div class="col-lg-4 form-group">
                                   <label>Case Releted To</label>
                                   <select class="form-control" name="case_releted_to">
                                    <option value="" selected="" disabled="">Select</option>
                                     @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} ({{ $user->last_name }}-{{ $user->email }})</option>  
                                    @endforeach                
                                    </select>
                                    </div> 
                                    <div class="form-group col-lg-4 ">
                                        <label for="exampleInputEmail1">Due Date</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="date" name="due_date" id="due_date" class="form-control">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">Attachment</label>
                                        <input type="file" name="attachment"  class="form-control" accept="application/pdf" />
                                    </div>
                                    <div class="col-lg-12 form-group " style="margin-top:30px">
                                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                                    </div>
                                </div> 
                            </form>
                        </div> 
                    </div>
                 
                </div>
            </div> 
        </div> 
    </section>
@endsection
   
@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Create Tasks</h3>
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
                            <form action="{{ route('admin.Master.task.store') }}" method="post" class="add_form" content-refresh="categorys_table" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="form-group col-lg-6">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <select name="category_name" class="form-control" id="department_select_box" data-table="officer_datatable" {{-- onchange="callAjax(this,'{{ route('admin.Master.officerTable') }}','officer_table')" --}}>    
                                            <option selected disabled>Select categorys</option>                                      
                                            {{-- @foreach ($categorys as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>  
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="exampleInputEmail1">Task Details</label> 
                                        <textarea class="form-control" name="task_details" maxlength="200"></textarea>
                                    </div>
                                    
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">Create Date</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="create_date" id="create_date" class="form-control" value="{{date('d-m-Y')}}" readonly>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">Due Date</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="date" name="due_date" id="due_date" class="form-control">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">Attachment</label>
                                        <input type="file" name="attachment"  class="form-control" accept="application/pdf" />
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    <label>Officer Name</label>
                                    <select class="select2bs4 select2-hidden-accessible" name="officer_name[]" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="23" tabindex="-1" aria-hidden="true">

                                    {{-- @foreach ($officers as $officer)
                                        <option value="{{ $officer->id }}">{{ $officer->officer_name }} ({{ $officer->designation }}-{{ $officer->department_name }})</option>  
                                    @endforeach  --}}                 
                                    </select>
                                    </div> 
                                <div class="col-lg-12 form-group " style="margin-top:30px">
                                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                                </div>
                                </div> 
                            </form>
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary table-responsive"> 
                             {{-- <table id="categorys_table" class="table table-striped table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Cotegory Name</th>
                                        
                                         <th>Action</th>
                                          
                                     </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($categorys as $category)
                                     <tr>
                                        <td>{{ $category->category_name }}</td> 
                                        <td class="text-nowrap">
                                         <a onclick="callPopupLarge(this,'{{ route('admin.Master.category.edit',$category->id) }}')" title="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                         <a href="{{ route('admin.Master.category.delete',Crypt::encrypt($category->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');"  title="" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                         </td>
                                     </tr> 
                                    @endforeach
                                 </tbody>
                             </table> --}}
                        </div> 
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
@endsection
   
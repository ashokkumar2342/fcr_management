@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Create Category</h3>
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
                            <form action="{{ route('admin.Master.category.store') }}" method="post" class="add_form" content-refresh="categorys_table">
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="form-group col-lg-6">
                                        <label for="exampleInputEmail1">Cotegory Name</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="category_name" class="form-control" placeholder="Enter Cotegory Name" maxlength="100">
                                    </div> 
                                <div class="col-lg-6 form-group " style="margin-top:30px">
                                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                                </div>
                                </div> 
                            </form>
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary table-responsive"> 
                             <table id="categorys_table" class="table table-striped table-bordered">
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
                             </table>
                        </div> 
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
    @endsection

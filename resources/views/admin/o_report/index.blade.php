@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Report</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card"> 
            <div class="card-body"> 
                <form action="{{ route('admin.report.result') }}" method="post" class="add_form" success-content-id="report_table">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Cotegory Name</label> 
                            <select name="category_name" id="category_name" class="form-control">
                                <option value="0">All</option>
                                @foreach ($categorys as $category) 
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Department Name</label> 
                            <select name="department_name" id="department_name" class="form-control">
                                <option value="0">All</option> 
                                @foreach ($departments as $department) 
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Officer Name</label> 
                            <select name="officer_name" id="officer_name" class="form-control">
                                <option value="0">All</option> 
                                @foreach ($officers as $officer) 
                                    <option value="{{$officer->id}}">{{$officer->officer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4" style="margin-top:30px">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkboxPrimary3" name="all_assigned_date" value="0">
                            <label for="checkboxPrimary3">All Assigned Date</label> 
                        </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Assigned Date</label> 
                            <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                            </span>
                            </div>
                            <input type="text" class="form-control float-right" name="assigned_date" id="reservation">
                            </div> 
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Due Date</label> 
                            <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                            </span>
                            </div>
                            <input type="date" class="form-control float-right" name="due_date">
                            </div> 
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Overdue Status</label> 
                            <select name="status" id="status" class="form-control">
                                <option value="0">All</option> 
                                <option value="1">Overdue</option>  
                            </select> 
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Status</label> 
                            <select name="status" id="status" class="form-control">
                                <option value="0">All</option> 
                                @foreach ($taskstatus as $taskstatu) 
                                    <option value="{{$taskstatu->id}}">{{$taskstatu->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Days Overdue</label> 
                            <input type="text" name="days_overdue" class="form-control" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div> 
                        <div class="col-lg-4 form-group " style="margin-top:30px">
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </div>
                    </div> 
                </form>
            </div> 
        </div> 
    </div> 
</section>
@endsection
@push('scripts')
<script>
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
</script>
@endpush

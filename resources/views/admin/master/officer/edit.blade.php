<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit</h4>
      <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="{{ route('admin.Master.officer.Store',$officers[0]->id) }}" method="post" class="add_form"  no-reset="true" reset-input-text="officer_name,mobile_no,email_id" select-triger="department_select_box" button-click="btn_close">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 form-group">
                <label for="exampleInputEmail1">Department Name</label>
                <span class="fa fa-asterisk"></span>
                <select name="department_name" class="form-control" id="department_select_box" data-table="officer_datatable" onchange="callAjax(this,'{{ route('admin.Master.officerTable') }}','officer_table')">    
                    <option selected disabled>Select Department</option>                                      
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}"{{ $department->id==$officers[0]->department_id?'selected':''}}>{{ $department->department_name }}</option>  
                    @endforeach
                </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="exampleInputEmail1">Officer Name</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="text" name="officer_name" id="officer_name" class="form-control" placeholder="Enter Officer Name"maxlength="100" value="{{$officers[0]->officer_name}}">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="exampleInputPassword1">Mobile No.</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile No." maxlength="10" minlength="10" value="{{$officers[0]->mobile_no}}">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="exampleInputPassword1">Email Id</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Enter Email Id" maxlength="100" value="{{$officers[0]->email_id}}">
                </div>
                <div class="col-lg-12 form-group">
                    <label for="exampleInputPassword1">Designation</label>
                    
                    <input type="text" name="designation" id="designation" class="form-control"  maxlength="100" value="{{$officers[0]->designation}}">
                </div>
            </div> 
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>


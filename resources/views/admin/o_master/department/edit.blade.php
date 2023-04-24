<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit</h4>
      <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="{{ route('admin.Master.department.store',$department[0]->id) }}" method="post" class="add_form" content-refresh="department_table" button-click="btn_close">
        {{ csrf_field() }}
        
          <div class="row">
            <div class="form-group col-lg-3">
                <label for="exampleInputEmail1">Department Name</label>
                <span class="fa fa-asterisk"></span>
                <input type="text" name="department_name" class="form-control" placeholder="Enter Department Name" value="{{$department[0]->department_name}}" maxlength="100">
            </div>
            <div class="form-group col-lg-3">
                <label for="exampleInputPassword1">Officer Name</label>
                <span class="fa fa-asterisk"></span>
                <input type="text" name="officer_name" class="form-control" placeholder="Enter Officer Name" value="{{$department[0]->h_name}}" maxlength="100">
            </div>
            <div class="form-group col-lg-3">
                <label for="exampleInputPassword1">Mobile No.</label>
                <span class="fa fa-asterisk"></span>
                <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No." value="{{$department[0]->mobile_no}}" maxlength="10" minlength="10">
            </div>
            <div class="form-group col-lg-3">
                <label for="exampleInputPassword1">Email Id</label>
                <span class="fa fa-asterisk"></span>
                <input type="text" name="email_id" class="form-control" placeholder="Enter Email Id" value="{{$department[0]->email_id}}" maxlength="100">
            </div>
            <div class="col-lg-12 form-group">
                <label for="exampleInputPassword1">Designation</label>
                
                <input type="text" name="designation" id="designation" class="form-control" value="{{$department[0]->designation}}"  maxlength="100">
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


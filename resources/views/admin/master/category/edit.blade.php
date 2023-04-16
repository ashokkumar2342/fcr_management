<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit</h4>
      <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="{{ route('admin.Master.category.store',$categorys[0]->id) }}" method="post" class="add_form"  no-reset="true" reset-input-text="officer_name,mobile_no,email_id" content-refresh="categorys_table" button-click="btn_close">
            {{ csrf_field() }}
            <div class="row">
                
                <div class="col-lg-12 form-group">
                    <label for="exampleInputPassword1">Category Name</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" maxlength="100" value="{{$categorys[0]->category_name}}">
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


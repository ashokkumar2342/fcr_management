<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Remarks</h4>
      <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">  
        <form action="{{ route('admin.Master.caseRemarksStore', $rs_id) }}" method="post" class="add_form" enctype="multipart/form-data" button-click="btn_close">
            {{ csrf_field() }}
               <div class="row"> 
                <div class="col-lg-12 form-group">
                    <label for="exampleInputEmail1">Remarks</label>
                    <span class="fa fa-asterisk"></span>
                    <textarea name="remarks" class="form-control" maxlength="250" required placeholder="Enter Remarks"></textarea>
                </div>
                <div class="col-lg-12 form-group">
                    <label for="exampleInputEmail1">Attachment</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="file" name="attachment"  class="form-control" accept="application/pdf" / required>
                </div>
                
                <div class="col-lg-12 form-group " style="margin-top:30px">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
              </div> 
        </form>
      </div>
    </div>
  </div> 


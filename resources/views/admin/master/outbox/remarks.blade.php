<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Remarks</h4>
      <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <table id="categorys_table" class="table table-striped table-bordered">
            <thead>                            <tr>
                    <th>Officer Name</th>
                    <th>Remarks</th>
                    <th>Remarks Date</th> 
                    <th>Attachment</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($tasksRemarks as $tasksRemark)
                <tr>
                    
                    <td>{{ $tasksRemark->officer_name }}</td> 
                    <td>{{ $tasksRemark->remarks }}</td> 
                    <td>{{ $tasksRemark->remarks_date }}</td> 
                    @if(!empty($tasksRemark->attachment)) 
                    <td><a target="_blank" href="{{route('admin.Master.remaksattachment',$tasksRemark->id)}}">Attchment</a></td>
                    @else
                    <td></td> 
                    @endif 
                   
                </tr> 
                @endforeach
            </tbody>
        </table>
        <div class="card card-info">
        <div class="card-header">
        <h3 class="card-title">Input Remarks</h3>
        </div>
        <form action="{{ route('admin.Master.outboxremarksstore' ,$rs_id) }}" method="post" class="add_form" enctype="multipart/form-data" button-click="btn_remarks">
            {{ csrf_field() }}
               <div class="row"> 
                <div class="col-lg-6 form-group">
                    <label for="exampleInputEmail1">Remarks</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="text" name="remarks" id="remarks" class="form-control">
                </div>
                <div class="col-lg-6 form-group">
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


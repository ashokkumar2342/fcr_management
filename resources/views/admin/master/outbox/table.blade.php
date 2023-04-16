<table id="outbox_datatable" class="table table-striped table-bordered" >
<thead>                            <tr>
        <th class="text-nowrap">Sr.No.</th>
        <th class="text-nowrap">Category</th>
        <th class="text-nowrap">Tasks</th>
        <th class="text-nowrap">Assigned Date</th>
        <th class="text-nowrap">Due Date</th>
        <th class="text-nowrap">Department</th>
        <th class="text-nowrap">Officer Assigned</th>   
        <th class="text-nowrap">Latest Remarks</th>   
        <th class="text-nowrap">Days Left</th>   
        <th class="text-nowrap">Attach.</th>  
        <th>Status</th>
        <th class="text-nowrap">Action</th>
    </tr>
</thead>
<tbody>
@php
$arrayId=1;
@endphp
@foreach ($rs_outbox as $outbox)
<tr>
    <td class="text-nowrap">{{ $arrayId ++ }}</td>
    <td class="text-nowrap">{{ $outbox->category_name }}</td> 
    <td class="text-nowrap">{{ $outbox->task_details }}</td> 
    <td class="text-nowrap">{{ $outbox->create_date }}</td> 
    <td class="text-nowrap">{{ $outbox->due_date }}</td>
    <td class="text-nowrap">{{ $outbox->departments }}</td>
    <td class="text-nowrap">{{ $outbox->task_officers }}</td>
    <td class="text-nowrap">{{ $outbox->latest_remarks }}</td>
    <td class="text-nowrap">{{ $outbox->days_left }}</td>
    @if(!empty($outbox->attachment)) 
    <td class="text-nowrap"><a target="_blank" href="{{route('admin.Master.outboxattachment',$outbox->id)}}">Attchment</a></td>
    @else
    <td></td> 
    @endif
    @php
     if ($outbox->status==0) {
        $color="btn-danger";
     }
     if ($outbox->status==1) {
         $color="btn-warning";
     } 
     if ($outbox->status==2) {
         $color="btn-success";
     } 

     @endphp 
        <td class="text-nowrap">{{ $outbox->status_type }}<br>
        
       @if ($outbox->status==1) 
        <a id="btn_markcomplete" button-click="btn_outbox_complete" success-popup="true" onclick="callAjax(this,'{{ route('admin.Master.markcomplete',$outbox->id) }}')" title="" class="btn {{$color}} btn-xs" style="color:#fff"><i class="fa fa-pencil"></i>Mark Complete</a>
        @endif

        </td>
    <td class="text-nowrap">
        <a id="btn_remarks" onclick="callPopupLarge(this,'{{ route('admin.Master.outboxremarks',$outbox->id) }}')" title="" class="btn btn-info btn-xs" style="color:#fff"><i class="fa fa-comment"></i>Remarks</a>
        
    </td>
</tr> 
@endforeach
</tbody>

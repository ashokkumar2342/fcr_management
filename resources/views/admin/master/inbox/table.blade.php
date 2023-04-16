<table id="inbox_datatable" class="table table-striped table-bordered">
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
        <th class="text-nowrap">Attachment</th>  
        <th>Status</th>
        <th class="text-nowrap">Action</th>
    </tr>
</thead>
@php
$arrayId=1;
@endphp
<tbody>
@foreach ($rs_inbox as $inbox)
<tr>
    <td class="text-nowrap">{{ $arrayId ++ }}</td>
    <td class="text-nowrap">{{ $inbox->category_name }}</td> 
    <td class="text-nowrap">{{ $inbox->task_details }}</td> 
    <td class="text-nowrap">{{ $inbox->create_date }}</td> 
    <td class="text-nowrap">{{ $inbox->due_date }}</td>
    <td class="text-nowrap">{{ $inbox->departments }}</td>
    <td class="text-nowrap">{{ $inbox->task_officers }}</td>
    <td class="text-nowrap">{{ $inbox->latest_remarks }}</td>
    <td class="text-nowrap">{{ $inbox->days_left }}</td>
    @if(!empty($inbox->attachment)) 
    <td class="text-nowrap"><a target="_blank" href="{{route('admin.Master.outboxattachment',$inbox->id)}}">Attchment</a></td>
    @else
    <td></td> 
    @endif
    @php
     if ($inbox->status==0) {
        $color="btn-danger";
     }
     if ($inbox->status==1) {
         $color="btn-warning";
     } 
     if ($inbox->status==2) {
         $color="btn-success";
     } 

     @endphp 
        <td>{{ $inbox->status_type }}<br>
        @if($inbox->status==0) 
        <a id="btn_markcomplete" button-click="btn_inbox_inproces" success-popup="true" onclick="callAjax(this,'{{ route('admin.Master.inboxstatus',$inbox->id) }}')" title="" class="btn btn-danger btn-xs" style="color:#fff"><i class="fa fa-pencil"></i>Get Acknowledged Pending</a>
        @endif
     
    <td class="text-nowrap ">
        <a id="btn_remarks" onclick="callPopupLarge(this,'{{ route('admin.Master.outboxremarks',$inbox->id) }}')" title="" class="btn btn-info btn-xs" style="color:#fff"><i class="fa fa-comment"></i>Remarks</a>
        
    </td>
</tr> 
@endforeach
</tbody>

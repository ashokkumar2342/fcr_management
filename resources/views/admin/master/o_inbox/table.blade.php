<table id="outbox_datatable" class="table table-striped table-bordered" >
<thead>                            <tr>
        <th class="text-nowrap">Sr.No.</th>
        <th class="text-nowrap">Date</th>
        <th class="text-nowrap">Case No</th>
        <th class="text-nowrap">Case Year</th>
        <th class="text-nowrap">Case Title</th>
        <th class="text-nowrap">Task Details</th>
        <th class="text-nowrap">Case Releted To</th>   
        <th class="text-nowrap">Due Date</th> 
        <th class="text-nowrap">Days Left</th>   
        <th class="text-nowrap">Document</th>  
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
    <td class="text-nowrap">{{ $arrayId++ }}</td>
    <td class="text-nowrap"></td> 
    <td class="text-nowrap">{{ $outbox->case_no }}</td>    
    <td class="text-nowrap">{{ $outbox->case_year }}</td>  
    <td class="text-nowrap">{{ $outbox->title }}</td> 
    <td class="text-nowrap">{{ $outbox->task_details }}</td>  
    <td class="text-nowrap">{{ $outbox->case_related_to }}</td> 
    <td class="text-nowrap">{{ $outbox->due_date }}</td>  
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

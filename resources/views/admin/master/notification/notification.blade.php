<table id="val_inbox_datatable" class="table table-striped table-bordered" >
<thead>                            
    <tr>
        <th class="text-nowrap">Sr. No.</th>
        <th class="text-nowrap">Notification From</th>
        <th class="text-nowrap">Date</th>
        <th class="text-nowrap">Case No.</th>
        <th class="text-nowrap">Case Title</th>
        <th class="text-nowrap">Remarks</th>
        <th class="text-nowrap">Attachment</th>
        <th>Status</th>
        <th class="text-nowrap">Action</th>
    </tr>
</thead>
<tbody>
@php
$arrayId=1;
@endphp
@foreach ($rs_notification as $val_inbox)
<tr>
    <td class="text-nowrap">{{ $arrayId++ }}</td>
    <td class="text-nowrap">{{ $val_inbox->first_name }}</td>
    <td class="text-nowrap">{{ $val_inbox->remark_date_time }}</td> 
    <td class="text-nowrap">{{ $val_inbox->case_no }}</td>    
    <td class="text-nowrap">{{ $val_inbox->title }}</td> 
    <td class="text-nowrap">{{ $val_inbox->remarks }}</td>
    
    @if(!empty($val_inbox->attachment)) 
        <td class="text-nowrap"><a target="_blank" href="{{route('admin.Master.caseAttachment',$val_inbox->id)}}">Attchment</a></td>
    @else
        <td></td> 
    @endif
    @php
     if ($val_inbox->status==0) {
        $color="btn-danger";
     }elseif ($val_inbox->status==1) {
         $color="btn-success";
     }else {
         $color="btn-warning";
     } 

     @endphp 
    
    <td class="text-nowrap">
        {{ $val_inbox->status }}
    </td>
    <td class="text-nowrap">
        <a id="btn_remarks" onclick="callPopupLarge(this,'{{ route('admin.Master.caseRemarks',$val_inbox->id) }}')" title="" class="btn btn-info btn-xs" style="color:#fff"><i class="fa fa-comment"></i> View Remarks</a>

        <a id="btn_remarks_add" onclick="callPopupLarge(this,'{{ route('admin.Master.caseRemarksAdd',$val_inbox->id) }}')" title="" class="btn btn-info btn-xs" style="color:#fff"><i class="fa fa-edit"></i> Add Remarks</a>
        
    </td>
</tr> 
@endforeach
</tbody>

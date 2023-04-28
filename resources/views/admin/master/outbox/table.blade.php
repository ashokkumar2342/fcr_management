<table id="val_inbox_datatable" class="table table-striped table-bordered" >
<thead>                            
    <tr>
        <th class="text-nowrap">Sr.No.</th>
        <th class="text-nowrap">Assigned To</th>
        <th class="text-nowrap">Date</th>
        <th class="text-nowrap">Case No</th>
        <th class="text-nowrap">Case Year</th>
        <th class="text-nowrap">Case Title</th>
        <th class="text-nowrap">Case Details</th>   
        <th class="text-nowrap">Due Date</th> 
        <th class="text-nowrap">Attachment</th>  
        <th class="text-nowrap">Latest Remarks</th>  
        <th>Status</th>
        <th class="text-nowrap">Action</th>
    </tr>
</thead>
<tbody>
@php
$arrayId=1;
@endphp
@foreach ($rs_outbox as $val_inbox)
<tr>
    <td class="text-nowrap">{{ $arrayId++ }}</td>
    <td class="text-nowrap">{{ $val_inbox->first_name }}</td>
    <td class="text-nowrap">{{ $val_inbox->date_create }}</td> 
    <td class="text-nowrap">{{ $val_inbox->case_no }}</td>    
    <td class="text-nowrap">{{ $val_inbox->case_year }}</td>  
    <td class="text-nowrap">{{ $val_inbox->title }}</td> 
    <td class="text-nowrap">{{ $val_inbox->case_details }}</td> 
    <td class="text-nowrap">{{ $val_inbox->date_due }}</td>
    @if(!empty($val_inbox->attachment)) 
        <td class="text-nowrap"><a target="_blank" href="{{route('admin.Master.caseAttachment',$val_inbox->id)}}">Attchment</a></td>
    @else
        <td></td> 
    @endif
    <td class="text-nowrap">{{ $val_inbox->remarks }}</td>
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
        {{ $val_inbox->case_status }}
        @if ($val_inbox->status==0) 
            <br>
            <a id="btn_markcomplete" button-click="btn_outbox_complete" success-popup="true" onclick="callAjax(this,'{{ route('admin.Master.markcomplete',$val_inbox->id) }}')" title="" class="btn {{$color}} btn-xs" style="color:#fff"><i class="fa fa-pencil"></i>Mark Complete</a>
        @endif
    </td>
    <td class="text-nowrap">
        <a id="btn_remarks" onclick="callPopupLarge(this,'{{ route('admin.Master.caseRemarks',$val_inbox->id) }}')" title="" class="btn btn-info btn-xs" style="color:#fff"><i class="fa fa-comment"></i> View Remarks</a>

        <a id="btn_remarks_add" onclick="callPopupLarge(this,'{{ route('admin.Master.caseRemarksAdd',$val_inbox->id) }}')" title="" class="btn btn-info btn-xs" style="color:#fff"><i class="fa fa-edit"></i> Add Remarks</a>
        
    </td>
</tr> 
@endforeach
</tbody>





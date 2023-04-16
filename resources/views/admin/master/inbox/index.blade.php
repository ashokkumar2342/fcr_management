@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">    
@endpush
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4"> 
                <h3>Inbox :</h3> 
            </div> 
            <div class="col-sm-2">
                <button type="button" class="btn btn-info btn-block" id="btn_inbox_all" data-table-excel-2="inbox_datatable" onclick="callAjax(this,'{{ route('admin.Master.inboxfilter',3) }}','inbox_table')"> <i class="fas fa-envelope"></i> All Tasks</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger btn-block" id="btn_inbox_acknowledged" data-table-excel-2="inbox_datatable" onclick="callAjax(this,'{{ route('admin.Master.inboxfilter',0) }}','inbox_table')">Acknowledged Pending</button>   
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-warning btn-block" id="btn_inbox_inproces" data-table-excel-2="inbox_datatable" onclick="callAjax(this,'{{ route('admin.Master.inboxfilter',1) }}','inbox_table')">In Progress</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-success btn-block" id="btn_inbox_complete" data-table-excel-2="inbox_datatable" onclick="callAjax(this,'{{ route('admin.Master.inboxfilter',2) }}','inbox_table')">Completed</button>
            </div> 
        </div> 
        <div class="card card-body">
        <div class="col-lg-12 table-responsive" id="inbox_table"> 
            <table class="table table-striped table-bordered">
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
                <tbody >
                    
                </tbody>
            </table> 
        </div> 
    </div>
</div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">

    if ({{$click_id}}==3) {
    $('#btn_inbox_all').click();
    }
    if ({{$click_id}}==0) {
    $('#btn_inbox_acknowledged').click();
    }
    if ({{$click_id}}==1) {
    $('#btn_inbox_inproces').click();
    }
    if ({{$click_id}}==2) {
    $('#btn_inbox_complete').click();
    }

</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
@endpush

<table id="district_datatable" class="table table-striped table-hover control-label">
    <thead>
        <tr>
            <th>Department Name</th>
            <th>Officer Name</th>
            <th>Designation</th>
            <th>Mobile No.</th>
            <th>Email id</th> 
            <th>Action</th>
             
        </tr>
    </thead>
    <tbody> 
@foreach ($officers as $officer) 
 <tr>
     <td>{{ $officer->department_name}}</td>
     <td>{{ $officer->officer_name }}</td>
     <td>{{ $officer->designation }}</td>
     <td>{{ $officer->mobile_no }}</td>
     <td>{{ $officer->email_id }}</td>
     <td class="text-nowrap">
         
     <a onclick="callPopupLarge(this,'{{ route('admin.Master.officerEdit',$officer->id) }}')" title="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
     <a href="{{ route('admin.Master.officerDelete',Crypt::encrypt($officer->id)) }}" onclick="return confirm('Are you sure you want to delete this item?');"  title="" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
     </td>
 </tr> 
@endforeach
</tbody>
</table>
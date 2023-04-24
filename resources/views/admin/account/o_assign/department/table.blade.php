
<table class="table  table-bordered table-striped">
<thead>
<tr> 
<th>Department Name</th>
<th>H Name</th>
<th>Mobile No.</th>
<th>Email Id</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($departmentassigns as $departmentassign)
<tr>
<td>{{ $departmentassign->email_id}} &nbsp; &nbsp; ({{ $departmentassign->department_name}})</td> 
<td>{{ $departmentassign->officer_name}}</td> 
<td>{{ $departmentassign->mobile_no}}</td> 
<td>{{ $departmentassign->email_id}}</td> 
<td>
<a title="Delete" class="btn btn-xs btn-danger" select-triger="user_select_box" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.account.DepartmentAssignDelete',Crypt::encrypt($departmentassign->id)) }}') } else{console_Log('cancel') }"  ><i class="fa fa-trash"></i></a>
</td> 
</tr> 
@endforeach
</tbody>
</table> 
</div> 
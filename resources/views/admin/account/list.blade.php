<div class="col-lg-12">
  <div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th>Sr.No.</th> 
          <th>Name</th>
          <th>Mobile</th> 
          <th>Email Id</th>
          <th>Role</th> 
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
        $arrayId=1;
        
        @endphp
        @foreach($accounts as $account) 
        <tr>
          <td>{{ $arrayId ++ }}</td> 
          <td>{{ $account->first_name }} {{ $account->last_name}}</td>
          <td>{{ $account->mobile }}</td> 
          <td>{{ $account->email }}</td>
          <td>{{ $account->name or '' }}</td> 
          <td> 
            <a href="#" onclick="callPopupLarge(this,'{{ route('admin.account.edit',Crypt::encrypt($account->id)) }}')" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
          </td>
        </tr> 
        @endforeach
      </tbody>
    </table>
  </div>
</div>
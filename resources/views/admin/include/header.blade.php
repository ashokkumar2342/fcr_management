@php
   $admin = Auth::guard('admin')->user();
   $notifications = DB::select(DB::raw("select date_format(`entry_date_time`, '%d %b %Y %H:%i') as `remark_date_time`, `remarks`, `attachment`, `case_id` from `notifications` where `notification_for` = $admin->id order by `id`;"));
@endphp 
<nav class="main-header navbar navbar-expand navbar-white navbar-light"> 
   <ul class="navbar-nav ml-auto"> 

      <li class="nav-item dropdown" style="padding-top: 5px;">
         <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ count($notifications) }}</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ count($notifications) }} Notifications</span>
            <div class="dropdown-divider"></div>

            @foreach ($notifications as $notification)
               <a href="#" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i> {{ $notification->remarks }}
                  <span class="float-right text-muted text-sm">{{ $notification->remark_date_time }}</span>
               </a>
            @endforeach
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
         </div>
      </li>

      <li class="nav-item">
         <a class="btn btn-lg" title="Sign Out" href="{{ route('admin.logout.get') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" style="color:#21252;"></i></a>
         <form id="logout-form" action="{{ route('admin.logout.get') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
         </form>
      </li>
   </ul>
</nav>

<!-- /.navbar -->

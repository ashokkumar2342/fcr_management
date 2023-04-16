
@php
$admin=Auth::guard('admin')->user();
@endphp 
  <nav class="main-header navbar navbar-expand navbar-info navbar-light" style="background-color:#001f3f">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:#fff"></i></a>
      </li>
          
    </ul>
    
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        
        <h5 style="color:#fff;margin-top:10px">Welcom : {{$admin->first_name}}</h5>
      
      </li>       
      <li class="nav-item">
        <a class="btn btn-lg" title="Sign Out" href="{{ route('admin.logout.get') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out" style="color:#fff"></i>
        </a>
        <form id="logout-form" action="{{ route('admin.logout.get') }}" method="POST" style="display: none;">
           {{ csrf_field() }}
        </form>
      </li>

      
          
   
    </ul>
  </nav>
  <!-- /.navbar -->

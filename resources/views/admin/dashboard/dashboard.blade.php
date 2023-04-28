@extends('admin.layout.base')
@section('body')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="card" style="background-color:#f3e1eb">
      <div class="card-header">
      <h5 class="card-title">{{$box_caption}}</h5><br><br>
      <div class="container-fluid">
        <div class="row">
          
          @if($role_id == 2)
            <div class="col-12 col-sm-6 col-md-4">
              <a href="{{route('admin.outboxredirect',2)}}">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Cases</span>
                  <span class="info-box-number">{{$rs_total[0]->ttask}}</span>
                </div> 
              </div>
              </a> 
            </div> 
            <div class="col-12 col-sm-6 col-md-4">
              <a href="{{route('admin.outboxredirect',0)}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pending</span>
                  <span class="info-box-number">{{$rs_pending[0]->ttask}}</span>
                </div> 
              </div>
              </a> 
            </div>  
            <div class="col-12 col-sm-6 col-md-4">
              <a href="{{route('admin.outboxredirect',1)}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Completed</span>
                  <span class="info-box-number">{{$rs_completed[0]->ttask}}</span>
                </div> 
              </div>
              </a> 
            </div> 
          @else
            <div class="col-12 col-sm-6 col-md-4">
              <a href="{{route('admin.inboxredirect',2)}}">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Cases</span>
                  <span class="info-box-number">{{$rs_total[0]->ttask}}</span>
                </div> 
              </div>
              </a> 
            </div> 
            <div class="col-12 col-sm-6 col-md-4">
              <a href="{{route('admin.inboxredirect',0)}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pending</span>
                  <span class="info-box-number">{{$rs_pending[0]->ttask}}</span>
                </div> 
              </div>
              </a> 
            </div>  
            <div class="col-12 col-sm-6 col-md-4">
              <a href="{{route('admin.inboxredirect',1)}}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Completed</span>
                  <span class="info-box-number">{{$rs_completed[0]->ttask}}</span>
                </div> 
              </div>
              </a> 
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  
</section>
@endsection 


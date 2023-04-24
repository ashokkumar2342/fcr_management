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
      <h5 class="card-title">OutBox</h5><br><br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.outboxredirect',3)}}">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Tasks</span>
                <span class="info-box-number">{{$outboxTotal[0]->ttask}}</span>
              </div> 
            </div>
            </a> 
          </div> 
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.outboxredirect',0)}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tasks"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Acknowledged Pending</span>
                <span class="info-box-number">{{$outacknowledgedPending[0]->ttask}}</span>
              </div> 
            </div>
            </a> 
          </div>  
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.outboxredirect',1)}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">In Progress</span>
                <span class="info-box-number">{{$outInProgress[0]->ttask}}</span>
              </div> 
            </div>
            </a> 
          </div> 
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.outboxredirect',2)}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Completed</span>
                <span class="info-box-number">{{$outCompleted[0]->ttask}}</span>
              </div> 
            </div>
          </a>
          </div> 
        </div>
      </div>
    </div>
  </div>
  <div class="card" style="background-color:#f3e1eb">
      <div class="card-header">
      <h5 class="card-title">Inbox</h5><br><br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.inboxredirect',3)}}">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Tasks</span>
                <span class="info-box-number">{{$inboxTotal[0]->ttask}}</span>
              </div> 
            </div>
            </a> 
          </div> 
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.inboxredirect',0)}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tasks"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Acknowledged Pending</span>
                <span class="info-box-number">{{-- {{$inboxacknowledgedPending[0]->ttask}} --}}</span>
              </div> 
            </div>
            </a> 
          </div>  
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.inboxredirect',1)}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">In Progress</span>
                <span class="info-box-number">{{-- {{$inboxInProgress[0]->ttask}} --}}</span>
              </div> 
            </div>
          </a>
          </div> 
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{route('admin.inboxredirect',2)}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Completed</span>
                <span class="info-box-number">{{-- {{$inboxCompleted[0]->ttask}} --}}</span>
              </div> 
            </div>
            </a> 
          </div> 
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 


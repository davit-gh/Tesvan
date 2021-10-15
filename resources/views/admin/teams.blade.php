@extends("layouts.admin")

@section('styles')


@endsection

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Teams</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('team.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Teams</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<a href="{{ route('create.team') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a><br><br>
<div class="card card-primary">
  @if(session('success'))
     <span class="alert alert-success" role="alert">
         <strong>{{ session('success') }}</strong>
     </span>
  @endif
  <div class="container">
    <style type="text/css">
      table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
      }
    </style>
  <table id="datatable" class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>Name | English</th>
              <th>Name | Russian</th>
              <th>Name | Armenian</th>
              <th>Position | English</th>
              <th>Position | Russian</th>
              <th>Position | Armenian</th>
              <th>Place Number</th>
              <th>Photo</th>
              <th>Background Color</th>
          </tr>
      </thead>
  </table>
  </div>

@endsection

@section('scripts')

<script src="/js/courses/courses_reg.js"></script>
<script src="/js/courses/courses_validation.js"></script>
@include('admin.scripts.teams')

@endsection

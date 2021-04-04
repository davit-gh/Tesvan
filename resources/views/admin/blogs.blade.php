@extends("layouts.admin")

@section('styles')


@endsection

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Blogs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Blogs</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a><br><br>
<div class="card card-primary">
  @if(session('success'))
     <span class="alert alert-success" role="alert">
         <strong>{{ session('success') }}</strong>
     </span>
  @endif
  <div class="container">
  <table id="datatable" class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Image</th>
              <th>Status</th>
              <th>Published Date</th>
              <th width="200">Action</th>
          </tr>
      </thead>
  </table>
  </div>

@endsection

@section('scripts')

@include('admin.scripts.blogs')

@endsection

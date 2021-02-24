@extends("layouts.admin")

@section('styles')


@endsection

@section('content')
<a href="{{ route('admin') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a><br><br>
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
              <th>Project Name</th>
              <th>Project Logo</th>
              <th>Overview</th>
              <th>Challenge</th>
              <th>Solution</th>
              <th width="200">Action</th>
          </tr>
      </thead>
  </table>
  </div>

@endsection

@section('scripts')

<script src="/js/courses/courses_reg.js"></script>
<script src="/js/courses/courses_validation.js"></script>
@include('admin.scripts.projects')

@endsection

@extends("layouts.admin")

@section('styles')


@endsection

@section('content')

<style type="text/css">
  .hidden{
    display: none;
  }
</style>

 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Blog Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Home</a></li>
              <li class="breadcrumb-item active">Blog Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="card card-primary">
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  @if(session('success'))
     <span class="alert alert-success" role="alert">
         <strong>{{ session('success') }}</strong>
     </span>
  @endif
  <form method="POST" enctype="multipart/form-data" action="{{ route('blog.update') }}">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input value="{{ $blog->id }}" type="hidden" class="form-control" name="id">
        <input value="{{ old('title',$blog->title) }}" type="text" class="form-control" name="title"> 
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input type="file" class="form-control" name="image">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea class="form-control" name="description">{{ old('description',$blog->description) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Status</label>
        <select class="form-control" name="status">
            <option {{ ($blog->status=="Publish") ? "selected":"" }}>Publish</option>
            <option {{ ($blog->status=="Draft") ? "selected":"" }}>Draft</option>
        </select>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>

@endsection

@section('scripts')

@include('admin.scripts.admin')

@endsection

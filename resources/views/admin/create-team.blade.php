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
            <h1 class="m-0 text-dark">Create Team</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Create Team</li>
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
  <form method="POST" enctype="multipart/form-data" action="{{ route('team.store') }}">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input value="{{ old('name') }}" type="text" class="form-control" placeholder="English Name" name="name"><br/>
        <input value="{{ old('name_ru') }}" type="text" class="form-control" placeholder="Russian Name" name="name_ru"><br/>
        <input value="{{ old('name_am') }}" type="text" class="form-control" placeholder="Armenian Name" name="name_am"><br/>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Position</label>
        <input value="{{ old('position') }}" type="text" class="form-control" placeholder="English Position" name="position"><br/>
        <input value="{{ old('position_ru') }}" type="text" class="form-control" placeholder="Russian Position" name="position_ru"><br/>
        <input value="{{ old('position_am') }}" type="text" class="form-control" placeholder="Armenian Position" name="position_am"><br/> 
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Place Number</label>
        <input value="{{ old('place_number') }}" type="number" class="form-control" placeholder="Place Number" name="place_number">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Photo</label>
        <input value="{{ old('photo') }}" type="file" class="form-control" name="photo" accept="image/png, image/jpeg">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">CV</label>
        <input value="{{ old('cv') }}" type="file" class="form-control" name="cv" accept="application/pdf">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Background Color</label>
        <select class="form-control" name="background_color">
          <option>Royal</option>
          <option>Aqua</option>
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

<script src="js/courses/courses_reg.js"></script>
<script src="js/courses/courses_validation.js"></script>
@include('admin.scripts.admin')

@endsection

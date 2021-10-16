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
            <h1 class="m-0 text-dark">Team Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Team Edit</li>
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
  <form method="POST" enctype="multipart/form-data" action="{{ route('team.update') }}">
    @csrf
    <div class="card-body">
      <input value="{{ $team->id }}" type="hidden" class="form-control" name="id">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input value="{{ old('name',$team->name) }}" type="text" class="form-control" name="name"><br>
        <input value="{{ old('name_ru',$team->name_ru) }}" type="text" class="form-control" name="name_ru"><br>
        <input value="{{ old('name_am',$team->name_am) }}" type="text" class="form-control" name="name_am"><br>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Position</label>
        <input value="{{ old('position',$team->position) }}" type="text" class="form-control" placeholder="English Position" name="position"><br>
        <input value="{{ old('position_ru',$team->position_ru) }}" type="text" class="form-control" placeholder="Russian Position" name="position_ru"><br>
        <input value="{{ old('position_am',$team->position_am) }}" type="text" class="form-control" placeholder="Armenian Position" name="position_am"><br> 
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Place Number</label>
        <input value="{{ old('place_number',$team->place_number) }}" type="number" class="form-control" placeholder="Place Number" name="place_number">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Photo</label><br>
        <img width="130px" height="auto" src='{{ asset("uploads/team/photo/$team->id/$team->photo") }}'><br>
        <input type="file" class="form-control" name="photo" id="cv">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">CV</label><br>
        <a class="btn btn-sm btn-success" href='{{ asset("uploads/team/photo/$team->id/$team->photo") }}'>{{ $team->cv }}</a><br>
        <input type="file" class="form-control" name="cv">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Background Color</label>
        <select class="form-control" name="background_color">
          <option {{ ($team->value=="Royal") ? "selected" : "" }}>Royal</option>
          <option {{ ($team->value=="Aqua") ? "selected" : "" }}>Aqua</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>

@endsection

@section('scripts')

<script src="js/courses/courses_reg.js"></script>
<script src="js/courses/courses_validation.js"></script>
@include('admin.scripts.teams')

@endsection

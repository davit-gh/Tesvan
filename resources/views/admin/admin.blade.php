@extends("layouts.admin")

@section('styles')


@endsection

@section('content')

<div class="card card-primary">
  <form>
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Project Name</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Project Name">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Project Logo</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text">Upload</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Project Overview</label>
        <textarea class="form-control" id="exampleInputEmail1"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Objective</label>
        <textarea class="form-control" id="exampleInputEmail1"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Our Solution</label>
        <textarea class="form-control" id="exampleInputEmail1"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Result</label>
        <textarea class="form-control" id="exampleInputEmail1"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Technology We Used</label>
        <textarea class="form-control" id="exampleInputEmail1"></textarea>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
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


@endsection

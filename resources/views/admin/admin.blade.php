@extends("layouts.admin")

@section('styles')


@endsection

@section('content')

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
  <form method="POST" enctype="multipart/form-data" action="{{ route('project.store') }}">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Project Name</label>
        <input value="{{ old('project_name') }}" type="text" class="form-control" placeholder="Project Name" name="project_name"> 
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Project Logo</label>
        <input value="{{ old('project_logo') }}" type="file" class="form-control" name="project_logo">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Project Overview</label>
        <textarea class="form-control" name="project_overview">{{ old('project_overview') }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Objective</label>
        <textarea class="form-control" name="project_objective_desc">{{ old('project_objective_desc') }}</textarea>
        <div class="objective-container container col-md-6 pull-right">
          <div class="form-group">
            <label for="exampleInputEmail1">Objective</label>
              <input value="{{ old('project_objective.0') }}" class="form-control" type="text" name="project_objective[]">
          </div>
          <div class="form-group" id="objective-action">
            <button class="btn btn-primary btn-sm addMoreObjective">Add More</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Challenge</label>
        <textarea class="form-control" name="project_challenge">{{ old('project_challenge') }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Our Solution</label>
        <textarea class="form-control" name="project_solution">{{ old('project_solution') }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Result</label>
        <textarea class="form-control" name="project_result_desc">{{ old('project_result_desc') }}</textarea>
        <div class="result-container container col-md-6 pull-right">
          <div class="form-group">
            <label for="exampleInputEmail1">Result</label>  
            <input value="{{ old('project_result.0') }}" class="form-control" type="text" name="project_result[]">
          </div>
          <div class="form-group" id="result-action">
            <button class="btn btn-primary btn-sm addMoreResult">Add More</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Technology We Used</label>
        <textarea class="form-control" name="project_twu_desc">{{ old('project_twu_desc') }}</textarea>
        <div class="twu-container container col-md-6 pull-right">
          <div id="twu-container-field">
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
               <input value="{{ old('project_twu_name.0') }}" class="form-control" type="text" name="project_twu_name[]">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Logo</label>
               <input class="form-control" type="file" name="project_twu_logo[]">
            </div>
          </div>
          <div class="form-group" id="twu-action">
            <button class="btn btn-primary btn-sm addMoreTwu">Add More</button>
            <button class="btn btn-danger btn-sm rmTwu">Remove</button>
          </div>
        </div>
      </div>
      <div class="form-group">
      <hr>
        <label for="exampleInputEmail1">Client Feedback</label>
        <textarea class="form-control" name="project_cf_desc">{{ old('project_cf_desc') }}</textarea>
        <div class="cf-container container col-md-6 pull-right">
          <div class="form-group">
            <label for="exampleInputEmail1">Client Feedback</label>
            <textarea class="form-control" name="project_cf_feedback[]">{{ old('project_cf_feedback.0') }}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Client Name</label>
            <input value="{{ old('project_cf_name.0') }}" class="form-control" type="text" name="project_cf_name[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Client Photo</label>
             <input class="form-control" type="file" name="project_cf_photo[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Client Website</label>
            <input value="{{ old('project_cf_website.0') }}" class="form-control" type="text" name="project_cf_website[]">
          </div>
          <div class="form-group" id="cf-action">
            <button class="btn btn-primary btn-sm addMoreCF">Add More</button>
            <button class="btn btn-danger btn-sm rmCf">Remove</button>
          </div>
        </div>
        <hr>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Other Cases</label>
        <textarea class="form-control" name="other_cases">{{ old('other_cases') }}</textarea>
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

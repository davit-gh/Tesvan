@extends("layouts.admin")

@section('styles')


@endsection

@section('content')

<style type="text/css">
  .hidden{
    display: none;
  }
</style>

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
  <form method="POST" enctype="multipart/form-data" action="{{ route('project.update') }}">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Project Name</label>
        <input value="{{ $project->id }}" type="hidden" class="form-control" name="id">
        <input value="{{ old('project_name',$project->project_name) }}" type="text" class="form-control" name="project_name"> 
      </div>
      <div class="form-group">
        <label for="exampleInputFile">Project Logo</label>
        <input type="file" class="form-control" name="project_logo">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Project Overview</label>
        <textarea class="form-control" name="project_overview">{{ old('project_overview',$project->project_overview) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Objective</label>
        <textarea class="form-control" name="project_objective_desc">{{ old('project_objective_desc',$project->project_objective_desc) }}</textarea>
        <div class="objective-container container col-md-6 pull-right">
          @if (count($project_objective)>0)
            @foreach($project_objective as $key => $po)
                @if($key>0)
                <div class="form-group">
                  <label for="exampleInputEmail1">Objective</label>
                  <div class="input-group">
                    <input class="form-control" value="{{ $po->id }}" type="hidden" name="project_objective_id[]">
                    <input value="{{ old('project_objective.0',$po->objective) }}" class="form-control" type="text" name="project_objective[]">
                    <div class="input-group-prepend">
                      <button data-id="{{ $po->id }}" class="rmObjective btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                    </div>
                  </div>
                </div>
                @else
                    <div class="form-group">
                      <label for="exampleInputEmail1">Objective</label>
                       <input class="form-control" value="{{ $po->id }}" type="hidden" name="project_objective_id[]">
                       <input class="form-control" value="{{ old('project_objective.0',$po->objective) }}" type="text" name="project_objective[]">
                    </div>
                @endif
            @endforeach
          @endif
          <div class="form-group" id="objective-action">
            <button class="btn btn-primary btn-sm addMoreObjective">Add More</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Challenge</label>
        <textarea class="form-control" name="project_challenge">{{ old('project_challenge',$project->project_challenge) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Our Solution</label>
        <textarea class="form-control" name="project_solution">{{ old('project_solution',$project->project_solution) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Result</label>
        <textarea class="form-control" name="project_result_desc">{{ $project->project_result_desc }}</textarea>
        <div class="result-container container col-md-6 pull-right">
          @if (count($project_result)>0)
            @foreach($project_result as $key => $pr)
              <div class="form-group">
                <label for="exampleInputEmail1">Result</label>
                <div class="input-group">
                  <input class="form-control" value="{{ $pr->id }}" type="hidden" name="project_result_id[]">
                  <input value="{{ old('project_result.0',$pr->result) }}" class="form-control" type="text" name="project_result[]">
                  <div class="input-group-prepend">
                    <button data-id="{{ $pr->id }}" class="rmResult btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                  </div>
                </div>
              </div>  
            @endforeach
          @else
              <div class="form-group">
                <label for="exampleInputEmail1">Result</label>
                 <input class="form-control" type="text" name="project_result[]">
              </div>
          @endif
          <div class="form-group" id="result-action">
            <button class="btn btn-primary btn-sm addMoreResult">Add More</button>
          </div>
        </div>
      </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Technology We Used</label>
            <textarea class="form-control hidden" name="project_twu_desc">{{ $project->project_twu_desc }}</textarea>
            <div class="twu-container container col-md-6 pull-right">
              @if (count($technology_tool)>0)
                @foreach($technology_tool as $key => $t)
                      <div id="twu-container-field">
                        <div class="form-group hidden">
                          <label for="exampleInputEmail1">Name</label>
                          <input class="form-control" value="{{ old('project_twu_id.0',$t->id) }}" type="hidden" name="project_twu_id[]">
                           <input class="form-control" value="{{ old('project_twu_name.0',$t->name) }}" type="text" name="project_twu_name[]">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Logo</label>
                           <input class="form-control" value="{{ $t->logo }}" type="file" name="project_twu_logo[]">
                        </div>
                      </div>
                @endforeach
                @else
                      <div class="form-group hidden">
                        <label for="exampleInputEmail1">Name</label>
                         <input class="form-control" value="{{ old('project_twu_name.0') }}" type="text" name="project_twu_name[]">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Logo</label>
                         <input class="form-control" type="file" name="project_twu_logo[]">
                      </div>
              @endif
              <div class="form-group" id="twu-action">
                <button class="btn btn-primary btn-sm addMoreTwu">Add More</button>
                <button data-id="{{ $project->id }}" class="btn btn-danger btn-sm rmTwu">Remove</button>
              </div>
            </div>
          </div>
      <div class="form-group">
      <hr>
        <label for="exampleInputEmail1">Client Feedback</label>
        <textarea class="form-control hidden" name="project_cf_desc">{{ old('project_cf_desc',$project->project_cf_desc) }}</textarea>
        <div class="cf-container container col-md-6 pull-right">
          @if (count($client_feedback)>0)
            @foreach($client_feedback as $key => $cf)
              <div id="cf-container-gen">
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Feedback</label>
                  <input class="form-control" value="{{ $cf->id }}" type="hidden" name="project_cf_id[]">
                  <textarea class="form-control" name="project_cf_feedback[]">{{ old('project_cf_feedback',$cf->client_feedback) }}</textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Name</label>
                  <input class="form-control" value="{{ old('project_cf_name.0',$cf->client_name) }}" type="text" name="project_cf_name[]">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Photo</label>
                   <input class="form-control" value="{{ $cf->client_photo }}" type="file" name="project_cf_photo[]">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Website</label>
                  <input class="form-control" value="{{ old('project_cf_website.0',$cf->client_website) }}" type="text" name="project_cf_website[]">
                </div>
              </div>
            @endforeach
          @else
          <div id="cf-container-gen">
            <div class="form-group">
                <label for="exampleInputEmail1">Client Feedback</label>
                <textarea class="form-control" name="project_cf_feedback[]">{{ old('project_cf_feedback') }}</textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Client Name</label>
                <input class="form-control" value="{{ old('project_cf_name.0') }}" type="text" name="project_cf_name[]">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Client Photo</label>
                 <input class="form-control" type="file" name="project_cf_photo[]">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Client Website</label>
                <input class="form-control" value="{{ old('project_cf_website.0') }}" type="text" name="project_cf_website[]">
              </div>
            </div>
          @endif
          <div class="form-group" id="cf-action">
            <button class="btn btn-primary btn-sm addMoreCF">Add More</button>
            <button data-id="{{ $project->id }}" class="btn btn-danger btn-sm rmCf">Remove</button>
          </div>
        </div>
        <hr>
      </div>

      <div class="form-group hidden">
        <label for="exampleInputEmail1">Other Cases</label>
        <textarea class="form-control" name="other_cases">{{ old('other_cases',$project->other_case) }}</textarea>
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

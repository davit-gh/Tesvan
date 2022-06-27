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
            <h1 class="m-0 text-dark">Project Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Project Edit</li>
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
  <form method="POST" enctype="multipart/form-data" action="{{ route('project.update') }}">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Project Name</label>
        <input value="{{ $project->id }}" type="hidden" class="form-control" name="id">
        <input value="{{ old('project_name',$project->project_name) }}" type="text" class="form-control" name="project_name">
      </div>
      <div class="form-group">
              <label for="exampleInputEmail1">URL Slug</label>
              <input value="{{ old('url_slug',$project->url_slug) }}" type="text" class="form-control" placeholder="URL Slug" name="url_slug">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Meta Title</label>
              <input value="{{ old('meta_title',$project->meta_title) }}" type="text" class="form-control" placeholder="Meta Title" name="meta_title">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Meta Description</label>
              <textarea class="form-control" name="meta_description">{{ old('meta_description', $project->meta_description) }}</textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Meta Description (in Armenian)</label>
              <textarea class="form-control" name="meta_description_am">{{ old('meta_description_am', $project->meta_description_am) }}</textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Meta Description (in Russian)</label>
              <textarea class="form-control" name="meta_description_ru">{{ old('meta_description_ru', $project->meta_description_ru) }}</textarea>
            </div>
      <div class="form-group">
        <label for="exampleInputFile">Project Logo</label>
        <input type="file" class="form-control" name="project_logo">
      </div>
      <div class="form-group col-md-6 container" >
        <label for="exampleInputFile">Alternative Description</label>
        <input value="{{ old('project_logo_alt_description', $project->project_logo_alt_description) }}" type="text" class="form-control" name="project_logo_alt_description">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Project Overview</label>
        <textarea class="form-control" name="project_overview">{{ old('project_overview',$project->project_overview) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Project Overview (in Armenian)</label>
        <textarea class="form-control" name="project_overview_am">{{ old('project_overview_am',$project->project_overview_am) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Project Overview (in Russian)</label>
        <textarea class="form-control" name="project_overview_ru">{{ old('project_overview_ru',$project->project_overview_ru) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Objective</label>
        <textarea class="form-control" name="project_objective_desc">{{ old('project_objective_desc',$project->project_objective_desc) }}</textarea>
        <div class="objective-container container col-md-6 pull-right">
          @if (count($project_objective)>0)
            @foreach($project_objective as $key => $po)
                @if($key>0)
                <div id="objective-container-field-gen">
                <div class="form-group">
                  <label for="exampleInputEmail1">Objective</label>
                    <input class="form-control" value="{{ $po->id }}" type="hidden" name="project_objective_id[]">
                    <input value="{{ old('project_objective.0',$po->objective) }}" class="form-control" type="text" name="project_objective[]">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Objective (in Armenian)</label>
                    <input value="{{ old('project_objective_am.0',$po->objective_am) }}" class="form-control" type="text" name="project_objective_am[]">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Objective (in Russian)</label>
                    <input value="{{ old('project_objective_ru.0',$po->objective_ru) }}" class="form-control" type="text" name="project_objective_ru[]">
                </div>
                <div class="form-group input-group-prepend">
                   <button data-id="{{ $po->id }}" class="rmObjective btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                </div>
                </div>
                @else
                    <div class="form-group">
                      <label for="exampleInputEmail1">Objective</label>
                       <input class="form-control" value="{{ $po->id }}" type="hidden" name="project_objective_id[]">
                       <input class="form-control" value="{{ old('project_objective.0',$po->objective) }}" type="text" name="project_objective[]">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Objective (in Armenian)</label>
                       <input class="form-control" value="{{ old('project_objective_am.0',$po->objective_am) }}" type="text" name="project_objective_am[]">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Objective (in Russian)</label>
                       <input class="form-control" value="{{ old('project_objective_ru.0',$po->objective_ru) }}" type="text" name="project_objective_ru[]">
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
        <label for="exampleInputEmail1">Challenge (in Armenian)</label>
        <textarea class="form-control" name="project_challenge_am">{{ old('project_challenge_am',$project->project_challenge_am) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Challenge (in Russian)</label>
        <textarea class="form-control" name="project_challenge_ru">{{ old('project_challenge_ru',$project->project_challenge_ru) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Our Solution</label>
        <textarea class="form-control" name="project_solution">{{ old('project_solution',$project->project_solution) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Our Solution (in Armenian)</label>
        <textarea class="form-control" name="project_solution_am">{{ old('project_solution_am',$project->project_solution_am) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Our Solution (in Russian)</label>
        <textarea class="form-control" name="project_solution_ru">{{ old('project_solution_ru',$project->project_solution_ru) }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Result</label>
        <textarea class="form-control" name="project_result_desc">{{ $project->project_result_desc }}</textarea>
        <label for="exampleInputEmail1">Result (in Armenian)</label>
        <textarea class="form-control" name="project_result_desc_am">{{ $project->project_result_desc_am }}</textarea>
        <label for="exampleInputEmail1">Result (in Russian)</label>
        <textarea class="form-control" name="project_result_desc_ru">{{ $project->project_result_desc_ru }}</textarea>
        <div class="result-container container col-md-6 pull-right">
          @if (count($project_result)>0)
            @foreach($project_result as $key => $pr)
              <div id="result-container-field-gen">
              <div class="form-group">
                <label for="exampleInputEmail1">Result</label>
                  <input class="form-control" value="{{ $pr->id }}" type="hidden" name="project_result_id[]">
                  <input value="{{ old('project_result.0',$pr->result) }}" class="form-control" type="text" name="project_result[]">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Result (in Armenian)</label>
                  <input value="{{ old('project_result_am.0',$pr->result_am) }}" class="form-control" type="text" name="project_result_am[]">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Result (in Russian)</label>
                  <input value="{{ old('project_result_ru.0',$pr->result_ru) }}" class="form-control" type="text" name="project_result_ru[]">
              </div>
              <div class="form-group input-group-prepend">
                <button data-id="{{ $pr->id }}" class="rmResult btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
              </div>
              </div>
            @endforeach
          @else
              <div class="form-group">
                <label for="exampleInputEmail1">Result</label>
                 <input class="form-control" type="text" name="project_result[]">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Result (in Armenian)</label>
                 <input class="form-control" type="text" name="project_result_am[]">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Result (in Russian)</label>
                 <input class="form-control" type="text" name="project_result_ru[]">
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
                      <div id="twu-container-field-gen">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Logo</label>
                           <input class="form-control" value="{{ old('project_twu_id.0',$t->id) }}" type="hidden" name="project_twu_id[]">
                           <input class="form-control" value="{{ $t->logo }}" type="file" name="project_twu_logo[]">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                           <input class="form-control" value="{{ old('project_twu_name.0',$t->name) }}" type="text" name="project_twu_name[]">
                        </div>
                      </div>
                @endforeach
                @else
                      <div class="form-group">
                        <label for="exampleInputEmail1">Logo</label>
                         <input class="form-control" type="file" name="project_twu_logo[]">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                         <input class="form-control" value="{{ old('project_twu_name.0') }}" type="text" name="project_twu_name[]">
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

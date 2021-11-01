@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/slick-theme.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/slick.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/testiomanials.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/project.css?v={{ strtotime(date('YmdHis')) }}">
<style type="text/css">
    ul.list_project {
      list-style-image: url('/images/project/Ellipse.png');
      line-height: 3;
    }
    .newLine{
        word-wrap: break-word;
    }
    .maxImage {
        max-width: 450px;
    }
    .entry{
        position: relative;
        bottom: 6px;
    }
    ul.list_project {
        line-height: 25px;
    }
    .ability_col{
        margin-bottom: 20px;
    }
</style>

@endsection



@section('content')

<section id="project">
    <div class="container">
        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <img style="height: auto;" src='{{ url("uploads/images/project/logo/$project->id/$project->project_logo") }}' alt="Job" class="job_page_header_svg maxImage">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview">
                    <div class="project-overview-title">
                        {{__("Project Overview")}}
                    </div>
                    <div class="newLine project-overview-description" align="left">
                        {{ $project->project_overview }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-wrap">
            <div class="newLine col-xl-6 col-lg-6 col-md-12 col-sm-12 home_page_col">
                <div class="project-overview-title">
                    {{__("Objectives")}}
                </div>
                <div class="project-overview-description" align="left">
                @if (count($project_objective)>0)
                    @foreach($project_objective as $pr)
                    <div class="ability_col">
                        <img alt="Circle Yellow" src="/images/circle_yellow.svg">
                        <span class="hue_black">
                            {{ $pr->objective }}
                        </span>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <img src={{asset('images/completed-amico.png')}} alt="Job" class="job_page_header_svg maxImage">
            </div>
        </div>

        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="project-overview">
                    <div class="project-overview-title">
                        {{__("Challenge")}}
                    </div>
                    <div class="newLine project-overview-description" align="left">
                        {{ $project->project_challenge }}
                    </div>
                </div>            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview">
                    <div class="project-overview-title">
                        {{__("Our Solution")}}
                    </div>
                    <div class="newLine project-overview-description" align="left">
                        {{ $project->project_solution }}
                    </div>
                </div>
            </div>
        </div>

        @if (count($project_result)>0)
        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="project-overview-title">
                    {{__("Results")}}
                </div>
                <div class="newLine project-overview-description" align="left" style="position: relative;bottom: 30px;">
                    {{ $project->project_result_desc }}
                </div>
            </div>            
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 home_page_col" style="padding: 40px;position: relative;">
                @if (count($project_result)>0)
                    
                        @foreach($project_result as $k => $pr)
                            @if($k >= 4)
                                <div class="ability_col">
                                    <img alt="Circle Yellow" src="/images/circle_yellow.svg">
                                    <span class="hue_black"> {{ $pr->result }}</span>
                                </div>
                            @else
                                <div class="ability_col">
                                    <img width="22px" alt="Circle Yellow" src="/images/results/{{ $k + 1 }}.png">
                                    <span class="hue_black"> {{ $pr->result }}</span>
                                </div>
                            @endif
                        @endforeach
                    
                @endif
                
            </div>
        </div>
        @endif
    </div>
</section>

<div class="clearfix"></div><br><br>


@if (count($technology_tool)>0)
<section id="technology">
    <div class="container">
        <div class="newLine text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Technology We Used")}}</h2>
            <!-- <p class="hue_black newLine">
                
            </p> -->
        </div>
        <div class="tech-used-slider row hire_row">
            @if (count($technology_tool)>0)
                @foreach($technology_tool as $tt)
                    <div class="col-md-3" style="padding: 20px;">
                        <img style="max-height: 110px;" width="auto" class="img-responsive" src='{{ url("uploads/images/project/twu/$tt->project_id/$tt->logo") }}'>
                    </div>
                @endforeach
            @endif
        </div>
</section>
@endif

@if (count($client_feedback)>0)
<section id="clientfeedback" style="padding-top: 40px;">
    <div class="container">
        <div class="testmonail_container">
            <div class="text-center testiomanials_heder_txt_col">
                <h2 class="hue_blue">{{__("Client Feedback")}}</h2>
                <!-- <p class="hue_black"></p> -->
            </div>
            <div class="testimonials-slider" align="center">
                        @foreach($client_feedback as $key => $cf)

                            <div class="testimonials_row" style="margin-left:40px;">
                                <p class="hue_black newLine">
                                    {{ $cf->client_feedback }}
                                </p>
                                <div class="testimonials_svg_txt_row">
                                    <img style="max-height: 110px;" class="rounded-circle" width="auto" src='{{ url("uploads/images/project/cf/$cf->project_id/$cf->client_photo") }}'/>
                                    <h4 class="hue_blue newLine">{{ $cf->client_name }}</h4>
                                    <p class="hue_black newLine">{{ $cf->client_website }}</p>
                                </div>
                            </div>
                       
                        @endforeach
            </div>
        </div>
    </div>
</section>
@endif



<section id="job_hire" class="project-management" style="padding-top: 40px;">
    <div class="container">
        <div class="text-center job_hire_text_col newLine">
            <h2 class="hue_blue">{{__("Other Cases")}}</h2>
            <!-- <p class="hue_black">
                
            </p> -->
        </div>

        <div class='row hire_row {{ (count($related)>2) ? "other-cases-slider" : "" }}'>
            @if (count($related)>0)
                @foreach($related as $key => $r)
                    @php 
                        $project_name[$key] = strtolower(preg_replace('/\s+/', '-', $r->project_name));
                    @endphp
                    <div class="col-md-4">
                        <a href="{{ route('project.detail',['project_name'=>$project_name[$key]]) }}">
                            <div class="rectangle" >
                                <img class="img-entry" src='{{ url("uploads/images/project/logo/$r->id/$r->project_logo") }}'>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
</section>

@endsection

@section('scripts')

<script src="/js/blockRotate.js?v={{ strtotime(date('YmdHis')) }}"></script>
<script src="/js/slick.js?v={{ strtotime(date('YmdHis')) }}"></script>
<script src="/js/slick.min.js?v={{ strtotime(date('YmdHis')) }}"></script>
<script src="/js/customSlick.js?v={{ strtotime(date('YmdHis')) }}"></script>

@endsection
@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/slick-theme.css">
<link rel="stylesheet" type="text/css" href="/css/slick.css">
<link rel="stylesheet" type="text/css" href="/css/testiomanials.css">
<link rel="stylesheet" type="text/css" href="/css/project.css">
<style type="text/css">
    ul.list_project {
      list-style-image: url('/images/project/Ellipse.png');
      line-height: 3;
    }
    .newLine{
        word-wrap: break-word;
    }
    .maxImage {
        max-height:470px;
    }
    .entry{
        position: relative;
        bottom: 5px;
    }
</style>

@endsection



@section('content')

<section id="project">
    <div class="container">
        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <img src={{asset('images/why_we.png')}} alt="Job" class="job_page_header_svg maxImage">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview">
                    <div class="project-overview-title">
                        Projects Overview
                    </div>
                    <div class="newLine project-overview-description" align="left">
                        {{ $project->project_overview }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-wrap">
            <div class="newLine col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview-title">
                    Objectives
                </div>
                <div class="project-overview-description" align="left">
                @if (count($project_objective)>0)
                    <ul class="list_project" align="left">
                        @foreach($project_objective as $pr)
                            <li><span class="entry">{{ $pr->objective }}</span></li>
                        @endforeach
                    </ul>
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
                        Challenge
                    </div>
                    <div class="newLine project-overview-description" align="left">
                        {{ $project->project_challenge }}
                    </div>
                </div>            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview">
                    <div class="project-overview-title">
                        Our Solution
                    </div>
                    <div class="newLine project-overview-description" align="left">
                        {{ $project->project_solution }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="project-overview-title">
                    Result
                </div>
                <div class="newLine project-overview-description" align="left">
                    {{ $project->project_result_desc }}
                </div>
            </div>            
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col" style="padding: 40px;">
                @if (count($project_result)>0)
                    <ul class="newLine list_project" align="left">
                        @foreach($project_result as $pr)
                            <li><span class="entry">{{ $pr->result }}</span></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>





<section id="technology">
    <div class="container">
        <div class="newLine text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Technology We Used")}}</h2>
            <p class="hue_black newLine">
                {{ $project->project_twu_desc }}
            </p>
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


<section id="clientfeedback" style="padding-top: 40px;">
    <div class="container">
        <div class="testmonail_container">
            <div class="text-center testiomanials_heder_txt_col">
                <h2 class="hue_blue">Client Feedback</h2>
                <p class="hue_black">{{ $project->project_cf_desc }}</p>
            </div>
            <div class="testimonials-slider" align="center">
                    @if (count($client_feedback)>0)
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
                    @endif
            </div>
        </div>
    </div>
</section>



<section id="job_hire" class="project-management" style="padding-top: 40px;">
    <div class="container">
        <div class="text-center job_hire_text_col newLine">
            <h2 class="hue_blue">{{__("Other Cases")}}</h2>
            <p class="hue_black">
                {{ $project->other_case }}
            </p>
        </div>

        <div class="row hire_row other-cases-slider">
            @if (count($related)>0)
                @foreach($related as $r)
                    <div class="col-md-4">
                        <a href="{{ route('project.detail',['id'=>$r->id]) }}">
                            <div class="rectangle" >
                                <div class="image-entry">
                                    <img style="max-height: 130px;" width="100%" src='{{ url("uploads/images/project/logo/$r->id/$r->project_logo") }}'>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
</section>

@endsection

@section('scripts')

<script src="/js/blockRotate.js"></script>
<script src="/js/slick.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/customSlick.js"></script>

@endsection
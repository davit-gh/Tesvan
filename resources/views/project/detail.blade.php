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
</style>

@endsection



@section('content')

<section id="project">
    <div class="container">
        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <img src={{asset('images/why_we.png')}} alt="Job" class="job_page_header_svg">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview">
                    <div class="project-overview-title">
                        Projects Overview
                    </div>
                    <div class="project-overview-description" align="left">
                        {{ $project->project_overview }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-wrap">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview-title">
                    Objectives
                </div>
                <div class="project-overview-description" align="left">
                @if (count($project_objective)>0)
                    <ul class="list_project" align="left">
                        @foreach($project_objective as $pr)
                            <li>{{ $pr->objective }}</li>
                        @endforeach
                    </ul>
                @endif
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <img src={{asset('images/completed-amico.png')}} alt="Job" class="job_page_header_svg">
            </div>
        </div>

        <div class="row flex-wrap" style="padding: 40px;">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="project-overview">
                    <div class="project-overview-title">
                        Challenge
                    </div>
                    <div class="project-overview-description" align="left">
                        {{ $project->project_challenge }}
                    </div>
                </div>            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col">
                <div class="project-overview">
                    <div class="project-overview-title">
                        Our Solution
                    </div>
                    <div class="project-overview-description" align="left">
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
                <div class="project-overview-description" align="left">
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.
                </div>
            </div>            
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center home_page_col" style="padding: 40px;">
                @if (count($project_result)>0)
                    <ul class="list_project" align="left">
                        @foreach($project_result as $pr)
                            <li>{{ $pr->result }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>





<section id="technology">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Technology We Used")}}</h2>
            <p class="hue_black">
                {{__("Lorem Ipsum is simply dummy text of the printing and typesetting industry.")}}
            </p>
        </div>
        <div class="row hire_row">
            @if (count($technology_tool)>0)
                @foreach($technology_tool as $tt)
                    <div class="col-md-3" style="padding: 20px;">
                        <img height="auto" width="100%" class="img-responsive" src='{{ url("uploads/images/project/twu/$tt->project_id/$tt->logo") }}'>
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
                <p class="hue_black">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            </div>
            <div class="testimonials-slider mb-4 slick-initialized slick-slider slick-dotted"><button class="slick-prev slick-arrow slick-disabled" aria-label="Previous" type="button" aria-disabled="true" style="">Previous</button>
                <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 1480px; transform: translate3d(0px, 0px, 0px);">
                @if (count($client_feedback)>0)
                    @foreach($client_feedback as $cf)
                    
                        <div class="testimonials-single text-center slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 370px;">
                            <div class="testimonials_row">
                                <p class="hue_black">
                                    {{ $cf->client_feedback }}
                                </p>
                                <div class="testimonials_svg_txt_row">
                                    <img class="rounded-circle" width="100%" src='{{ url("uploads/images/project/cf/$cf->project_id/$cf->client_photo") }}'/>
                                    <h4 class="hue_blue">{{ $cf->client_name }}</h4>
                                    <p class="hue_black">{{ $cf->client_website }}</p>
                                </div>
                            </div>
                        </div>
                   
                    @endforeach
                @endif
             </div>
            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="" aria-disabled="false">Next</button><ul class="slick-dots" style=""><li class="slick-active"><button type="button">1</button></li><li><button type="button">2</button></li></ul></div>
        </div>
    </div>
</section>



<section id="job_hire" class="project-management">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Other Cases")}}</h2>
            <p class="hue_black">
                {{__("Lorem Ipsum is simply dummy text of the printing and typesetting industry.")}}
            </p>
        </div>

        <div class="row hire_row">
            @if (count($related)>0)
                @foreach($related as $r)
                    <div class="col-md-4">
                        <a href="{{ route('project.detail',['id'=>$r->id]) }}">
                            <div class="rectangle" >
                                <div class="image-entry">
                                    <img src='{{ url("uploads/images/project/logo/$r->id/$r->project_logo") }}'>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
</section>

@endsection
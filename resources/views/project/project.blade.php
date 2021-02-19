@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/project.css">

@endsection



@section('content')

<section id="job_hire" class="project-management">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Projects")}}</h2>
            <p class="hue_black">
                {{__("Lorem Ipsum is simply dummy text of the printing and typesetting industry.")}}
            </p>
        </div>

        <div class="row hire_row">

            <div class="col-md-4">
                <div class="rectangle" >
                    <div class="image-entry">
                       <img src="{{ url('images/project/logo-orange.png') }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rectangle" >
                    <div class="image-entry">
                        <img src="{{ url('images/project/cropped-small-transparent-foldink.png') }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rectangle">
                    <div class="image-entry">
                        <img src="{{ url('images/project/globalam.png') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row hire_row">

            <div class="col-md-4">
                <div class="rectangle">
                    <div class="image-entry">
                        <img src="{{ url('images/project/DISQO_Logo_Black_1600x400-01_pp3383007637088364882935894.png') }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rectangle" >
                    <div class="image-entry">
                        <img src="{{ url('images/project/globalam.png') }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rectangle" >
                    <div class="image-entry">
                        <img src="{{ url('images/project/cropped-small-transparent-foldink.png') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row hire_row">
            <div class="col-md-4">
                <div class="rectangle">
                    <div class="image-entry">
                        <img src="{{ url('images/project/globalam.png') }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rectangle" >
                    <div class="image-entry">
                        <img src="{{ url('images/project/cropped-small-transparent-foldink.png') }}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rectangle" >
                    <div class="image-entry">
                        <img src="{{ url('images/project/logo-orange.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="text-center job_hire_text_col" style="padding: 49px;">
            <div class="custom-btn">
                <a href="#">Show More</a>
            </div>
        </div>
    </div>
</section>



@endsection

@section('scripts')



@endsection

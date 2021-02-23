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

            @if (count($project)>0)
                @foreach($project as $p)
                    <div class="col-md-4" style="padding: 40px;">
                        <a href="{{ route('project.detail',['id'=>$p->id]) }}">
                            <div class="rectangle" >
                                <div class="image-entry">
                                    <img height="auto" width="100%" src='{{ url("uploads/images/project/logo/$p->id/$p->project_logo") }}'>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif

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

<script src="{{ url('js/blockRotate.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/slick.min.js') }}"></script>
<script src="{{ url('js/map.js') }}"></script>
<script src="{{ url('js/customSlick.js') }}"></script>

@endsection

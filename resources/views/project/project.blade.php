@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/project.css?v={{ strtotime(date('YmdHis')) }}">

@endsection



@section('content')

<section id="job_hire" class="project-management">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Projects")}}</h2>
        </div>

        <div class="row hire_row container-content">

            @if (count($project)>0)
                @foreach($project as $key => $p)
                    @php 
                        $project_name[$key] = strtolower(preg_replace('/\s+/', '-', $p->project_name));
                    @endphp
                    @if ($key>=6)
                    <div class="col-md-4" style="padding: 40px; display: none;" id="tab{{ $key }}">
                        <a href="{{ route('project.detail',['project_name'=>$project_name[$key]]) }}">
                            <div class="rectangle" >
                                    <img class="lozad img-entry" style="max-height: 130px;" width="auto" src='{{ url("uploads/images/project/logo/$p->id/$p->project_logo") }}'>
                                
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="col-md-4 showElement" style="padding: 40px;" id="tab{{ $key }}">
                        <a href="{{ route('project.detail',['project_name'=>$project_name[$key]]) }}">
                            <div class="rectangle" >
                                
                                    <img class="lozad img-entry" src='{{ url("uploads/images/project/logo/$p->id/resize_$p->project_logo") }}'>
                                
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
            @endif

        </div>
    </div>

    @if (count($project)>6)
    <div class="container showMoreContainer">
        <div class="text-center job_hire_text_col" style="padding: 49px;">
            <div class="custom-btn">
                <a id="showMore" href="#">Show More</a>
            </div>
        </div>
    </div>
    @endif
</section>



@endsection

@section('scripts')

<script src="{{ url('js/blockRotate.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/slick.min.js') }}"></script>
<script src="{{ url('js/customSlick.js') }}"></script>

<script type="text/javascript">
    $(document).on("click","#showMore",function(e){
        e.preventDefault();
        showNext = 6;
        showElement = $(".showElement").length;
        totalDb = Number("{{ count($project) }}");
        total = showNext + showElement;
        for (var i = showElement; i < total; i++) {
             $("#tab"+i).show();
             $("#tab"+i).addClass("showElement");
             if (i==totalDb){
                $(".showMoreContainer").hide();
             }
        } 
    });
</script>

@endsection



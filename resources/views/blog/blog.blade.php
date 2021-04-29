@extends("layouts.app")

@section('styles')
<link rel="stylesheet" type="text/css" href="/css/blog.css?v={{ strtotime(date('YmdHis')) }}">
@endsection

<style type="text/css">
    .qa_txt_blocks{
        cursor: pointer;
    }
</style>

@section('content')

<section id="job_hire" class="project-management" style="word-wrap: break-word;">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Blog")}}</h2>
        </div>

        <div class="row hire_row container-content">

            
        </div>

        <div class="row">
            @if (count($blog)>0)
                @foreach($blog as $key => $b)
                    @if ($key==0)
                    <div class="col-xl-7 col-lg-7 col-md-12" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
                        <div class="qa_txt_blocks">
                            <img style="max-height: 250px;max-width: 635px;" height="auto"  src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
                                <br><br>
                            <div class="qa_txt_single_blok">
                                <h5 class="hue_blue">{{ $b->title }}</h5>
                                <p>
                                    <small>
                                        {{ date("M d, Y", strtotime($b->published_date)) }}
                                    </small>
                                </p>
                                <p class="hue_black">
                                    {{ limitWord(strip_tags($b->description)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                    <div class="col-xl-5 col-lg-5 col-md-12" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
                        @foreach($blog as $key => $b)
                            @if ($key>0)
                            <div class="qa_txt_blocks">
                                <div class="qa_txt_single_blok"  style="margin-bottom: 10px; !important">
                                    <h5 class="hue_blue">{{ $b->title }}</h5>
                                    <p>
                                        <small>
                                            {{ date("M d, Y", strtotime($b->published_date)) }}
                                        </small>
                                    </p>
                                    <p class="hue_black">
                                        By {{ $b->user->name }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
            @endif
        </div>

        @if (count($blog_popular)>0)
        <div class="job_hire_text_col">
            <h2 class="hue_blue">{{__("Popular Post")}}</h2>
        </div><br><br>

        <div class="row">
            @foreach($blog_popular as $key => $b)
            <div class="col-xl-4 col-lg-4 col-md-12" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
                <div class="qa_txt_blocks">
                    <img style="max-height: 250px;" height="auto" width="100%" src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
                    <div class="qa_txt_single_blok">
                        <h5 class="hue_blue">{{ $b->title }}</h5>
                        <p>
                            <small>
                                {{ date("M d, Y", strtotime($b->published_date)) }}
                            </small>
                        </p>
                        <p class="hue_black">
                            {{ limitWord(strip_tags($b->description)) }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if (count($blog_recent)>0)
        <div class="job_hire_text_col">
            <h2 class="hue_blue">{{__("Recent Post")}}</h2>
        </div><br><br>

        <div class="row">
            @foreach($blog_recent as $key => $b)
            @if ($key>=6)
                <div class="col-xl-4 col-lg-4 col-md-12" style="display: none;" id="tab{{ $key }}" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
                    <div class="qa_txt_blocks">
                        <img style="max-height: 250px;" height="auto" width="100%" src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
                            <div class="qa_txt_single_blok">
                            <h5 class="hue_blue">{{ $b->title }}</h5>
                            <p>
                                <small>
                                    {{ date("M d, Y", strtotime($b->published_date)) }}
                                </small>
                            </p>
                            <p class="hue_black">
                                {{ limitWord(strip_tags($b->description)) }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-xl-4 col-lg-4 col-md-12 showElement" id="tab{{ $key }}" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
                    <div class="qa_txt_blocks">
                        <img style="max-height: 250px;" height="auto" width="100%" src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
                            <div class="qa_txt_single_blok">
                            <h5 class="hue_blue">{{ $b->title }}</h5>
                            <p>
                                <small>
                                    {{ date("M d, Y", strtotime($b->published_date)) }}
                                </small>
                            </p>
                            <p class="hue_black">
                                {{ limitWord(strip_tags($b->description)) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
        @endif

    </div>


    @if (count($blog_recent)>6)
        <div class="container showMoreContainer">
            <div class="text-center job_hire_text_col" style="padding: 49px;">
                <div class="custom-btn">
                    <a id="showMore" href="#">Load More</a>
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
        totalDb = Number("{{ count($blog_recent) }}");
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



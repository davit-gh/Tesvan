@extends("layouts.app")

@section('styles')
<link rel="stylesheet" type="text/css" href="/css/blog.css?v={{ strtotime(date('YmdHis')) }}">
@endsection

<style type="text/css">
    .qa_txt_blocks{
        cursor: pointer;
    }
    .blog_description{    
        margin-bottom: 40px;
    }
    .bradius{
        border-radius: 12px;
    }
</style>

@section('content')

<section id="job_hire" class="project-management" style="word-wrap: break-word;">
    <div class="container">
        <div class="job_hire_text_col">
            <h2 class="hue_blue">{{ $bd->title }}</h2>
            <p>
                <small>
                    Published on {{ date("M d, Y", strtotime($bd->published_date)) }} | Created By 
                    @if(!empty($bd->created_by)) 
                        {{ $bd->created_by }} 
                    @else
                        {{ $bd->user->name }} 
                    @endif
                </small>
            </p>
        </div>

        <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="qa_txt_blocks">
                <img class="bradius" style="max-height: 350px;" width="100%" height="auto" src="{{ $pathimage.'/'.$bd->id.'/'.$bd->image }}"/>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12">
            <div>
                <div class="qa_txt_single_blok">
                    <br><br>
                    <h5 class="hue_blue">{{ $bd->title }}</h5>
                    <p>
                    <small>
                        Published on {{ date("M d, Y", strtotime($bd->published_date)) }} | By 
                        @if(!empty($bd->created_by)) 
                            {{ $bd->created_by }} 
                        @else
                            {{ $bd->user->name }} 
                        @endif
                    </small>
                    </p>
                    <p class="hue_black">
                        <div class="blog_description">
                            {!! $bd->description !!}
                        </div>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ \Request::fullUrl() }}">
                            <img width="30" height="30" src="{{url('images/fb_icon.png')}}"/>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ \Request::fullUrl() }}">
                            <img width="30" height="30" src="{{url('images/linked_icon.png')}}"/>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-5 col-md-12">
        <h4 class="hue_blue">Recent Articles</h4>
            <br/>
            @if (count($blog)>0)
                @foreach($blog as $key => $b)
                    <div class="qa_txt_blocks" onclick="window.open('{{ url('blog').'/'.slug($b->title) }}');">
                        <div class="qa_txt_single_blok"  style="margin-bottom: 10px; !important">
                            <h5 class="hue_blue">{{ $b->title }}</h5>
                            <p>
                                <small>
                                    {{ date("M d, Y", strtotime($b->published_date)) }}
                                </small>
                            </p>
                            <p class="hue_black">
                                {{ limitWord(strip_tags($b->description)) }}
                            </p>
                            <p class="hue_black">By 
                                @if(!empty($bd->created_by)) 
                                    {{ $bd->created_by }} 
                                @else
                                    {{ $bd->user->name }} 
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
   
        </div>

        @if (count($blog_interest)>0)
            <div class="job_hire_text_col">
                <h2 class="hue_blue">{{__("Interesting For You")}}</h2>
            </div><br><br>
            <div class="row">
                @foreach($blog_interest as $key => $b)
                    <div class="col-xl-4 col-lg-4 col-md-12" onclick="window.open('{{ url('blog').'/'.slug($b->title) }}');">
                        <div class="qa_txt_blocks">
                            <img class="bradius" style="max-height: 250px;" max-height="00px"; height="auto" width="100%" src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
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

</section>

@endsection

@section('scripts')

<script src="{{ url('js/blockRotate.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/slick.min.js') }}"></script>
<script src="{{ url('js/customSlick.js') }}"></script>

<script type="text/javascript">
    const title = "{{ $b->title }}";
    const description = "{{ $b->description }}";
    $('meta[name="title"]').attr('content', title);
    $('meta[name="description"]').attr('content', description);
    $('meta[property="og:title"]').attr('content', title);
    $('meta[property="og:description"]').attr('content', description);
</script>

@endsection



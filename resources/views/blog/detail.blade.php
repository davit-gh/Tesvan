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
        <div class="job_hire_text_col">
            <h2 class="hue_blue">{{ $bd->title }}</h2>
            <p>
                <small>
                   Published on {{ date("M d, Y", strtotime($bd->published_date)) }} | Created By {{ $bd->user->name }}
                </small>
            </p>
        </div>

        <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="qa_txt_blocks">
                <div class="qa_txt_single_blok">
                <img style="max-height: 250px;" max-height="00px"; height="auto" width="100%" src="{{ $pathimage.'/'.$bd->id.'/'.$bd->image }}"/>
                </div>
            </div>
        </div>
      
        <div class="col-xl-7 col-lg-7 col-md-12">
            <div class="qa_txt_blocks">
                <div class="qa_txt_single_blok">
                    <br><br>
                    <h5 class="hue_blue">{{ $bd->title }}</h5>
                    <p>
                    <small>Published on {{ date("M d, Y", strtotime($bd->published_date)) }} | By {{ $bd->user->name }}</small>
                    </p>
                    <p class="hue_black">
                        {!! $bd->description !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-5 col-md-12">
            @if (count($blog)>0)
                @foreach($blog as $key => $b)
                    <div class="qa_txt_blocks" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
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
                            <p class="hue_black">
                                By <a href="#" >{{ $b->user->name }}</a>
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
                    <div class="col-xl-4 col-lg-4 col-md-12" onclick="window.open('{{ url('blog').'/'.slug($b->title).'/'.$b->id }}');">
                        <div class="qa_txt_blocks">
                            <div class="qa_txt_single_blok">
                            <img style="max-height: 250px;" max-height="00px"; height="auto" width="100%" src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
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
    
</script>

@endsection



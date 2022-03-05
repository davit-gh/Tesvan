@extends("layouts.app")

@section('styles')
<link rel="stylesheet" type="text/css" href="/css/blog.css?v={{ strtotime(date('YmdHis')) }}">
@endsection

<style type="text/css">
    .blog_description * {
        font-family: 'OpenSans-Regular' !important;
    }

    .blog_description {
        margin-bottom: 40px;
        font-family: 'OpenSans-Regular' !important;
    }
    .bradius{
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
</style>

@section('content')

<section id="job_hire" class="project-management" style="word-wrap: break-word;">
    <div class="container">
        <div class="blog_text_col">
            <h2 class="hue_blue">{{ $bd->translated_title }}</h2>
            <p>
                <small>
                    {{ $bd->formatted_translated_published_date }} | @if(app()->getLocale() == 'en') by @endif
                    @if(!empty($bd->created_by))
                        {{ __($bd->created_by) }}
                    @else
                        {{ $bd->user->name }}
                    @endif
                </small>
            </p>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="qa_txt_blocks">
                    <img class="bradius"  width="100%" height="auto" src="{{ $pathimage.'/'.$bd->id.'/'.$bd->image }}"/>
                </div>             
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="blog_description">
                    {!! $bd->translated_description !!}
                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ \Request::fullUrl() }}">
                    <img width="30" height="30" src="{{url('images/fb_icon.png')}}"/>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ \Request::fullUrl() }}">
                    <img width="30" height="30" src="{{url('images/linked_icon.png')}}"/>
                </a>
            </div>
            <div class="offset-lg-1 col-lg-4 col-md-12">
                <h4 style="font-weight: bold;">{{ __("Recent Articles") }}</h4>
                <br/>
                @if (count($blog)>0)
                    @foreach($blog as $key => $b)
                        <div class="qa_txt_blocks" onclick="window.open('{{ url('blog').'/'.slug($b->title) }}');">
                            <div class="qa_txt_single_blok"  style="margin-bottom: 10px; !important">
                                <h5 class="hue_blue">{{ $b->translated_title }}</h5>
                                <p>
                                    <small>
                                        {{ $b->translated_published_date }}
                                    </small>
                                </p>
                                <p class="hue_black">
                                    {{ limitWord(strip_tags($b->translated_description)) }}
                                </p>
                                <p class="hue_black">
                                    @if(app()->getLocale() == 'en') By @endif
                                    @if(!empty($bd->created_by))
                                        {{ __($bd->created_by) }}
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
            <div class="blog_text_col" style="margin-top: 50px">
                <h2 class="hue_blue">{{ __("Interesting For You") }}</h2>
            </div><br><br>
            <div class="row">
                @foreach($blog_interest as $key => $b)
                    <div class="col-xl-4 col-lg-4 col-md-12" onclick="window.open('{{ url('blog').'/'.slug($b->title) }}');">
                        <div class="qa_txt_blocks">
                            <img class="bradius" style="max-height: 250px;" max-height="00px"; height="auto" width="100%" src="{{ $pathimage.'/'.$b->id.'/'.$b->image }}"/>
                            <div class="qa_txt_single_blok">
                            <h5 class="hue_blue">{{ $b->translated_title }}</h5>
                            <p>
                                <small>
                                    {{ $b->translated_published_date }}
                                </small>
                            </p>
                            <p class="hue_black">
                                {{ limitWord(strip_tags($b->translated_description)) }}
                            </p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        @endif
</section>

@if(empty($bd->translated_title) || empty($bd->translated_description))
<div class="modal animated bounceInDown" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <a href="#" data-dismiss="modal" class="float-right">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.46585 8.01314L15.6959 1.78287C16.1014 1.37762 16.1014 0.722377 15.6959 0.317124C15.2907 -0.0881298 14.6354 -0.0881298 14.2302 0.317124L7.99992 6.5474L1.76983 0.317124C1.36439 -0.0881298 0.709336 -0.0881298 0.304083 0.317124C-0.101361 0.722377 -0.101361 1.37762 0.304083 1.78287L6.53417 8.01314L0.304083 14.2434C-0.101361 14.6487 -0.101361 15.3039 0.304083 15.7092C0.506045 15.9113 0.771595 16.0129 1.03696 16.0129C1.30232 16.0129 1.56768 15.9113 1.76983 15.7092L7.99992 9.47889L14.2302 15.7092C14.4323 15.9113 14.6977 16.0129 14.9631 16.0129C15.2284 16.0129 15.4938 15.9113 15.6959 15.7092C16.1014 15.3039 16.1014 14.6487 15.6959 14.2434L9.46585 8.01314Z" fill="#0D171D"/>
                    </svg>
                </a>
                <div class="success_img">
                    <svg width="147" height="147" viewBox="0 0 147 147" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M73.6411 147C35.6479 147 4.73633 116.088 4.73633 78.0956C4.73633 40.896 34.3671 10.4879 71.2651 9.23031V0L99.3087 18.695L71.2651 37.3888V28.2536C44.8503 29.4985 23.7445 51.3793 23.7445 78.0956C23.7445 105.607 46.1288 127.992 73.6411 127.992C101.153 127.992 123.538 105.607 123.538 78.0956V75.7196H142.546V78.0956C142.546 116.088 111.633 147 73.6411 147Z" fill="#F0BC5E"/>
                            <path d="M92.6493 42.4553H54.6329C52.0121 42.4553 49.8809 44.5866 49.8809 47.2074V51.9594C49.8809 54.5802 52.0121 56.7115 54.6329 56.7115V62.162C54.6329 69.4699 58.9093 76.2162 65.5292 79.3452C66.1348 79.6329 66.513 80.1979 66.513 80.8186C66.513 81.4428 66.1348 82.0066 65.5292 82.2932C58.9093 85.4233 54.6329 92.1686 54.6329 99.4799V104.232C52.0121 104.232 49.8809 106.363 49.8809 108.984V113.736C49.8809 116.357 52.0121 118.488 54.6329 118.488H92.6493C95.2702 118.488 97.4014 116.357 97.4014 113.736V108.984C97.4014 106.363 95.2702 104.232 92.6493 104.232V99.4799C92.6493 92.1686 88.3718 85.4233 81.753 82.2967C81.1463 82.0066 80.7692 81.4428 80.7692 80.8186C80.7692 80.1956 81.1463 79.6329 81.7554 79.3452C88.3718 76.2162 92.6493 69.4699 92.6493 62.162V56.7115C95.2702 56.7115 97.4014 54.5802 97.4014 51.9594V47.2074C97.4014 44.5866 95.2702 42.4553 92.6493 42.4553ZM92.654 113.736H54.6329V108.984H92.6493L92.654 113.736ZM87.8973 62.162C87.8973 67.6438 84.6871 72.7021 79.7262 75.0491C77.4708 76.1118 76.0172 78.3753 76.0172 80.8186C76.0172 83.2608 77.4708 85.5278 79.7262 86.5916C84.6871 88.9375 87.8973 93.9958 87.8973 99.4799V104.232H59.385V99.4799C59.385 93.9958 62.5952 88.9375 67.556 86.5916C69.8102 85.5301 71.2651 83.2631 71.2651 80.8186C71.2651 78.373 69.8102 76.1118 67.5584 75.0468C62.5928 72.6998 59.385 67.6403 59.385 62.1596V56.7115H87.8973V62.162ZM54.6329 51.9594V47.2074H92.6493L92.654 51.9594H54.6329Z" fill="black"/>
                            <path d="M121.217 62.887L125.806 61.6572L127.036 66.2469L122.447 67.4766L121.217 62.887Z" fill="black"/>
                            <path d="M115.668 51.0926L119.783 48.7166L122.159 52.8328L118.043 55.2077L115.668 51.0926Z" fill="black"/>
                            <path d="M107.242 41.1316L110.602 37.7717L113.962 41.1316L110.602 44.4914L107.242 41.1316Z" fill="black"/>
                            <path d="M96.5293 33.6913L98.9042 29.5762L103.02 31.951L100.644 36.0673L96.5293 33.6913Z" fill="black"/>
                            <path d="M136.094 63.2478L140.752 62.322L141.678 66.9801L137.02 67.9059L136.094 63.2478Z" fill="black"/>
                            <path d="M131.996 51.356L136.388 49.5369L138.206 53.9269L133.814 55.7461L131.996 51.356Z" fill="black"/>
                            <path d="M125.654 40.4782L129.605 37.8376L132.244 41.7869L128.293 44.4274L125.654 40.4782Z" fill="black"/>
                            <path d="M117.322 31.0531L120.682 27.6921L124.042 31.0531L120.682 34.413L117.322 31.0531Z" fill="black"/>
                            <path d="M107.303 23.433L109.944 19.4827L113.892 22.1232L111.252 26.0736L107.303 23.433Z" fill="black"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="147" height="147" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="success_txt">
                    <h5 class="hue_black">{{__("The page is still being translated")}}</h5>
                </div>
            </div>
            <div class="success_btn">
                <button onclick="window.location.href = '/blogs'" class="btn hue_bg_b">{{__("Go Back")}}</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')

<script src="{{ url('js/blockRotate.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/slick.min.js') }}"></script>
<script src="{{ url('js/customSlick.js') }}"></script>

<script type="text/javascript">
    const title = "{{ $bd->translated_title }}";
    const description = "{{ $bd->translated_description }}";
    $('meta[name="title"]').attr('content', title);
    $('meta[name="description"]').attr('content', description);
    $('meta[property="og:title"]').attr('content', title);
    $('meta[property="og:description"]').attr('content', description);

    @if(empty($bd->translated_title) || empty($bd->translated_description))
        $('#myModal').modal('show');
    @endif
</script>

@endsection



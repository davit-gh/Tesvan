@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/education.css?v={{ strtotime(date('YmdHis')) }}">
@endsection

@section('content')
<style type="text/css">
    .custom-btn a:hover {
        background: #FFFFFF;
        color: #143E5A;
        border: 1px solid #143E5A;
    }

    .img-fluid {
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
<section id="job_hire" class="project-management">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Education")}}</h2>
        </div>

        <div class="row">
            @if($featured)
                <div class="col-12 col-md-6 col-lg-7 col-xl-8 px-2" onclick="window.location.href = '{{ route('education.detail', ['education_category' => $featured->category->slug, 'education' => $featured->slug]) }}'" style="cursor: pointer;">
                    <div class="left_side_content_education">
                        <div class="main_box_lft_content">
                            <div class="main_box_image">
                                <img src="{{ url('uploads/images/educations/' . $featured->id . '/' . $featured->image) }}" class="img-fluid" style="width:100%; height: 470px; object-fit: cover; object-position: left;">
                            </div>
                            <div class="main_box_bottom_content">
                                <a href="{{ route('education.detail', ['education_category' => $featured->category->slug, 'education' => $featured->slug]) }}">
                                    <h3 class="main_title_all_page">{{ $featured->translated_title }}</h3>
                                </a>
                                <p class="date_text">{{ $featured->published_date->format('F d, Y') }}</p>
                                <div class="main_box_content_text">
                                    {!! $featured->meta_description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 px-2">
                <div class="right_side_content_education">
                    <h4 class="most_view_title mb-5">Most viewed</h4>
                    @foreach($most_viewed as $post)
                        <div class="most_view_box mb-4" onclick="window.location.href = '{{ route('education.detail', ['education_category' => $post->category->slug, 'education' => $post->slug]) }}'" style="cursor: pointer;">
                            <a href="{{ route('education.detail', ['education_category' => $post->category->slug, 'education' => $post->slug]) }}">
                                <h5 class="color143E59 font-24">{{ $post->translated_title }}</h5>
                            </a>
                            <p class="color6F6F6F font-16 pt-2">{{ $post->published_date->format('F d, Y') }}</p>
                            <p class="by_name_text"> by <a href="{{ route('teams') }}" class="blue">{{ $post->created_by }}</a> </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@foreach($categories as $category)
    <section class="qa_basics pb-45">
        <div class="container">
            <div class="all_section_title">
                <h3 class="all_title1 color143E59 pb-3">{{ $category->name }}</h3>
            </div>
            <div class="row">
                @foreach($category->latestPosts as $post)
                    <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1" onclick="window.location.href = '{{ route('education.detail', ['education_category' => $category->slug, 'education' => $post->slug]) }}'" style="cursor: pointer;">
                        <div class="all_box_1">
                            <div class="all_box_top_image">
                                <img src="{{ url('uploads/images/educations/' . $post->id . '/' . $post->image) }}" class="img-fluid" style="width:100%; height: 272px; object-fit: cover; object-position: left;">
                            </div>
                            <div class="all_box_bottom_content">
                                <a href="{{ route('education.detail', ['education_category' => $category->slug, 'education' => $post->slug]) }}">
                                    <h4 class="font-24 color143E59 semibold">{{ $post->translated_title }}</h4>
                                </a>
                                <p class="font-16 color6F6F6F pt-1">{{ $post->published_date->format('F d, Y') }} | by <a href="{{ route('teams') }}"
                                        class="blue">{{ $post->created_by }}</a></p>
                                <div class="font-18 color0D171D mb-0 line-height-30">
                                    {!! $post->meta_description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="view__button mt-4 pt-3">
                <a href="{{ route('education.list', ['education_category' => $category->slug]) }}" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
            </div>
        </div>
    </section>
@endforeach
@endsection

@section('scripts')
<script src="{{ url('js/blockRotate.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/slick.min.js') }}"></script>
<script src="{{ url('js/customSlick.js') }}"></script>
@endsection

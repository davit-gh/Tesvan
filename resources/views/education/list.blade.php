@extends("layouts.app")

@section('styles')


<link rel="stylesheet" type="text/css" href="/css/education.css?v={{ strtotime(date('YmdHis')) }}">

@endsection



@section('content')

<section class="all_inner_page_content">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue mb-4">{{ $category->translated_name }}</h2>
        </div>
        @foreach($category->posts->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $post)
                    <div class="col-12 col-md-4 mb-5 px-3 px-md-1" onclick="window.location.href = '{{ route('education.detail', ['education_category' => $category->slug, 'education' => $post->slug]) }}'" style="cursor: pointer;">
                        <div class="all_box_1">
                            <div class="all_box_top_image">
                                <img src="{{ url('uploads/images/educations/' . $post->id . '/' . $post->image) }}" class="img-fluid" style="width:100%; height: 272px; object-fit: cover; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                            </div>
                            <div class="all_box_bottom_content">
                                <a href="{{ route('education.detail', ['education_category' => $category->slug, 'education' => $post->slug]) }}">
                                    <h4 class="font-24 color143E59 semibold">{{ $post->translated_title }}</h4>
                                </a>
                                <p class="font-16 color6F6F6F pt-1">{{ $post->published_date->format('F d, Y') }} | by <a href="{{ route('teams') }}" class="blue">{{ $post->created_by }}</a></p>
                                <p class="font-18 color0D171D mb-0 line-height-30">{!! $post->meta_description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

@endsection

@section('scripts')



@endsection
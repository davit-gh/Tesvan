@extends("layouts.app")

@section('styles')


<link rel="stylesheet" type="text/css" href="/css/education.css?v={{ strtotime(date('YmdHis')) }}">

@endsection



@section('content')

<section class="all_inner_page_content">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue mb-4">QA Basics</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-5  px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <!-- <img src="images/education/qa1.jpg" class="img-fluid"> -->
                        <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">

                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Quality Assurance</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | by <a href="{{ route('teams') }}" class="blue">Tesvan team</a></p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-5  px-3 px-md-1" >
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Software testing</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | by <a href="{{ route('teams') }}" class="blue">Tesvan team</a></p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-5  px-3 px-md-1">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">7 Software Testing Principles</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | by <a href="{{ route('teams') }}" class="blue">Tesvan team</a></p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-5  px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <!-- <img src="images/education/qa1.jpg" class="img-fluid"> -->
                        <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">

                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">SDLC</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | by <a href="{{ route('teams') }}" class="blue">Tesvan team</a></p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-5  px-3 px-md-1" >
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">STLC</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | by <a href="{{ route('teams') }}" class="blue">Tesvan team</a></p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 px-3 mb-5 px-md-1">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Verification and Validation</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | by <a href="{{ route('teams') }}" class="blue">Tesvan team</a></p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')



@endsection
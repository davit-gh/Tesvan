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
</style>
<section id="job_hire" class="project-management">
    <div class="container">
        <div class="text-center job_hire_text_col">
            <h2 class="hue_blue">{{__("Education")}}</h2>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-7 col-xl-8 px-2">
                <div class="left_side_content_education">
                    <a href="">
                        <div class="main_box_lft_content">
                            <div class="main_box_image">
                                <img src="{{ url('images/example-1.png') }}" alt="main_image" class="img-fluid">

                            </div>
                            <div class="main_box_bottom_content">
                                <h3 class="main_title_all_page">What is Quality Assurance?</h3>
                                <p class="date_text">May 5, 2021</p>
                                <p class="main_box_content_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'ssimply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 px-2">
                <div class="right_side_content_education">
                    <h4 class="most_view_title mb-5">Most viewed</h4>
                    <div class="most_view_box mb-4">
                        <h5 class="color143E59 font-24">If I could change one thing in the Agile Manifesto…</h5>
                        <p class="color6F6F6F font-16 pt-2">May 5, 2021</p>
                        <p class="by_name_text"> By <span>TESVAN Team</span> </p>
                    </div>
                    <div class="most_view_box mb-4">
                        <h5 class="color143E59 font-24">If I could change one thing in the Agile Manifesto…</h5>
                        <p class="color6F6F6F font-16 pt-2">May 5, 2021</p>
                        <p class="by_name_text"> By <span>TESVAN Team</span> </p>
                    </div>
                    <div class="most_view_box">
                        <h5 class="color143E59 font-24">If I could change one thing in the Agile Manifesto…</h5>
                        <p class="color6F6F6F font-16 pt-2">May 5, 2021</p>
                        <p class="by_name_text"> By <span>TESVAN Team</span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- QA Basics -->
<section class="qa_basics">
    <div class="container">
        <div class="all_section_title">
            <h3 class="all_title1 color143E59 pb-3">QA Basics</h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                    <div class="all_box_1">
                        <div class="all_box_top_image">
                            <img src="{{ url('images/example-1.png') }}" class="img-fluid">
                        </div>
                        <div class="all_box_bottom_content">
                            <h4 class="font-24 color143E59 semibold">Quality Assurance</h4>
                            <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                            <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                    <div class="all_box_1">
                        <div class="all_box_top_image">
                            <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                        </div>
                        <div class="all_box_bottom_content">
                            <h4 class="font-24 color143E59 semibold">Software testing</h4>
                            <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                            <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-md-4 px-3 px-md-1">
                <a href="">
                    <div class="all_box_1">
                        <div class="all_box_top_image">
                            <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                        </div>
                        <div class="all_box_bottom_content">
                            <h4 class="font-24 color143E59 semibold">7 Software Testing Principles</h4>
                            <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                            <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
        <div class="view__button mt-4 pt-3">
            <a href="" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
        </div>
    </div>
</section>
<!-- Testing Methods  -->
<section class="qa_basics pt-45">
    <div class="container">
        <div class="all_section_title">
            <h3 class="all_title1 color143E59 pb-3">Testing Methods </h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                    <div class="all_box_1">
                        <div class="all_box_top_image">
                            <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">
                        </div>
                        <div class="all_box_bottom_content">
                            <h4 class="font-24 color143E59 semibold">Black Box method</h4>
                            <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                            <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                    <div class="all_box_1">
                        <div class="all_box_top_image">
                            <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                        </div>
                        <div class="all_box_bottom_content">
                            <h4 class="font-24 color143E59 semibold">White Box method</h4>
                            <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                            <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-md-4 px-3 px-md-1">
                <a href="">
                    <div class="all_box_1">
                        <div class="all_box_top_image">
                            <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                        </div>
                        <div class="all_box_bottom_content">
                            <h4 class="font-24 color143E59 semibold">Gray Box method</h4>
                            <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                            <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="view__button mt-4 pt-3">
            <a href="" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
        </div>
    </div>
</section>
<!-- Error detection -->
<section class="qa_basics pt-45">
    <div class="container">
        <div class="all_section_title">
            <h3 class="all_title1 color143E59 pb-3">Error detection</h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Defect, Error, Bug, Failure</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Bug Life Cycle</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Defect Severity and Defect Priority</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
        </div>
        <div class="view__button mt-4 pt-3">
            <a href="" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
        </div>
    </div>
</section>
<!-- Documentation -->
<section class="qa_basics pt-45">
    <div class="container">
        <div class="all_section_title">
            <h3 class="all_title1 color143E59 pb-3">Documentation</h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Test Case</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Test Script</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Test Plan</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
        </div>
        <div class="view__button mt-4 pt-3">
            <a href="" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
        </div>
    </div>
</section>
<!-- Agile model -->
<section class="qa_basics pt-45">
    <div class="container">
        <div class="all_section_title">
            <h3 class="all_title1 color143E59 pb-3">Agile model</h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Agile model</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Agile VS Waterfall</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Scrum methodology</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
        </div>
        <div class="view__button mt-4 pt-3">
            <a href="" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
        </div>
    </div>
</section>
<!-- Useful Materials -->
<section class="qa_basics pt-45 pb-45">
    <div class="container">
        <div class="all_section_title">
            <h3 class="all_title1 color143E59 pb-3">Useful Materials</h3>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Regular Expressions</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Linux</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
            <div class="col-12 col-md-4 px-3 px-md-1">
                <a href="">
                <div class="all_box_1">
                    <div class="all_box_top_image">
                        <img src="{{ url('images/education/qa3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="all_box_bottom_content">
                        <h4 class="font-24 color143E59 semibold">Git</h4>
                        <p class="font-16 color6F6F6F pt-1">May 5, 2021 | <span class="blue">By</span> Tesvan team</p>
                        <p class="font-18 color0D171D mb-0 line-height-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                </a>

            </div>
        </div>
        <div class="view__button mt-4 pt-3">
            <a href="" class="color143E59 font-weight-bold text-center view_more_btn">View More</a>
        </div>
    </div>
</section>



@endsection

@section('scripts')

<script src="{{ url('js/blockRotate.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/slick.min.js') }}"></script>
<script src="{{ url('js/customSlick.js') }}"></script>

<script type="text/javascript">
    $(document).on("click", "#showMore", function(e) {
        e.preventDefault();
        showNext = 6;
        showElement = $(".showElement").length;
        totalDb = Number("{{ count($project) }}");
        total = showNext + showElement;
        for (var i = showElement; i < total; i++) {
            $("#tab" + i).show();
            $("#tab" + i).addClass("showElement");
            if (i == totalDb) {
                $(".showMoreContainer").hide();
            }
        }
    });
</script>

@endsection
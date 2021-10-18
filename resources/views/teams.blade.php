@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/slick-theme.css">
<link rel="stylesheet" type="text/css" href="/css/slick.css">
<link rel="stylesheet" type="text/css" href="/css/qa.css">
<link rel="stylesheet" type="text/css" href="/css/co-workers.css">
<link rel="stylesheet" type="text/css" href="/css/customers.css">
<link rel="stylesheet" type="text/css" href="/css/team.css">
<link rel="stylesheet" type="text/css" href="/css/testiomanials.css">
<link rel="stylesheet" type="text/css" href="/css/partners.css">
<link rel="stylesheet" type="text/css" href="/css/contact_us.css">


@endsection


@section('content')

<style type="text/css">
.slick-dots li button {
    display: none;
}
</style>
<section id="team">
    <div class="container" align="center">
        <div class="text-center team_heder_txt_col">
            <h2 class="hue_blue">{{__("Our Team")}}</h2>
            <p class="hue_black"></p>
        </div>
        <div class="row">
            @if (count($teams)>0)
                @foreach ($teams as $key => $team)
                    @if ($key<=2)
                    <div class="col-md-4">
                        <div class="team_member_row">
                            <img src='{{asset("uploads/team/photo/$team->id/$team->photo")}}' alt="Davit" class="img-fluid m-auto">
                            <h4 class="hue_black pt-3">
                                @php
                                    $locale = \Lang::locale();
                                    if ($locale == "ru") {
                                        echo $team->name_ru;
                                    } else if ($locale == "am") {
                                        echo $team->name_am;
                                    } else {
                                        echo $team->name;
                                    }
                                @endphp
                            </h4>
                            <p class="hue_black pb-3">
                                <small>
                                    @php
                                    $locale = \Lang::locale();
                                    if ($locale == "ru") {
                                        echo $team->position_ru;
                                    } else if ($locale == "am") {
                                        echo $team->position_am;
                                    } else {
                                        echo $team->position;
                                    }
                                @endphp
                                </small>
                            </p>
                            <div data-cv-name='{{asset("uploads/team/cv/$team->id/$team->cv")}}' class="go_to_cv {{ ($team->background_color=='Aqua') ?  'cv_corner_blue' : 'cv_corner_yellow_md3' }}"></div>
                            <div class="layer {{ ($team->background_color=='Aqua') ?  'hue_aqua' : 'hue_royal' }}"></div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-3">
                        <div class="team_member_row">
                            <img src='{{asset("uploads/team/photo/$team->id/$team->photo")}}' alt="Davit" class="img-fluid m-auto">
                            <h4 class="hue_black pt-3">
                                @php
                                    $locale = \Lang::locale();
                                    if ($locale == "ru") {
                                        echo $team->name_ru;
                                    } else if ($locale == "am") {
                                        echo $team->name_am;
                                    } else {
                                        echo $team->name;
                                    }
                                @endphp
                            </h4>
                            <p class="hue_black pb-3">
                                <small>
                                    @php
                                    $locale = \Lang::locale();
                                    if ($locale == "ru") {
                                        echo $team->position_ru;
                                    } else if ($locale == "am") {
                                        echo $team->position_am;
                                    } else {
                                        echo $team->position;
                                    }
                                @endphp
                                </small>
                            </p>
                            <div data-cv-name='{{asset("uploads/team/cv/$team->id/$team->cv")}}' class="go_to_cv {{ ($team->background_color=='Aqua') ?  'cv_corner_blue' : 'cv_corner_yellow_md3' }}"></div>
                            <div class="layer {{ ($team->background_color=='Aqua') ?  'hue_aqua' : 'hue_royal' }}"></div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script src="../js/blockRotate.js"></script>
<script src="../js/slick.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/map.js"></script>
<script src="../js/customSlick.js"></script>
<script src="../js/home_validation.js"></script>

@endsection
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
            <div class="col-md-4">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Davit_.png')}}" alt="Davit" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Davit Grigoryan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Co-Founder/Senior QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Davit.png')}}" alt=" Davit" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Davit Kartashyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Co-Founder/Senior QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Armen.png')}}" alt="Armen" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Armen Grigoryan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Co-Founder/Product Lead")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Arpine.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Arpine Aleksanyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Senior QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Lena.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Lena Hambardzumyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("HR/Marketing Specialist")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Hasmik.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Hasmik Hovhannisayan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("UI/UX Designer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Merine.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Merine Margaryan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Ara.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Ara Galsatyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Lusine.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Lusine Hovhannisyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Ani.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Ani Vardanyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Vazgen.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Vazgen Arakelyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Lilit.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Lilit Galstyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Shogher.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Shogher Galstyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Nina.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Nina Antonyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Arman.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Arman Poghosyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Norayr.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Norayr Hakobyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Levon.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Levon Galstyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Mane.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Mane Shahbazyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Vanuhi.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Vanuhi Melikyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Mari.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Mari Melikyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Mariam.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Mariam Martirosyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/DavitOhanyan.png')}}" alt="Arpine" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Davit Ohanyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Junior QA Engineer")}}</small></p>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
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

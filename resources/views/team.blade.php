<section id="team">
    <div class="container" align="center">
        <div class="text-center team_heder_txt_col">
            <h2 class="hue_blue">{{__("Our Team")}}</h2>
            <p class="hue_black">{{__("Meet our talented team members who shine when it comes to what they do the best")}}</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Davit_.png')}}" alt="Davit" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Davit Grigoryan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Co-Founder/Senior QA Engineer")}}</small></p>
                    <div data-cv-name="Davit_Grigoryan.pdf" class="go_to_cv cv_corner_blue"></div>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Davit.png')}}" alt=" Davit" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Davit Kartashyan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Co-Founder/Senior QA Engineer")}}</small></p>
                    <div data-cv-name="Davit_Kartashyan.pdf" class="go_to_cv cv_corner_yellow"></div>
                    <div class="layer hue_royal"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team_member_row">
                    <img src="{{asset('images/team_images/Armen.png')}}" alt="Armen" class="img-fluid m-auto">
                    <h4 class="hue_black pt-3">{{__("Armen Grigoryan")}}</h4>
                    <p class="hue_black pb-3"><small>{{__("Co-Founder/Product Lead")}}</small></p>
                    <div data-cv-name="Armen_Grigoryan.pdf" class="go_to_cv cv_corner_blue"></div>
                    <div class="layer hue_aqua"></div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="container" align="center">
        <div class="custom-btn">
            <a href="{{ route('teams') }}">See All</a>
        </div>
    </div>
</section>
<section id="job_apply">
    <div class="container">
        <div class="text-center job_apply_text_col">
            <h2 class="hue_blue">{{__("Apply for a Job")}}</h2>
            <p class="hue_black">
                {{__("Our team is excited by the opportunity to set new standard of quality for your software on all levels of complexity ")}}
            </p>
        </div>
        <div class="apply_form_row">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-12 clearfix">
                    <div class="row float-xl-right  float-lg-right">
                        <div class="apply_form_contacts_col">
                            <h5 class="hue_blue">{{__("Who can apply for a job?")}}</h5>
                            <p class="hue_black beginner_txt">
                                {{__("If you are a beginner, you have basic knowledge in any field of IT, you have participated in courses, but you can not find a job, you do not have work experience, then this offer is just for you.")}}
                            </p>
                            <p class="hue_blue">
                                {{__("All you should do is fill out the online questionnaire and our specialist will contact you within 2 days.")}}
                            </p>
                            <div class="pointer_svg d-flex justify-content-end">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <rect width="40" height="40" fill="url(#patternPointer)" />
                                    <defs>
                                        <pattern id="patternPointer" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#imagePointer" transform="scale(0.0111111)" />
                                        </pattern>
                                        <image id="imagePointer" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAABmJLR0QA/wD/AP+gvaeTAAACO0lEQVR4nO3aMWtTURiH8f+baGJyAgpu4uDQzU/hIqQipI5WHBwcBEEHwUXIrkgRV0V0kSKoFJI6+UWK+A10SG5axbwOxpjQ3DTxnqR6+/y25BwOh4cMJ+deCQAAAAAAAAAAAAAAAACQE3bYG/hX+ObZSqfqGya/Jqkn1/NQrD6w1Z29GOsXYiySB4PINyVVJZ2W6V73R++tt1bKMdYntCR3WUF+dd+AeT1WbEJLMpO75JMH48Qm9JA9Sx/KHpvQA6FQuS+3duqEjLEJPWCrO3uhd6oh01b6JK93+8l7/3juxNzrZ9pdDvnm+VI3fHkj1+Up0z6EUGrYhc+7s65L6AkWEZvQKWLHJvQUMWMT+gCxYhN6BjFiE3pGWWMTeg5ZYo+F9q0z1cT00KV1SScXsdkjwa0dasevjMYe+2fYMX/s0i0RORvzeqf77cnoV8PQ3lTBZNeXv6t8Mmndm3/6ctexJMPQ1lTf5S8PczN54vJX1lT/9+exX3QtKd416amkr0vfWa54qxbKd0a/4Xg3hxmPd9shlNamHu+QLktkidAzyRpZIvSBYkSWCD1VrMgSoVPFjCwReiIeZS0BD2eXYFGRJamYcW+54a2VcrfYeSfpUvoka4ditWEXP839humxLJvLk6SfPJKpnjrBrR2KlbW/fY2X2zv9uiJ26Ub6hGyRJUKPmtwiQuT0xY+YwXXm630DkSJLhB5Kku+3Jb2QtGtSR7KNWJExgTtHXgAAAAAAAAAAAAAAAAD/q59HAi48M2110AAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="row">
                        <div class="apply_form_col" id="job-apply" style="position: relative;">
                            <div id="job_success" style="display: none; position: absolute; width: 90%; height: 90%; z-index: 999; background: white;" class="text-center">
                                <img src="{{ asset('images/submit_success.svg') }}" alt="Success" width="137px" height="137px" style="margin-top: 34px; margin-bottom: 112px;">
                                <p style="font-size: 30px; font-weight: 600; line-height: 1.685;">{{ __('Your request was sent successfully!') }}</p>
                                <p style="font-size: 25px; font-weight: 400;">{{ __('Thank You!') }}</p>
                            </div>
                            <h5 class="hue_blue text-center">{{__("Join our talented team")}}</h5>
                            <div class="apply_tesvan_form">
                                <p class="hue_blue apply_tesvan_text_tesvan_form">{{__("All fields are required")}}</p>
                                <form method="post" action="{{ url('/job#job_apply') }}" enctype="multipart/form-data" autocomplete="off" name="job_apply" novalidate="novalidate">
                                    @csrf
                                    <div id="apply" class="apply_wizard">
                                     <div class="apply_tesvan_text_tesvan_form">
                                        <div class="pt-2"></div>
                                        <div class="form-group apply_custom_form_group">
                                            <label for="name">{{__("Name")}}</label>
                                            <input name="name" type="text" class="name form-control apply_custom_form_input" maxlength="50" id="name" onblur="nameValidate()">
                                            <div id="nameStatus" class="invalid-feedback">{{__("Name field is required")}}</div>
                                        </div>
                                        <div class="form-group apply_custom_form_group">
                                            <label for="surname">{{__("Surname")}}</label>
                                            <input name="surname" type="text" class="surname form-control apply_custom_form_input" maxlength="50" id="surname" onblur="surnameValidate()">
                                            <div id="surnameStatus" class="invalid-feedback">{{__("Surname field is required")}}</div>
                                        </div>
                                        <div class="form-group apply_custom_form_group">
                                            <label for="email">{{__("Email")}}</label>
                                            <input name="email" type="email" class="form-control email apply_custom_form_input" maxlength="50" id="email" onblur="emailValidate()">
                                            <div id="emailStatus" class="invalid-feedback">{{__("Email field is required")}}</div>
                                        </div>
                                        <div class="form-group apply_custom_form_group">
                                            <label for="phone">{{__("Phone")}}</label>
                                            <input name="phone" type="tel" class="phone form-control apply_custom_form_input" maxlength="50" id="phone" onblur="phoneValidate()">
                                            <div id="phoneStatus" class="invalid-feedback">{{__("Phone field is required")}}</div>
                                        </div>
                                        <div class="form-group apply_custom_form_group">
                                            <label for="city">{{__("City")}}</label>
                                            <input name="city" type="text" class="city form-control apply_custom_form_input" maxlength="50" id="city" onblur="cityValidate()">
                                            <div id="cityStatus" class="invalid-feedback">{{("City field is required")}}</div>
                                        </div>
                                        <button data-next-id="form_apply" validationApplyDiv="apply" type="submit" class="job_btn job_next_btn apply_continue button button-action hue_blue">{{__("Next")}}</button>
                                     </div>
                                    </div>
                                    <div id="form_apply" class="apply_wizard">
                                     <div class="apply_tesvan_text_tesvan_form">
                                        <div class="pt-2"></div>
                                        <div class="form-group apply_custom_form_group dropdown" style="margin-bottom: 2rem">
                                            <label for="experience">{{__("Experience level") }}</label>
                                            <select name="experience" id="experience" class="experience form-control apply_custom_form_input" data-placeholder="{{ __('Select level') }}">
                                                <option></option>
                                                <option value="0">{{ __('No experience, but I have passed the QA courses') }}</option>
                                                <option value="1">{{ __('1-2 years') }}</option>
                                                <option value="2">{{ __('3-5 years') }}</option>
                                                <option value="3">{{ __('5+ years') }}</option>
                                            </select>
                                            <div id="experienceStatus" class="invalid-feedback">{{__("Experience field is required")}}</div>
                                        </div>
                                        <div id="no-experience-fields" class="form-group apply_custom_form_group" style="display: none; margin-bottom: 2rem">
                                            <label for="course">{{__("The place you have passed the course")}}</label>
                                            <input name="course" type="text" class="course form-control apply_custom_form_input" maxlength="50" id="course" onblur="courseValidate()">
                                            <div id="courseStatus" class="invalid-feedback">{{__("Course field is required")}}</div>
                                        </div>
                                        <div id="experienced-fields" style="display: none;">
                                            <div class="form-group apply_custom_form_group dropdown" style="margin-bottom: 2rem">
                                                <label for="frameworks">{{__("The most 3 experienced frameworks")}}</label>
                                                <select name="frameworks[]" id="frameworks" class="frameworks form-control apply_custom_form_input" multiple data-placeholder="{{ __('Select frameworks') }}">
                                                    <option value="Cucumber">Cucumber</option>
                                                    <option value="Jasmine">Jasmine</option>
                                                    <option value="JEST">JEST</option>
                                                    <option value="JUnit">JUnit</option>
                                                    <option value="Karma">Karma</option>
                                                    <option value="Mocha">Mocha</option>
                                                    <option value="Robot">Robot</option>
                                                    <option value="Selenide">Selenide</option>
                                                    <option value="Serenity">Serenity</option>
                                                    <option value="TestNG">TestNG</option>
                                                </select>
                                                <div id="frameworksStatus" class="invalid-feedback">{{__("Frameworks field is required")}}</div>
                                            </div>
                                            <div class="form-group apply_custom_form_group dropdown" style="margin-bottom: 2rem">
                                                <label for="tools">{{__("The most 3 experienced tools")}}</label>
                                                <select name="tools[]" id="tools" class="tools form-control apply_custom_form_input" multiple data-placeholder="{{ __('Select tools') }}">
                                                    <option value="Appium">Appium</option>
                                                    <option value="BrowserStack">BrowserStack</option>
                                                    <option value="Cypress">Cypress</option>
                                                    <option value="Selenium">Selenium</option>
                                                    <option value="TestRail">TestRail</option>
                                                </select>
                                                <div id="toolsStatus" class="invalid-feedback">{{__("Tools field is required")}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group apply_custom_form_group">
                                            <label for="salary">{{__("What is the salary you will be excited about")}}</label>
                                            <input name="salary" type="text" class="salary form-control apply_custom_form_input" maxlength="50" id="salary" onblur="salaryValidate()">
                                            <div id="salaryStatus" class="invalid-feedback">{{__("Salary field is required")}}</div>
                                        </div>
                                        <div class="form-group apply_custom_radio_group">
                                            <h6 class="en_level_txt">{{__("English level")}}</h6>
                                            <div class="radio_group d-flex justify-content-between">
                                                <div class="single_radio_group">
                                                    <label class="radio_label">
                                                        <input type="radio" name="level" value="A1" checked="checked" />
                                                        <span class="radio_txt">A1</span>
                                                    </label>
                                                    <label class="radio_label">
                                                        <input type="radio" name="level" value="A2" />
                                                        <span class="radio_txt">A2</span>
                                                    </label>
                                                </div>
                                                <div class="single_radio_group">
                                                    <label class="radio_label">
                                                        <input type="radio" name="level" value="B1" />
                                                        <span class="radio_txt">B1</span>
                                                    </label>
                                                    <label radio_label="radio_label">
                                                        <input type="radio" name="level" value="B2" />
                                                        <span class="radio_txt">B2</span>
                                                    </label>
                                                </div>
                                                <div class="single_radio_group">
                                                    <label class="radio_label">
                                                        <input type="radio" name="level" value="C1" />
                                                        <span class="radio_txt">C1</span>
                                                    </label>
                                                    <label radio_label="radio_label">
                                                        <input type="radio" name="level" value="C2" />
                                                        <span class="radio_txt">C2</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group apply_custom_form_group attach_cv">
                                                <label for="cv">{{__("Attach CV")}}</label>
                                                <input name="cv" type="file" class="cv form-control " id="cv" onblur="cvValidate()" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf">
                                                <div class="choosen"></div>
                                                <div id="cvStatus" class="invalid-feedback cv_status">{{__("CV field is required")}}</div>
                                            </div>
                                        </div>
                                     </div>
                                        <div class="form-group apply_tesvan_checkbox">
                                            <label class="form-control" style="border: none; background: none; padding: 0; margin: 0;height: 1.5rem" for="privacy-check">
                                                <input type="checkbox" id="privacy-check" class="privacy-checks" required style="height: auto" onchange="privacyValidate()">
                                                {{__("I have read and agreed to the ")}}<a href="{{ route('privacy') }}" target="_blank">{{__("Privacy Policy")}}</a>{{__(".")}}
                                            </label>
                                            <div id="privacyStatus" class="invalid-feedback apply_tesvan_invalid_text">{{__("You must agree to the privacy policy")}}</div>
                                        </div>
                                       <div class="apply_tesvan_text_tesvan_form">
                                        <div class="btn_group d-flex justify-content-between pt-4">
                                            <button type="button" class="job_btn job_back_btn">{{__("Back")}}</button>
                                            <button type="submit" class="job_btn job_apply_btn">{{__("Apply")}}</button>
                                        </div>
                                       </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal animated bounceInDown" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="success_img">
                    <svg xmlns="http://www.w3.org/2000/svg" class="successs_svg" width="138" height="138" viewBox="0 0 138 138" fill="none">
                        <path d="M68.5781 137.156C30.7633 137.156 0 106.393 0 68.5781C0 30.7633 30.7633 0 68.5781 0C106.393 0 137.156 30.7633 137.156 68.5781C137.156 106.393 106.393 137.156 68.5781 137.156ZM68.5781 20.17C41.8851 20.17 20.17 41.8851 20.17 68.5781C20.17 95.2712 41.8851 116.986 68.5781 116.986C95.2712 116.986 116.986 95.2712 116.986 68.5781C116.986 41.8851 95.2712 20.17 68.5781 20.17Z" fill="#F0BC5E" />
                        <path d="M93.9644 41.5222L52.4424 83.0443L43.1924 73.7943L37.4883 79.4984L52.4424 94.4524L99.6685 47.2263L93.9644 41.5222Z" fill="black" />
                        <path d="M68.5781 112.952C44.1118 112.952 24.204 93.0442 24.204 68.5779C24.204 58.1096 27.9355 47.9439 34.7086 39.9445L28.5567 34.7285C20.5492 44.1842 16.136 56.2056 16.136 68.5779C16.136 97.4937 39.6623 121.02 68.5781 121.02C80.9504 121.02 92.9717 116.607 102.427 108.599L97.2115 102.447C89.212 109.221 79.0463 112.952 68.5781 112.952Z" fill="black" />
                        <path d="M68.5779 16.136C56.2056 16.136 44.1842 20.5492 34.7285 28.5567L39.9445 34.7086C47.9439 27.9355 58.1096 24.204 68.5779 24.204C93.0441 24.204 112.952 44.1118 112.952 68.5781C112.952 79.0463 109.221 89.212 102.447 97.2115L108.599 102.427C116.607 92.9717 121.02 80.9504 121.02 68.5781C121.02 39.6623 97.4936 16.136 68.5779 16.136Z" fill="black" />
                    </svg>
                </div>
                <div class="success_txt">
                    <h5 class="hue_black">{{__("Your message was sent successfully.")}}</h5>
                    <p class="hue_black">{{__("Thank You!")}}</p>
                </div>
            </div>
            <div class="success_btn">
                <button type="button" class="btn hue_bg_b" data-dismiss="modal">{{__("OK")}}</button>
            </div>
        </div>
    </div>
</div>

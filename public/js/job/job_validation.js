window.onload = function() {
    document.job_apply.onsubmit = function() {
        if (!$("#form_apply").is(":visible") && checkForm()) {
            $(".apply_wizard").slideUp(800);
            $("#form_apply").slideDown(800);
            return false;
        }

        if (checkForm() && $("#form_apply").is(":visible")) {
            var data = new FormData(this);
            fetch("/job", {
                method: "post",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                body: data
            }).then(response => {
                if (response.ok) {
                    $("#job_success").show();
                }
            });
        }

        return false;
    };
};

var locale = document.getElementsByTagName("html")[0].getAttribute("lang");

function nameValidate() {
    var name = document.getElementById("name");
    if (name.value == "") {
        name.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("nameStatus").innerHTML =
                "Name field is required";
        } else if (locale == "am") {
            document.getElementById("nameStatus").innerHTML =
                "Անվան դաշտը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("nameStatus").innerHTML =
                "Поле имени обязательно для заполнения";
        }

        return false;
    } else if (name.value.trim().length < 3) {
        name.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("nameStatus").innerHTML =
                "Name field must be at least 3 characters";
        } else if (locale == "am") {
            document.getElementById("nameStatus").innerHTML =
                "Անվան դաշտը պետք է կազմի առնվազն 3 նիշ";
        } else if (locale == "ru") {
            document.getElementById("nameStatus").innerHTML =
                "Поле имени должно содержать не менее 3 символов.";
        }

        return false;
    } else {
        name.className = "form-control is-valid";
        return true;
    }
}

function surnameValidate() {
    var surname = document.getElementById("surname");
    if (surname.value == "") {
        surname.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("surnameStatus").innerHTML =
                "Surname field is required";
        } else if (locale == "am") {
            document.getElementById("surnameStatus").innerHTML =
                "Ազգանունի դաշտը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("surnameStatus").innerHTML =
                "Фамилия обязательна";
        }
        return false;
    } else if (surname.value.trim().length < 3) {
        surname.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("surnameStatus").innerHTML =
                "Surname field must be at least 3 characters";
        } else if (locale == "am") {
            document.getElementById("surnameStatus").innerHTML =
                "Ազգանունի դաշտը պետք է կազմի առնվազն 3 նիշ";
        } else if (locale == "ru") {
            document.getElementById("surnameStatus").innerHTML =
                "Поле фамилии должно состоять не менее чем из 3 символов.";
        }

        return false;
    } else {
        surname.className = "form-control is-valid";
        return true;
    }
}

function emailValidate() {
    var email = document.getElementById("email");

    if (email.value == "") {
        email.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("emailStatus").innerHTML =
                "Email field is required";
        } else if (locale == "am") {
            document.getElementById("emailStatus").innerHTML =
                "Էլեկտրոնային փոստը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("emailStatus").innerHTML =
                "Электронная почта обязательна";
        }
        return false;
    } else if (!validEmail(email.value)) {
        if (locale == "en") {
            document.getElementById("emailStatus").innerHTML =
                "Incorrect email address";
        } else if (locale == "am") {
            document.getElementById("emailStatus").innerHTML =
                "Սխալ էլեկտրոնային հասցե";
        } else if (locale == "ru") {
            document.getElementById("emailStatus").innerHTML =
                "Неверный адрес электронной почты";
        }
        email.className = "form-control is-invalid";
        return false;
    } else {
        email.className = "form-control is-valid";
        return true;
    }
}

function phoneValidate() {
    var phone = document.getElementById("phone");

    if (phone.value == "") {
        phone.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("phoneStatus").innerHTML =
                "Phone field is required";
        } else if (locale == "am") {
            document.getElementById("phoneStatus").innerHTML =
                "Հեռախոսահամարը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("phoneStatus").innerHTML =
                "Требуется телефон";
        }
        return false;
    } else if (!validPhone(phone.value)) {
        if (locale == "en") {
            document.getElementById("phoneStatus").innerHTML =
                "Incorrect phone number";
        } else if (locale == "am") {
            document.getElementById("phoneStatus").innerHTML =
                "Սխալ հեռախոսահամար";
        } else if (locale == "ru") {
            document.getElementById("phoneStatus").innerHTML =
                "Неверный номер телефона";
        }
        phone.className = "form-control is-invalid";
        return false;
    } else if (phone.value.trim().length < 9) {
        phone.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("phoneStatus").innerHTML =
                "Phone field must be at least 9 characters";
        } else if (locale == "am") {
            document.getElementById("phoneStatus").innerHTML =
                "Հեռախոսի դաշտը պետք է կազմի առնվազն 9 նիշ ";
        } else if (locale == "ru") {
            document.getElementById("phoneStatus").innerHTML =
                "Поле телефона должно содержать не менее 9 символов. ";
        }

        return false;
    } else {
        phone.className = "form-control is-valid";
        return true;
    }
}

function cityValidate() {
    var city = document.getElementById("city");
    if (city.value == "") {
        city.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("cityStatus").innerHTML =
                "City field is required";
        } else if (locale == "am") {
            document.getElementById("cityStatus").innerHTML =
                "Քաղաքը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("cityStatus").innerHTML =
                "Поле города обязательно для заполнения";
        }
        return false;
    } else if (city.value.trim().length < 3) {
        city.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("cityStatus").innerHTML =
                "City field must be at least 3 characters";
        } else if (locale == "am") {
            document.getElementById("cityStatus").innerHTML =
                "Քաղաքի դաշտը պետք է կազմի առնվազն 3 նիշ";
        } else if (locale == "ru") {
            document.getElementById("cityStatus").innerHTML =
                "Поле города должно содержать не менее 3 символов.";
        }

        return false;
    } else {
        city.className = "form-control is-valid";
        return true;
    }
}

function educationValidate() {
    var education = document.getElementById("education");
    if (education.value == "") {
        education.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("educationStatus").innerHTML =
                "Education field is required";
        } else if (locale == "am") {
            document.getElementById("educationStatus").innerHTML =
                "Կրթության ոլորտը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("educationStatus").innerHTML =
                "Обязательное поле образования";
        }
        return false;
    } else if (education.value.trim().length < 3) {
        education.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("educationStatus").innerHTML =
                "Education field must be at least 3 characters";
        } else if (locale == "am") {
            document.getElementById("educationStatus").innerHTML =
                "Կրթության ոլորտը պետք է կազմի առնվազն 3 նիշ";
        } else if (locale == "ru") {
            document.getElementById("educationStatus").innerHTML =
                'Поле "Образование" должно содержать не менее 3 символов.';
        }

        return false;
    } else {
        education.className = "form-control is-valid";
        return true;
    }
}

function companyValidate() {
    var company = document.getElementById("company");
    if (company.value == "") {
        company.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("companyStatus").innerHTML =
                "Company field is required";
        } else if (locale == "am") {
            document.getElementById("companyStatus").innerHTML =
                "Ընկերության դաշտը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("companyStatus").innerHTML =
                "Поле компании обязательно для заполнения";
        }
        return false;
    } else if (company.value.trim().length < 3) {
        company.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("companyStatus").innerHTML =
                "Company field must be at least 3 characters";
        } else if (locale == "am") {
            document.getElementById("companyStatus").innerHTML =
                "Ընկերության դաշտը պետք է կազմի առնվազն 3 նիշ";
        } else if (locale == "ru") {
            document.getElementById("companyStatus").innerHTML =
                "Поле компании должно состоять не менее чем из 3 символов.";
        }

        return false;
    } else {
        company.className = "form-control is-valid";
        return true;
    }
}

function experienceValidate() {
    var exp = document.getElementById("experience");
    var expStatus = document.getElementById("experienceStatus");
    exp.nextElementSibling
        .querySelector(".select2-selection")
        .removeAttribute("style");
    exp.className =
        "experience form-control apply_custom_form_input select2-hidden-accessible ";

    if (exp.value == "") {
        if (locale == "en") {
            expStatus.innerHTML = "Experience field is required";
        } else if (locale == "am") {
            expStatus.innerHTML = "Փորձի դաշտը պարտադիր է";
        } else if (locale == "ru") {
            expStatus.innerHTML = "Поле с опытом обязательно";
        }

        exp.nextElementSibling
            .querySelector(".select2-selection")
            .setAttribute("style", "border-color: #dc3545 !important");
        exp.className += "is-invalid";
        return false;
    }

    exp.className += "is-valid";
    return true;
}

function frameworksValidate() {
    var frameworks = document.getElementById("frameworks");
    var frameworksStatus = document.getElementById("frameworksStatus");
    var selectedCount = Array.from(frameworks.options).filter(o => o.selected)
        .length;
    frameworks.nextElementSibling
        .querySelector(".select2-selection")
        .removeAttribute("style");
    frameworks.className =
        "frameworks form-control apply_custom_form_input select2-hidden-accessible ";

    if (selectedCount < 3) {
        if (locale == "en") {
            frameworksStatus.innerHTML = "You must select 3 frameworks";
        } else if (locale == "am") {
            frameworksStatus.innerHTML = "Դուք պետք է ընտրեք 3 ֆրեյմվորք";
        } else if (locale == "ru") {
            frameworksStatus.innerHTML = "Вы должны выбрать 3 фреймворка";
        }

        frameworks.nextElementSibling
            .querySelector(".select2-selection")
            .setAttribute("style", "border-color: #dc3545 !important");
        frameworks.className += "is-invalid";
        return false;
    }

    frameworks.className += "is-valid";
    return true;
}

function toolsValidate() {
    var tools = document.getElementById("tools");
    var toolsStatus = document.getElementById("toolsStatus");
    var selectedCount = Array.from(tools.options).filter(o => o.selected)
        .length;
    tools.nextElementSibling
        .querySelector(".select2-selection")
        .removeAttribute("style");
    tools.className =
        "tools form-control apply_custom_form_input select2-hidden-accessible ";

    if (selectedCount < 3) {
        if (locale == "en") {
            toolsStatus.innerHTML = "You must select 3 tools";
        } else if (locale == "am") {
            toolsStatus.innerHTML = "Դուք պետք է ընտրեք 3 գործիք";
        } else if (locale == "ru") {
            toolsStatus.innerHTML = "Вы должны выбрать 3 инструмента";
        }

        tools.nextElementSibling
            .querySelector(".select2-selection")
            .setAttribute("style", "border-color: #dc3545 !important");
        tools.className += "is-invalid";
        return false;
    }

    tools.className += "is-valid";
    return true;
}

function salaryValidate() {
    var salary = document.getElementById("salary");
    var salaryStatus = document.getElementById("salaryStatus");

    if (salary.value == "") {
        if (locale == "en") {
            salaryStatus.innerHTML = "Salary field is required";
        } else if (locale == "am") {
            salaryStatus.innerHTML = "Աշխատավարձի դաշտը պարտադիր է";
        } else if (locale == "ru") {
            salaryStatus.innerHTML = "Поле Зарплата обязательно";
        }

        salary.className = "form-control is-invalid";
        return false;
    }

    salary.className = "form-control is-valid";
    return true;
}

function courseValidate() {
    var course = document.getElementById("course");
    if (course.value == "") {
        course.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("courseStatus").innerHTML =
                "Course field is required";
        } else if (locale == "am") {
            document.getElementById("courseStatus").innerHTML =
                "Դասընթացի դաշտը պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("courseStatus").innerHTML =
                "Поле курса обязательно для заполнения";
        }
        return false;
    } else if (course.value.trim().length < 3) {
        course.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("courseStatus").innerHTML =
                "Course field must be at least 3 characters";
        } else if (locale == "am") {
            document.getElementById("courseStatus").innerHTML =
                "Դասընթացի դաշտը պետք է կազմի առնվազն 3 նիշ";
        } else if (locale == "ru") {
            document.getElementById("courseStatus").innerHTML =
                "Поле курса должно состоять не менее чем из 3 символов.";
        }

        return false;
    } else {
        course.className = "form-control is-valid";
        return true;
    }
}

function cvValidate() {
    var cv = document.getElementById("cv");
    if (cv.value == "") {
        cv.className = "form-control is-invalid";
        if (locale == "en") {
            document.getElementById("cvStatus").innerHTML =
                "CV field is required";
        } else if (locale == "am") {
            document.getElementById("cvStatus").innerHTML = "CV-ն պարտադիր է";
        } else if (locale == "ru") {
            document.getElementById("cvStatus").innerHTML =
                "Поле CV обязательно для заполнения";
        }
        return false;
    } else {
        var val = $(cv)
                .val()
                .toLowerCase(),
            regex = new RegExp("(.*?).(docx|doc|pdf)$");

        if (!regex.test(val)) {
            $(cv).val("");
            cv.className = "form-control is-invalid";
            if (locale == "en") {
                document.getElementById("cvStatus").innerHTML =
                    "CV must be in PDF, DOC, or DOCX format";
            } else if (locale == "am") {
                document.getElementById("cvStatus").innerHTML =
                    "CV- ն պետք է լինի PDF, DOC կամ DOCX ձևաչափով";
            } else if (locale == "ru") {
                document.getElementById("cvStatus").innerHTML =
                    "Резюме должно быть в формате PDF, DOC или DOCX.";
            }
            return false;
        }

        cv.className = "form-control is-valid";
        return true;
    }
}

function privacyValidate() {
    var checked = $("#privacy-check").is(":checked");
    var input = $('[for="privacy-check"]')[0];

    if (checked) {
        input.className = "form-control is-valid";
    } else {
    if(locale == "en") {
        document.getElementById("privacyStatus").innerHTML =
            "You must agree to the privacy policy"};
            if(locale == "am") {
        document.getElementById("privacyStatus").innerHTML =
            "Դուք պետք է ընդունեք գաղտնիության քաղաքականությունը"};
            if(locale == "ru") {
        document.getElementById("privacyStatus").innerHTML =
            "Вы должны согласиться с Политикой конфиденциальности"};
        input.className = "form-control is-invalid";
    }

    return checked;
}

function validEmail(email) {
    var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    return pattern.test(email);
}

function validPhone(phone) {
    var pattern = /^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$/;
    return pattern.test(phone);
}

function checkForm() {
    var valid = true;

    if (!nameValidate()) valid = false;
    if (!surnameValidate()) valid = false;
    if (!emailValidate()) valid = false;
    if (!phoneValidate()) valid = false;
    if (!cityValidate()) valid = false;

    if ($("#form_apply").is(":visible")) {
        if (!experienceValidate()) valid = false;
        if ($("#experience").val() == "0") {
            if (!courseValidate()) valid = false;
        } else {
            if (!frameworksValidate()) valid = false;
            if (!toolsValidate()) valid = false;
        }
        if (!salaryValidate()) valid = false;
        if (!cvValidate()) valid = false;
        if (!privacyValidate()) valid = false;
    }

    return valid;
}

$(document).ready(function disablecp() {
      $('input').bind('copy paste', function (e) {
         e.preventDefault();
      });
   });

$(document).ready(function() {
    $(".apply_wizard").hide();
    $("#apply").show();
    $(".apply_continue").click(function() {
        if (checkForm()) {
            $(".apply_wizard").slideUp(800);
            $("#" + $(this).attr("data-next-id")).slideDown(800);
        }
    });

    $(".job_back_btn").click(function() {
        $(".apply_wizard").slideUp(800);
        $("#apply").slideDown(800);
    });

    var locale = document.getElementsByTagName("html")[0].getAttribute("lang");

    var applyFiles = function() {
        if (this.files.length <= 0) {
            if (locale == "en") {
                $(".choosen").html("No File Selected");
            }
            if (locale == "am") {
                $(".choosen").html("Ընտրված չէ");
            }
            if (locale == "ru") {
                $(".choosen").html("Файл не выбран");
            }
        } else {
            $(".choosen").empty();
            var val = $(this)
                    .val()
                    .toLowerCase(),
                regex = new RegExp("(.*?).(docx|doc|pdf)$");

            if (!regex.test(val)) {
                if (locale == "en") {
                    $(".choosen").html("No File Selected");
                }
                if (locale == "am") {
                    $(".choosen").html("Ընտրված չէ");
                }
                if (locale == "ru") {
                    $(".choosen").html("Файл не выбран");
                }
                return;
            }

            for (var i = 0; i < this.files.length; ++i) {
                $(".choosen").append($("<span>").html(this.files[i].name));
            }
        }
    };

    $('input[type="file"]')
        .each(function() {
            applyFiles.call(this);
        })
        .change(function() {
            applyFiles.call(this);
        });
});

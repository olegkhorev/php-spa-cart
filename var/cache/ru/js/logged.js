(function ($) {
  "use strict";
  $(document).ready(function () {
    if (page == "profile") profile_clicks();
  });
})($);

function profile_popup(url_add) {
  if (page != "profile") {
    var el = $(".profile_popup");
    el.css("opacity", 1).css("transform", "matrix(1.1, 0, 0, 1.1, 0, -70)");
    setTimeout(function () {
      el.css("transform", "matrix(1, 0, 0, 1, 0, 0)");
      setTimeout(function () {
        el.remove();
      }, 200);
    }, 200);

    if (url_add == "1") {
      aload();
      delay = 1;
    } else {
      delay = 350;
    }

    setTimeout(function () {
      bc = false;
      $("body").append(
        '<div class="load hidden"><span class="close close-popup">x</span></div>',
      );
      $.ajax({
        dataType: "json",
        url: "/profile/" + url_add,
        error: function () {
          alert(
            "We cannot process this request. Please, contact site administrator.",
          );
        },
        success: function (r) {
          $(".load").html('<span class="close close-popup">x</span>' + r[0]);
          unload();
          fade();
          $(".load").addClass("popup profile_popup").removeClass("load");
          var top =
            $(window).scrollTop() +
            $(window).height() / 2 -
            $(".profile_popup").height() / 2 -
            50;
          if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

          $(".profile_popup").css("top", top + "px");
          $(".profile_popup").css(
            "left",
            $(window).width() / 2 - $(".profile_popup").outerWidth() / 2 + "px",
          );
          $(".profile_popup")
            .css("opacity", 0)
            .css("transform", "matrix(0.1, 0, 0, 0.1, 0, 0)");
          setTimeout(function () {
            $(".profile_popup")
              .css("opacity", 1)
              .css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
            setTimeout(function () {
              $(".profile_popup").css("transform", "matrix(1, 0, 0, 1, 0, 0)");
            }, 200);
          }, 200);

          $(".profile_popup").show();
          $(window).resize(function () {
            var top =
              $(window).scrollTop() +
              $(window).height() / 2 -
              $(".profile_popup").height() / 2 -
              50;
            if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

            $(".profile_popup").css("top", top + "px");
            $(".profile_popup").css(
              "left",
              $(window).width() / 2 -
                $(".profile_popup").outerWidth() / 2 +
                "px",
            );
          });

          $(".profile_popup .close, .profile_popup .close_popup").on(
            "click",
            function () {
              removePopups();
            },
          );

          $(".profile_popup").on("click", function () {
            bc = false;
            bb = true;
          });

          ajax_clicks();
          profile_clicks();
          mdl_elements();
        },
      });
    }, delay);
  }

  return false;
}

function profile_clicks() {
  states_actions();
  $('form[name="user_form"]')
    .unbind("submit")
    .on("submit", function () {
      func_disable_button($('form[name="user_form"] button'));
      $.ajax({
        type: "POST",
        url: "/profile",
        data: $('form[name="user_form"]').serialize(), // serializes the form's elements.
        success: function (data) {
          func_disable_button($('form[name="user_form"] button'), 1);
          if (data == "Email") {
            alert("Enterd email already registered for another user");
          } else {
            alert("Your information has been successfully updated");
          }
        },
      });

      return false;
    });
}

function actions() {}

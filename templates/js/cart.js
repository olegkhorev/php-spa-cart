/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
function cart_actions() {
  init_translate();
  $(".cart-quantity").on("keyup", function () {
    var max = $(this).data("max");
    if ($(this).val() > max) $(this).val(max);
  });

  $(".clear-cart").on("click", function () {
    $.ajax({ url: "/cart/clear" }).done(function (r) {
      $("#minicart").html(r);
      $("#head_mobile #minicart, #minicart-mobile").html(r);
      cart_clicks();
      if (cart_checkout_own_page || mobile_screen > $(window).width()) {
        $("body").append(
          '<a class="ajax_link hidden click_history" href="/cart"></a>',
        );
    
        ajax_clicks();
        $(".click_history").click();
        $(".click_history").remove();
      }
    });
    removePopups();
    return false;
  });

  $(".update-cart").unbind("click").on("click", function (e) {
    func_disable_button($(".update-cart"));
    $.ajax({
      type: "POST",
      url: "/cart",
      data: $("#cartform").serialize(),
      success: function (data) {
        $(".cart-link").first().click();
      },
    });

    e.preventDefault();
    return false;
  });

  $(".remove-link").unbind("click").on("click", function () {
    var url = $(this).attr("href");
    $.ajax({ url: url }).done(function (r) {
      $("#minicart").html(r);
      $("#head_mobile #minicart, #minicart-mobile").html(r);
      if (cart_checkout_own_page || mobile_screen > $(window).width()) {
        $("body").append(
          '<a class="ajax_link hidden click_history" href="/cart"></a>',
        );

        ajax_clicks();
        $(".click_history").click();
        $(".click_history").remove();
      } else {
        removePopups();
      }
    });

    return false;
  });
}

function cart_clicks() {
  mdl_elements();
  $(".cart-link")
    .unbind("click")
    .on("click", function () {
      if (cart_checkout_own_page || mobile_screen > $(window).width()) {
        $("body").append(
          '<a class="ajax_link hidden click_history" href="/cart"></a>',
        );

        ajax_clicks();
        $(".click_history").click();
        $(".click_history").remove();
        return false;
      }

      $(".cart_popup").remove();
      if (!$(".checkout_popup").length) aload();

      $(".checkout_popup")
        .css("opacity", 1)
        .css("transform", "matrix(1.1, 0, 0, 1.1, 0, -70)");
      setTimeout(function () {
        $(".checkout_popup").css("transform", "matrix(1, 0, 0, 1, 0, 0)");
        setTimeout(function () {
          $(".checkout_popup").remove();
        }, 200);
      }, 200);

      $("body").append(
        '<div class="load hidden"><span class="close close-popup">x</span></div>',
      );
      $.ajax({
        dataType: "json",
        url: "/cart",
        error: function () {
          alert(
            "We cannot process this request. Please, contact site administrator.",
          );
        },
        success: function (r) {
          $(".load").html('<span class="close close-popup">x</span>' + r[0]);
          unload();
          fade();
          $(".load").addClass("popup cart_popup").removeClass("load");
          var top =
            $(window).scrollTop() +
            $(window).height() / 2 -
            $(".cart_popup").height() / 2 -
            50;
          if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

          $(".cart_popup").css("top", top + "px");
          $(".cart_popup img").on('load', function() {
            var top =
              $(window).scrollTop() +
              $(window).height() / 2 -
              $(".cart_popup").height() / 2 -
              50;
            if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;
          
            $(".cart_popup").css("top", top + "px");
          });

          $(".cart_popup").css(
            "left",
            $(window).width() / 2 - $(".cart_popup").outerWidth() / 2 + "px",
          );
          $(".cart_popup")
            .css("opacity", 0)
            .css("transform", "matrix(0.1, 0, 0, 0.1, 0, 0)");
          setTimeout(function () {
            $(".cart_popup")
              .css("opacity", 1)
              .css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
            setTimeout(function () {
              $(".cart_popup").css("transform", "matrix(1, 0, 0, 1, 0, 0)");
            }, 200);
          }, 200);

          $(".cart_popup").show();
          $(window).resize(function () {
            var top =
              $(window).scrollTop() +
              $(window).height() / 2 -
              $(".cart_popup").height() / 2 -
              50;
            if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

            $(".cart_popup").css("top", top + "px");
            $(".cart_popup").css(
              "left",
              $(window).width() / 2 - $(".cart_popup").outerWidth() / 2 + "px",
            );
          });

          $(".cart_popup .close, .cart_popup .close_popup").on(
            "click",
            function () {
              removePopups();
            },
          );

          $(".cart_popup").on("click", function () {
            bc = false;
            bb = true;
          });

          cart_actions();
          coupon_actions();
          cart_clicks();
          ajax_clicks();
        },
      });

      return false;
    });

  $(".wishlist-link")
    .unbind("click")
    .on("click", function () {
      $(".wl_popup").remove();
      $("body").append(
        '<div class="load hidden"><span class="close close-popup">x</span></div>',
      );
      $.ajax({
        dataType: "json",
        url: "/wishlist",
        error: function () {
          alert(
            "We cannot process this request. Please, contact site administrator.",
          );
        },
        success: function (r) {
          $(".load").html('<span class="close close-popup">x</span>' + r[0]);
          unload();
          fade();
          $(".load").addClass("popup wl_popup").removeClass("load");
          var top =
            $(window).scrollTop() +
            $(window).height() / 2 -
            $(".wl_popup").height() / 2 -
            50;
          if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

          $(".wl_popup").css("top", top + "px");
          $(".wl_popup img").on('load', function() {
            var top =
              $(window).scrollTop() +
              $(window).height() / 2 -
              $(".wl_popup").height() / 2 -
              50;
            if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;
          
            $(".wl_popup").css("top", top + "px");
          });

          $(".wl_popup").css(
            "left",
            $(window).width() / 2 - $(".wl_popup").outerWidth() / 2 + "px",
          );
          $(".wl_popup")
            .css("opacity", 0)
            .css("transform", "matrix(0.1, 0, 0, 0.1, 0, 0)");
          setTimeout(function () {
            $(".wl_popup")
              .css("opacity", 1)
              .css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
            setTimeout(function () {
              $(".wl_popup").css("transform", "matrix(1, 0, 0, 1, 0, 0)");
            }, 200);
          }, 200);

          $(".wl_popup").show();
          $(window).resize(function () {
            var top =
              $(window).scrollTop() +
              $(window).height() / 2 -
              $(".cart_popup").height() / 2 -
              50;
            if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

            $(".wl_popup").css("top", top + "px");
            $(".wl_popup").css(
              "left",
              $(window).width() / 2 - $(".cart_popup").outerWidth() / 2 + "px",
            );
          });

          $(".wl_popup .close, .wl_popup .close_popup").on(
            "click",
            function () {
              removePopups();
            },
          );

          $(".wl_popup").on("click", function () {
            bc = false;
            bb = true;
          });

          wl_actions();
          init_translate();
        },
      });

      return false;
    });

  $(".checkout-link")
    .unbind("click")
    .on("click", function () {
      if (cart_checkout_own_page || mobile_screen > $(window).width()) {
        $("body").append(
          '<a class="ajax_link hidden click_history" href="/checkout"></a>',
        );

        ajax_clicks();
        $(".click_history").click();
        $(".click_history").remove();
        return false;
      }

      if ($(".checkout_popup").length) {
        $(".checkout_popup").remove();
        aload();
      } else if (!$(".cart_popup").length) aload();

      $(".cart_popup")
        .css("opacity", 1)
        .css("transform", "matrix(1.1, 0, 0, 1.1, 0, -70)");
      setTimeout(function () {
        $(".cart_popup").css("transform", "matrix(1, 0, 0, 1, 0, 0)");
        setTimeout(function () {
          $(".cart_popup").remove();
        }, 200);
      }, 200);

      $("body").append(
        '<div class="load hidden"><span class="close close-popup">x</span></div>',
      );
      $.ajax({
        dataType: "json",
        url: "/checkout",
        error: function () {
          alert(
            "We cannot process this request. Please, contact site administrator.",
          );
        },
        success: function (r) {
          $(".load").html('<span class="close close-popup">x</span>' + r[0]);
          unload();
          fade();
          $(".load").addClass("popup checkout_popup").removeClass("load");
          var top =
            $(window).scrollTop() +
            $(window).height() / 2 -
            $(".checkout_popup").height() / 2 -
            50;
          if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

          $(".checkout_popup").css("top", top + "px");
          $(".checkout_popup").css(
            "left",
            $(window).width() / 2 -
              $(".checkout_popup").outerWidth() / 2 +
              "px",
          );
          $(".checkout_popup")
            .css("opacity", 0)
            .css("transform", "matrix(0.1, 0, 0, 0.1, 0, 0)");
          setTimeout(function () {
            $(".checkout_popup")
              .css("opacity", 1)
              .css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
            setTimeout(function () {
              $(".checkout_popup").css("transform", "matrix(1, 0, 0, 1, 0, 0)");
            }, 200);
          }, 200);

          $(".checkout_popup").show();
          $(window).resize(function () {
            var top =
              $(window).scrollTop() +
              $(window).height() / 2 -
              $(".checkout_popup").height() / 2 -
              50;
            if (top < $(window).scrollTop()) top = $(window).scrollTop() + 30;

            $(".checkout_popup").css("top", top + "px");
            $(".checkout_popup").css(
              "left",
              $(window).width() / 2 -
                $(".checkout_popup").outerWidth() / 2 +
                "px",
            );
          });

          $(".checkout_popup .close, .checkout_popup .close_popup").on(
            "click",
            function () {
              removePopups();
            },
          );

          $(".checkout_popup").on("click", function () {
            bc = false;
            bb = true;
          });

          checkout_actions();
          checkout_changes();
          $("#place_order *").attr("disabled", true);
          coupon_actions();
          cart_clicks();
          ajax_clicks();
        },
      });

      return false;
    });
}

var register_form = [];
register_form["firstname"] = "Vorname";
register_form["lastname"] = "Nachname";
register_form["email"] = "E-mail";
register_form["password"] = "Passwort";

register_form["address"] = "Adresse";
register_form["city"] = "Stadt";
register_form["zipcode"] = "Zip/Postal code";
register_form["phone"] = "Telefon";

(function ($) {
  "use strict";
  $(document).ready(function () {
    if (page == "checkout") {
      checkout_actions();
      coupon_actions();
      checkout_changes();
      $("#place_order *").attr("disabled", true);
    }
  });
})($);

function checkout_actions() {
  configure_stripe();
  states_actions();
  if ($("#same_address").is(":checked")) {
    $(".billing_address input").prop("required", false);
    $(".billing_address input").attr("required", false);
    $(".billing_address input").removeProp("required");
    $(".billing_address input").removeAttr("required");
  } else {
    $(".billing_address input").prop("required", true);
  }

  $("#same_address")
    .unbind("change")
    .change(function () {
      if ($(this).is(":checked")) {
        $(".billing_address input").prop("required", false);
        $(".billing_address input").attr("required", false);
        $(".billing_address input").removeProp("required");
        $(".billing_address input").removeAttr("required");
      } else {
        $(".billing_address input").prop("required", true);
      }

      $(".billing_address").toggle();
    });

  $("#paymentid").change(function () {
    if ($(this).val() == "2") {
      $("#cc-info").show();
      $("#place-order").hide();
    } else {
      $("#cc-info").hide();
      $("#place-order").show();
    }
  });

  $("#checkout_user_form")
    .unbind("submit")
    .on("submit", function (e) {
      e.preventDefault();
      var allgood = true;
      $("#checkout_user_form input").each(function () {
        var o = $(this);
        if (!o.val()) {
        }
      });

      if (!allgood) return false;

      $.ajax({
        type: "POST",
        url: "/checkout/user_form",
        data: $("#checkout_user_form").serialize(),
        success: function (data) {
          if (data == "Email") {
            alert("Enterd email already registered for another user");
          } else {
            $("#place_order").animate({ opacity: 1 }, 200);
            $("#place_order *").attr("disabled", false);
            $("#place_order").html(data);
            init_translate();
            checkout_actions();
            $("html, body").animate(
              {
                scrollTop: $("#checkoutform").offset().top - 200,
              },
              500,
            );
            if ($("#paymentid").val() == "2") $("#cc-info").show();
            mdl_elements();
          }
        },
      });

      return false;
    });

  $("#place_order button")
    .unbind("click")
    .on("click", function (e) {
      if ($("#paymentid").val() == 7) {
        aload();
        $(".checkout_popup").css("pointer-events", "auto");
        $.ajax({
          type: "POST",
          url: "/checkout/place_order",
          data: $("#checkoutform").serialize(),
          success: function (data) {
            stripe_lib
              .redirectToCheckout({
                // Make the id field from the Checkout Session creation API response
                // available to this file, so you can provide it as parameter here
                // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
                sessionId: data,
              })
              .then(function (result) {
                alert("Unable to redirect to Stripe");
                // If `redirectToCheckout` fails due to a browser or network
                // error, display the localized error message to your customer
                // using `result.error.message`.
              });
            alert("Please, wait we are connecting you to Stripe");
          },
        });

        return false;
      } else if ($("#paymentid").val() == "2") {
        aload();
        $(".checkout_popup").css("pointer-events", "none");
        hostedFieldsInstance_obj.tokenize(function (err, payload) {
          if (err) {
            unload();
            $(".checkout_popup").css("pointer-events", "auto");
            alert(err.message);
            console.error(err);
            return;
          }

          braintree.threeDSecure.create(
            {
              authorization: client_token,
              version: 2,
            },
            function (createError, threeDSecure) {
              threeDSecure.on("lookup-complete", function (data, next) {
                // check lookup data
                next();
              });

              threeDSecure.verifyCard(
                {
                  amount: $("#order_total").val(),
                  nonce: payload.nonce,
                  bin: payload.details.bin,
                  // other fields such as billing address
                },
                function (verifyError, payload) {
                  unload();
                  $(".checkout_popup").css("pointer-events", "auto");
                  if (verifyError) {
                    alert(verifyError.message);
                    if (
                      verifyError.code ===
                      "THREEDS_VERIFY_CARD_CANCELED_BY_MERCHANT "
                    ) {
                      // flow was cancelled by merchant, 3ds info can be found in the payload
                      // for cancelVerifyCard
                    }

                    return;
                  }

                  if (
                    "undefined" != typeof payload.verificationDetails &&
                    payload.verificationDetails.liabilityShiftPossible ==
                      false &&
                    payload.verificationDetails.liabilityShifted == false &&
                    this.isAcceptNo3dSecure == false
                  ) {
                  }

                  $("#payment-method-nonce").val(payload.nonce);
                  $.ajax({
                    type: "POST",
                    url: "/checkout/place_order",
                    data: $("#checkoutform").serialize(), // serializes the form's elements.
                    success: function (data) {
                      if (data == "Error") {
                        $(".checkout_popup").css("pointer-events", "auto");
                        unload();
                        $(".checkout_popup").css("pointer-events", "auto");
                        alert("Please, contact site administrator");
                      } else if (data == "StripeError") {
                        $("#stripe_token").val("");
                        $("#payment-method-nonce").val("");
                        $(".checkout_popup").css("opacity", 1);
                        alert("There was error processing your credit card");
                      } else {
                        self.location = "/invoice/" + data + "/success";
                      }
                    },
                  });
                },
              );
            },
          );
        });
      } else {
        $.ajax({
          type: "POST",
          url: "/checkout/place_order",
          data: $("#checkoutform").serialize(), // serializes the form's elements.
          success: function (data) {
            if (data == "Error") {
              alert("Please, contact site administrator");
            } else if (data == "StripeError") {
              $("#stripe_token").val("");
              $(".checkout_popup").css("opacity", 1);
              alert("There was error processing your credit card");
            } else if (strstr(data, "paypal.com")) {
              $(".checkout_popup").css("pointer-events", "none");
              $("body").append(data);
              document.paypalform.submit();
              alert("Bitte warten, wir verbinden Sie zu PayPal");
            } else {
              self.location = "/invoice/" + data + "/success";
            }
          },
        });
      }
    });

  $(".apply_gc").on("click", function () {
    bc = false;
    var id = alert('<div class="coupon_screen"></div>', 1, "", "coupon_alert");
    $(".coupon_screen").html(
      '<br/><div class="group"><input type="text" size="30" required /><span class="highlight"></span><span class="bar"></span><label>Geben Sie Ihre Geschenk-Karte-code-hier</label></div><div class="coupon-error"></div><button>Bewerben</button><br/><br/>',
    );
    $(".coupon_screen input").on("keyup", function () {
      $(".coupon-error").hide();
    });

    mdl_elements();
    $(".coupon_screen button").on("click", function () {
      if (!$(".coupon_screen input").val()) {
        func_highlight($(".coupon_screen input"));
        return false;
      }

      $.ajax({ url: "/checkout?gc=" + $(".coupon_screen input").val() }).done(
        function (r) {
          if (r == "S") {
            $(".coupon_alert").remove();
            refresh_coupon();
          } else {
            $(".coupon-error").html(r);
            $(".coupon-error").show();
          }
        },
      );
    });
  });

  $(".apply_coupon").on("click", function () {
    bc = false;
    var id = alert('<div class="coupon_screen"></div>', 1, "", "coupon_alert");
    $(".coupon_screen").html(
      '<div class="group"><input type="text" size="30" required /><span class="highlight"></span><span class="bar"></span><label>Geben Sie Ihren Gutschein-code hier</label></div><div class="coupon-error"></div><button>Bewerben</button><br/><br/>',
    );
    $(".coupon_screen input").on("keyup", function () {
      $(".coupon-error").hide();
    });

    mdl_elements();
    $(".coupon_screen button").on("click", function () {
      if (!$(".coupon_screen input").val()) {
        func_highlight($(".coupon_screen input"));
        return false;
      }

      $.ajax({
        url: "/checkout?coupon=" + $(".coupon_screen input").val(),
      }).done(function (r) {
        if (r == "S") {
          $(".coupon_alert").remove();
          refresh_coupon();
        } else {
          $(".coupon-error").html(r);
          $(".coupon-error").show();
        }
      });
    });
  });

  $("#local_pickup").change(function () {
    if ($(this).is(":checked")) {
      recalculate_shipping("L");
    } else {
      recalculate_shipping($('[name="shippingid"]').val());
    }
  });
}

function recalculate_shipping(shippingid) {
  $("#place_order").animate({ opacity: 0.6 }, 50);
  $("#place_order *").attr("disabled", true);
  $.ajax({
    type: "POST",
    url: "/checkout?shippingid=" + shippingid,
    success: function (data) {
      $("#place_order").animate({ opacity: 1 }, 200);
      $("#place_order *").attr("disabled", false);
      $("#place_order").html(data);
      checkout_actions();
      $("#paymentid").trigger("change");
    },
  });
}

function checkout_changes() {
  $("#checkout_user_form input").on("paste change keyup click", function () {
    $("#place_order *").attr("disabled", true);
    $("#place_order").css("opacity", 0.3);
  });

  $("#checkout_user_form select").change(function () {
    $("#place_order *").attr("disabled", true);
    $("#place_order").css("opacity", 0.3);
  });
}

function coupon_actions() {
  $(".remove_coupon").on("click", function () {
    $.ajax({ url: "/checkout/remove_coupon" }).done(function () {
      refresh_coupon();
    });
  });

  $(".remove_gc").on("click", function () {
    $.ajax({ url: "/checkout/remove_gc" }).done(function () {
      refresh_coupon();
    });
  });
}

function refresh_coupon() {
  if ($(".checkout_popup").is(":visible")) $(".checkout-link").click();
  else if ($(".cart_popup").is(":visible")) $(".cart-link").click();
  else window.location.reload();
}

var handler,
  stripe_loaded = false,
  stripe_lib;
function configure_stripe() {
  if (stripe_loaded) return;

  stripe_loaded = true;
  $.ajax({
    url: "https://js.stripe.com/v3/",
    dataType: "script",
    success: function () {
      stripe_lib = Stripe(stripe_key);
    },
  });
}

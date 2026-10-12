var $window = $(window),
  original_content,
  original_pageid,
  original_title,
  original_page,
  original_bread_crumbs,
  history_push = true,
  $animation_elements = $(
    ".page-container-2, .page-container-news, .page-container-blog",
  ),
  are_you_sure = "{lng[are_you_sure]}",
  mobile_screen = 850,
  instant_search_ajax,
  yes = "{lng[yes]}",
  no = "{lng[no]}",
  ok = "{lng[ok]}",
  chat_w = 0,
  alerts = Math.floor(Math.random() * 10000),
  at,
  bc = true,
  confirmed = false,
  ajaxed = false,
  hp = false,
  ie = window.navigator.appName == "Microsoft Internet Explorer",
  ff = navigator.userAgent.toLowerCase().indexOf("firefox") > -1,
  wid,
  rtm,
  cursor = [],
  $ = jQuery,
  pushed = false,
  original_content,
  original_title,
  original_bread_crumbs,
  body_loading_t,
  body_id,
  pushed_history_ok = false,
  mobile_design = false,
  dontloadfilter = false;

if (typeof window.janrain !== "object") window.janrain = {};
if (typeof window.janrain.settings !== "object") window.janrain.settings = {};

$(window).scroll(function () {
  on_scroll_header();
  scrolltop();
});

$(document).on("keyup", function (e) {
  if (e.keyCode == 27) {
    removePopups();
  }
});

(function ($) {
  "use strict";
  $(document).ready(function () {
    if ($("html.itsinvoicepage").length) return;

    if (!getCookie("allow_cookies") && !$("html.area-a").length) {
      $("body").append(
        '<div class="allow-cookies"><p>{lng[We use cookies for better user experience]}</p><button>{lng[Accept]}</button></div>',
      );
      $(".allow-cookies button").on("click", function () {
        $(".allow-cookies").remove();
        setCookie("allow_cookies", "1", 30);
      });
    }

    setInterval(function () {
      $.ajax({
        url: "/refresh",
      });
    }, 15000);

    body_id = $("body").attr("id");
    on_scroll_header();
    mobile_design = $("body").data("mobile");
    $("#subsform").on("submit", function () {
      var r = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if ($("#sub-email").val() && r.test($("#sub-email").val())) {
        $.ajax({
          url: "/subscribe?email=" + $("#sub-email").val(),
        }).done(function (r) {
          alert(r);
          $(".alert_message").css("top", "150px");
          unfade();
        });
      } else {
        func_highlight($("#subscribe"));
      }

      return false;
    });

    $(document).mousemove(function (e) {
      cursor = [e.pageX, e.pageY];
    });

    $(".alerts").on("click", function () {
      bc = false;
    });

    $(document).on("click", function () {
      if (bc != false) {
        $(".popup, .alert_message, .alerts").not(".login_alert").remove();
        $(".login_alert").hide();
        unfade();
      }

      bc = true;
    });

    $(".search input").on("focus", function () {
      if ($(this).val() == "Search") $(this).val("");
    });

    original_content = $(".ajax_container").html();
    original_title = $("title").html();
    original_page = page;
    original_bread_crumbs = $("#bread_crumbs_container").html();

    if (page == "home" || page == "category" || (page == "brands" && pageid))
      is_ajax_page = true;

    if (is_ajax_page) ajax_clicks();

    $(".currency_select a").on("click", function () {
      aload();
      $.ajax({
        url: "/set_currency/" + $(this).data("id"),
      }).done(function () {
        location.reload();
      });

      return false;
    });

    $(".language_select a").on("click", function () {
      aload();
      $.ajax({
        url: "/set_language/" + $(this).data("id"),
      }).done(function () {
        location.reload();
      });

      return false;
    });
    1;
    $(".currency_select select").change(function () {
      aload();
      $.ajax({
        url: "/set_currency/" + $(this).val(),
      }).done(function () {
        location.reload();
      });
    });

    $(".language_select select").change(function () {
      aload();
      $.ajax({
        url: "/set_language/" + $(this).val(),
      }).done(function () {
        location.reload();
      });
    });

    cart_clicks();
    original_pageid = pageid;
    instant_search();
    responsive_init();
    scrolltop();
  });
})($);

function ajax_clicks() {
  if ($("html.area-a").length) return;

  init_translate();
  $(".filter_switcher")
    .unbind("click")
    .on("click", function () {
      $("body").toggleClass("filteropen");
    });

  $("body").removeClass("filteropen");
  left_filter_max_height();
  mdl_elements();
  $animation_elements = $(
    ".page-container-2, .page-container-news, .page-container-blog",
  );
  $window.trigger("scroll");
  mobile_menu_clicked = true;
  mobile_menu_open();

  try {
    ga("set", "page", window.location.pathname);
    ga("send", "pageview");
  } catch (err) {}

  $(".searchform")
    .unbind("submit")
    .on("submit", function () {
      var substring = $(this).find('input[type="text"]').val();
      if (!substring) return false;

      if (mobile_design) {
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          500,
        );
      }

      var h = "/search?q=" + substring;
      if (!pushed) {
        pushed = true;
      }

      var site_loader_to = setTimeout(function () {
        $("body").append(
          '<div id="content-loading"><div class="cssload-container"><div class="cssload-speeding-wheel"></div></div></div>',
        );
      }, 1000);
      $.ajax({
        dataType: "json",
        url: h,
        error: function () {
          self.location = h;
        },
        success: function (r) {
          clearTimeout(site_loader_to);
          $("#content-loading").remove();
          $("body").attr("id", "body-search");
          $(".ajax_container").html(r[0]);
          $("#bread_crumbs_container").html(r[2]);
          ajax_clicks();
          if (history_push)
            window.history.pushState(
              {
                pageTitle: r[1],
                bread_crumbs: r[2],
                page: r[3],
                parentid: r[4],
                pageid: r[5],
              },
              "",
              h,
            );

          document.title = r[1];
          proceed_clicks(r[3]);
          tabs_clicks();
        },
      });

      return false;
    });

  if ($(".exec_page_js").length) {
    eval($(".exec_page_js").html());
  }

  $(
    "#menu a, a.ajax_link, .ajax_mobile_link, .logo-link, .bread_crumbs a, #subcategories a, .brands a, .test-links a, .foot a",
  )
    .unbind("click")
    .on("click", function (e) {
      if ($(this).hasClass("no-ajax")) return true;

      if ($(this).closest(".product_popup").length) $(".fade").click();

      if (mobile_design) {
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          500,
        );
        mobile_menu_clicked = false;
        $(".mobile-left_menu").animate({ left: -500 }, 500);
      } else {
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          500,
        );
      }

      var h = $(this).attr("href");
      if (!pushed) {
        pushed = true;
      }

      var site_loader_to = setTimeout(function () {
        $("body").append(
          '<div id="content-loading"><div class="cssload-container"><div class="cssload-speeding-wheel"></div></div></div>',
        );
      }, 1000);

      $.ajax({
        dataType: "json",
        url: create_ajax_link(h),
        error: function () {
          self.location = h;
        },
        success: function (r) {
          clearTimeout(site_loader_to);
          $("#content-loading").remove();
          if (r[6]) $("body").attr("id", "body-module-" + r[6]);
          else $("body").attr("id", "body-" + r[3]);

          $(".ajax_container").html(r[0]);

          $("#bread_crumbs_container").html(r[2]);
          ajax_clicks();
          page = r[3];
          if (history_push)
            window.history.pushState(
              {
                pageTitle: r[1],
                bread_crumbs: r[2],
                page: r[3],
                parentid: r[4],
                pageid: r[5],
                moduleid: r[6],
              },
              "",
              h,
            );

          document.title = r[1];
          pageid = r[5];
          recalc_menus(r[3], r[4]);
          proceed_clicks(r[3]);
          tabs_clicks();
          history_push = true;
        },
      });

      return false;
    });

  try {
    login_clicks();
    register_actions();
  } catch (err) {}

  try {
    profile_clicks();
  } catch (err) {}

  contact_form();
}

function contact_form() {
  $("#body-help .submit_help")
    .unbind("click")
    .on("click", function () {
      var allgood = true;
      $("#help_form input").each(function () {
        if (!$(this).val()) {
          $(this).addClass("error");
          allgood = false;
        }
      });

      $("#help_form textarea").each(function () {
        if (!$(this).val()) {
          $(this).addClass("error");
          allgood = false;
        }
      });

      if (allgood) document.help.submit();
    });
}

window.onpopstate = function (e) {
  if (current_area == "A") {
    $("body").append(
      '<a class="ajax_link hidden click_history" href="' +
        window.location.href +
        '"></a>',
    );
    ajax_clicks_admin();
    history_push = false;
    $(".click_history").click();
    $(".click_history").remove();
    return;
  }

  if (is_ajax_page) {
    $("body").append(
      '<a class="ajax_link hidden click_history" href="' +
        window.location.href +
        '"></a>',
    );
    ajax_clicks();
    history_push = false;
    $(".click_history").click();
    $(".click_history").remove();
  }
};

function proceed_clicks(whats_page) {
  if (
    whats_page == "category" ||
    whats_page == "search" ||
    (whats_page == "brands" && pageid)
  ) {
    $("body").addClass("withfilter");
    if (dontloadfilter) dontloadfilter = false;
    else load_filter();
  } else {
    $("body").removeClass("withfilter");
  }

  products_clicks();
  banners();
  product_clicks();
  filter_clicks();
  cart_actions();
  coupon_actions();
  cart_clicks();
  checkout_actions();
}

$(window).resize(function () {
  if ($(".fade").length > 0) fade();
});

function aload() {
  $(".loading").show();
}

function unload() {
  $(".loading").hide();
}

function alert(message, nook, h, classes, noshake, alert2, nofade) {
  clearTimeout(at);
  var id = alerts;
  if (alert2)
    $("body").append(
      '<div class="alert_message ' +
        classes +
        '" id="a' +
        id +
        '" tabindex="' +
        id +
        '"><div class="background"></div><div class="alert_content"><span class="close_alert">x</span>' +
        message +
        (nook ? "" : '<div class="close-alert"><button>' + ok + "</button>") +
        "</div></div>",
    );
  else {
    if (!nofade) fade();

    bc = false;
    $("body").append(
      '<div class="alert_message ' +
        classes +
        '" id="a' +
        id +
        '" tabindex="' +
        id +
        '"><span class="close_alert">x</span>' +
        message +
        (nook ? "" : '<div class="close-alert"><button>' + ok + "</button>") +
        "</div></div>",
    );
  }

  if (noshake == 2) {
    $("#a" + id).hide();
    $("#a" + id).show();
  }

  $("#a" + id + " .close_alert").on("click", function () {
    var othis = $(this);
    bc = false;
    if (alert2) var e = $(this).parent().parent();
    else var e = $(this).parent();

    e.css("opacity", 1).css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
    setTimeout(function () {
      e.css("transform", "matrix(1, 0, 0, 1, 0, 0)");
      if (
        othis.closest(".login_alert").length ||
        othis.closest(".register_alert").length
      )
        unfade();

      if (
        !$(".popup").length &&
        !$(".register_alert").length &&
        !$(".login_alert").length
      )
        unfade();

      setTimeout(function () {
        e.remove();
      }, 200);
    }, 200);
  });

  $("#a" + id + " .close-alert button").on("click", function () {
    bc = false;
    bb = true;
    var e = $("#a" + id);
    e.css("opacity", 1).css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
    setTimeout(function () {
      e.css("transform", "matrix(1, 0, 0, 1, 0, 0)");
      if (
        !$(".popup").length &&
        !$(".register_alert").length &&
        !$(".login_alert").length
      )
        unfade();

      setTimeout(function () {
        e.remove();
      }, 200);
    }, 200);
  });

  $(".alert_message").on("click", function () {
    bc = false;
    bb = true;
  });

  if (h)
    at = setTimeout(function () {
      $("#a" + id).fadeOut();
      unfade();
    }, 5000);

  $("#a" + id).focus();
  $("#a" + id).on("keyup", function (e) {
    if (e.which == 27) {
      $("#a" + id).hide();
      if (!$(".popup").length) unfade();
    }
  });

  alerts += 1;

  return id;
}

function confirm(text, o, goto) {
  if (!text) text = are_you_sure;

  $(".confirm").remove();
  bc = false;
  alert(
    text +
      '<br /><br /><button class="yes">' +
      yes +
      '</button> <button onclick="javascript: $(\'.confirm\').remove(); unfade();" class="no">' +
      no +
      "</button>",
    1,
    "",
    "confirm",
    2,
  );
  $(".confirm").focus();
  $(".confirm .yes").on("click", function () {
    bc = false;
    confirmed = true;
    if (goto) self.location = goto;
    else o.trigger("click");

    unfade();
    $(".confirm").remove();
    confirmed = false;
  });

  $(".confirm").keydown(function (e) {
    if (e.which == 13) $(".confirm .yes").trigger("click");
    else if (e.which == 27) $(".confirm .no").trigger("click");
  });
}

function fade() {
  if ($(".fade").length == 0) {
    $("html").prepend('<div class="fade"></div>');
    $(".fade").show();
  }

  $(".fade")
    .unbind("click")
    .on("click", function () {
      bc = false;
      removePopups();
    });
}

function removePopups(no_unfade) {
  if (current_area == "C")
    setTimeout(function () {
      if ($("#body-product").length) {
        oid = 0;
        product_clicks();
      }
    }, 500);

  if (no_unfade) {
    $(".popup, .alert, .alert_message:not(.not_remove)").remove();
    return;
  }

  $(".popup, .alert, .alert_message")
    .css("opacity", 1)
    .css("transform", "matrix(1.1, 0, 0, 1.1, 0, 70)");
  setTimeout(function () {
    $(".popup, .alert, .alert_message").css(
      "transform",
      "matrix(1, 0, 0, 1, 0, 0)",
    );
    unfade();

    setTimeout(function () {
      $(".popup, .alert, .alert_message:not(.not_remove)").remove();
    }, 200);
  }, 200);
}

function unfade() {
  clearTimeout(at);
  if (
    ($(".checkout_popup").is(":visible") ||
      $(".product_popup").is(":visible")) &&
    ($(".login_alert").is(":visible") || $(".register_alert").is(":visible"))
  ) {
    setTimeout(function () {
      if (
        !$(".checkout_popup").is(":visible") &&
        !$(".product_popup").is(":visible")
      ) {
        $(".prev").remove();
        $(".fade").remove();
      }
    }, 500);
    return;
  }

  $(".fade").remove();
}

function price_format(price, thousand_delim, decimal_delim, precision) {
  var thousand_delim =
    arguments.length > 1 && thousand_delim !== false ? thousand_delim : "";
  var decimal_delim =
    arguments.length > 2 && decimal_delim !== false ? decimal_delim : ".";
  var precision = arguments.length > 3 && precision !== false ? precision : "2";

  if (precision > 0) {
    precision = Math.pow(10, precision);
    price = Math.round(price * precision) / precision;
    var top = Math.floor(price);
    var bottom = Math.round((price - top) * precision) + precision;
  } else {
    var top = Math.round(price);
    var bottom = 0;
  }

  top = top + "";
  bottom = bottom + "";
  var cnt = 0;
  for (var x = top.length; x >= 0; x--) {
    if (cnt % 3 == 0 && cnt > 0 && x > 0)
      top = top.substr(0, x) + thousand_delim + top.substr(x, top.length);

    cnt++;
  }

  return bottom > 0
    ? top + decimal_delim + bottom.substr(1, bottom.length)
    : top;
}

function IsNumeric(num) {
  return num >= 0 || num < 0;
}

function wl_actions() {
  $(".clear-wl").on("click", function () {
    $.ajax({ url: "/wishlist/clear" }).done(function (r) {});
    removePopups();
    return false;
  });

  $(".remove-wl-link").on("click", function () {
    var url = $(this).attr("href");
    $.ajax({ url: url }).done(function (r) {
      $(".wishlist-link").click();
    });

    return false;
  });
}

function setCookie(cn, v, ed, seconds) {
  if (seconds) {
    var date = new Date(new Date().getTime() + ed * 1000);
    document.cookie =
      cn +
      "=" +
      v +
      (ed == null ? "" : "; expires=" + date.toUTCString()) +
      "; path=/;"; //
  } else {
    var e = new Date();
    e.setDate(e.getDate() + ed);
    document.cookie =
      cn +
      "=" +
      v +
      (ed == null ? "" : "; expires=" + e.toUTCString()) +
      "; path=/;";
  }
}

function getCookie(cn) {
  var i,
    x,
    y,
    a = document.cookie.split(";");
  for (i = 0; i < a.length; i++) {
    x = a[i].substr(0, a[i].indexOf("="));
    y = a[i].substr(a[i].indexOf("=") + 1);
    x = x.replace(/^\s+|\s+$/g, "");
    if (x == cn) return y;
  }
}

function func_highlight(el) {
  if ($("html.area-c").length) {
    el.addClass("error");
    return;
  }

  el.css("background", "#ff3000");
  setTimeout(function () {
    el.css("background", "#fff");
    setTimeout(function () {
      el.css("background", "#ff3000");
      setTimeout(function () {
        el.css("background", "#fff");
      }, 200);
    }, 200);
  }, 100);
}

function print_invoice(el) {
  $("#iframe-invoice").remove();
  $(
    "<iframe id='iframe-invoice' name='invoice' style='height: 0px; width: 0px;' src='" +
      el.attr("href") +
      "' />",
  ).appendTo("body");
  $("#iframe-invoice").on("load", function () {
    window.frames["invoice"].focus();
    window.frames["invoice"].print();
  });

  return false;
}

function strstr(haystack, needle, bool) {
  var pos = 0;

  pos = haystack.indexOf(needle);
  if (pos == -1) return false;
  else {
    if (bool) return haystack.substr(0, pos);
    else return haystack.slice(pos);
  }
}

function recalc_menus(pg, pi) {
  $(".menu-container li").removeClass("active");
  if (pi) {
    $("li#menu-" + pi).addClass("active");
  } else {
    $("li#menu-" + pg).addClass("active");
  }
}

function on_scroll_header() {
  if ($("body").data("mobile") || $("body").hasClass("admin-area")) return;

  if ($(this).scrollTop() > 190) {
    $("body").addClass("scrolled");
  } else {
    $("body").removeClass("scrolled");
  }
}

function instant_search() {
  $(".search input")
    .unbind("focus")
    .on("focus", function () {
      var val = $(this).val();
      if (val.length < 2) {
        $(".instant-search").html(
          "<div class='enter-3-chars'>{lng[Enter at least 2 characters]}</div>",
        );
        return;
      }

      setTimeout(function () {
        search_instant(val);
      }, 300);
    });

  $(".search")
    .unbind("mouseleave")
    .mouseleave(function () {
      $(".instant-search").fadeOut();
    });

  $(".search input").on("keyup", function () {
    if ($(this).val().length < 2) {
      $(".instant-search").html(
        "<div class='enter-3-chars'>{lng[Enter 2 characters]}</div>",
      );
      return;
    }

    search_instant($(this).val());
  });
}

function search_instant(val) {
  try {
    instant_search_ajax.abort();
  } catch (err) {}

  instant_search_ajax = $.ajax({
    url: "/instant_search?q=" + encodeURIComponent(val),
  }).done(function (r) {
    $(".instant-search").html(r);
    $(".instant-search").show();
    ajax_clicks();
    $(".did-you-mean span").on("click", function () {
      $('#searchform input[type="text"]').val($(this).text());
      search_instant($(this).text());
    });

    $(".more-no-search").on("click", function () {
      if (mobile_screen > $(window).width()) {
        $(".searchform_desktop").submit();
      } else $(".searchform_mobile").submit();

      $(".instant-search").hide();
    });
  });
}

function responsive_init() {
  $(".navigation-toggle").on("click", function () {
    mobile_menu_open();
    $("body").removeClass("filteropen");
  });
}

var mobile_menu_clicked = false;
$(".mobile-menu-fade").on("click", function () {
  mobile_menu_open();
});

function mobile_menu_open() {
  if (mobile_menu_clicked) {
    mobile_menu_clicked = false;
    $(".mobile-left_menu").animate({ left: -500 }, 500);
    $(".navigation-toggle").removeClass("is-active");
    $(".mobile-menu-fade").fadeOut();
  } else {
    var top = $(window).scrollTop() + 80;
    $(".mobile-left_menu").css("top", top + "px");
    mobile_menu_clicked = true;
    $(".mobile-left_menu").animate({ left: 0 }, 500);
    $(".navigation-toggle").addClass("is-active");
    $(".mobile-menu-fade").fadeIn();
  }
}

function create_ajax_link(href) {
  try {
    if (href.indexOf("?") == -1) {
      href = href + "?its_ajax_page=1";
    } else {
      href = href + "&its_ajax_page=1";
    }
  } catch (err) {}

  return href;
}

function scrolltop() {
  if ($(window).scrollTop() > 100) $("#scrolltop").show();
  else $("#scrolltop").hide();

  $("#scrolltop")
    .unbind("click")
    .on("click", function () {
      $("html, body").animate(
        {
          scrollTop: 0,
        },
        500,
      );
    });
}

function check_if_in_view() {
  return false;
  var window_height = $window.height();
  var window_top_position = $window.scrollTop();
  var window_bottom_position = window_top_position + window_height;

  $.each($animation_elements, function () {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = element_top_position + element_height;

    //check to see if this current container is within viewport
    if (
      element_bottom_position >= window_top_position &&
      element_top_position <= window_bottom_position
    ) {
      $element.addClass("in-view");
    } else {
    }
  });
}

function close_ticket(id, what) {
  if (what == "1") {
    $("#ticket-status-" + id).html("{lng[Closed]}");
    var sid = "C";
    alert("Ticket closed");
  } else {
    $("#ticket-status-" + id).html("{lng[Cancelled]}");
    alert("Ticket cancelled");
    var sid = "3";
  }

  $("#ticket-status-links-" + id).html("");
  $.ajax({ url: "/ticket/status/" + id + "/" + sid });
}

$("body").on("keyup focus", function (event) {
  if (
    $(event.target).prop("nodeName").toLowerCase() == "input" ||
    $(event.target).prop("nodeName").toLowerCase() == "textarea"
  ) {
    $(event.target).removeClass("error");
  }
});

function mdl_elements() {
  $("div.group:not(.mdl_element)").each(function () {
    $(this).addClass("mdl_element");
    if ($(this).find("input").val()) {
      $(this).addClass("withval");
    }

    $(this)
      .find("input")
      .on("input", function () {
        if ($(this).val()) {
          $(this).parent().addClass("withval");
        } else $(this).parent().removeClass("withval");
      });

    if ($(this).find("textarea").val()) {
      $(this).addClass("withval");
    }

    $(this)
      .find("textarea")
      .on("input", function () {
        if ($(this).val()) {
          $(this).parent().addClass("withval");
        } else $(this).parent().removeClass("withval");
      });
  });
}

function init_translate() {
  $(".translate")
    .unbind("click")
    .on("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      var lbl = $(this).find(".hidden.translate-phrase").html(),
        word = $(this).find(".hidden.word").html();
      alert(
        '<textarea id="translate_me">' +
          lbl +
          '</textarea><div class="close-alert"><button>Save</button></div>',
        "1",
        "",
        "translate-alert",
      );
      $(".translate-alert").on("click", function () {
        $.ajax({
          url:
            "/translate?lbl=" +
            encodeURIComponent(word) +
            "&translate=" +
            encodeURIComponent($(".translate-alert textarea").val()),
        });
      });
    });
}

function str_replace(search, replace, subject) {
  return subject.split(search).join(replace);
}

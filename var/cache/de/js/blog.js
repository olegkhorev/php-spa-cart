/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
function go_to_comments() {
  $("html, body").animate(
    {
      scrollTop: $("#blog_comments_section").offset().top - 90,
    },
    500,
  );
}

function leave_comments() {
  $("html, body").animate(
    {
      scrollTop: $("#blog_bb_buttons").offset().top - 120,
    },
    500,
  );
}

function quote_comment_html(id, name) {
  $("#newrecord").html(
    '<div class="quote_blog_post_comment">' +
      $("#comment_" + id).html() +
      "</div><br />",
  );
  $("html, body").animate(
    {
      scrollTop: $("#blog_bb_buttons").offset().top - 120,
    },
    500,
  );

  moveCursorToEnd($("#newrecord")[0]);
}

function new_comment() {
  document.blogform.comment.value = $("#newrecord").html();
  if (!document.blogform.comment.value) {
    alert("Bitte geben Sie Ihrem Kommentar.");
    document.blogform.comment.focus();
    return false;
  }

  if (document.blogform.new_name && !document.blogform.new_name.value) {
    alert("Bitte geben Sie Ihren Namen");
    document.blogform.new_name.focus();
    return false;
  }

  document.blogform.submit();
}

var doc = document,
  blog_bb_link_clicked = false;
function iBold() {
  doc.execCommand("bold", false, null);
}

function iUnderline() {
  doc.execCommand("underline", false, null);
}

function iItalic() {
  doc.execCommand("italic", false, null);
}

function iLinkClick() {
  var n = window.getSelection().anchorNode;
  if (n) {
    n = n.parentNode;
    var l = $("#iLinkClickA")[0];
    if (n.nodeName.toLowerCase() == "a") {
      $("#iLinkClickA").removeClass("clicked_bb_a");
      doc.execCommand("Unlink", false, null);
    } else {
      $("#iLinkClickA").addClass("clicked_bb_a");
      doc.execCommand("createLink", false, prompt("Link URL:", "https://"));
    }
  }
}

function moveCursorToEnd(element) {
  // Focus the element first
  element.focus();

  // Check if the browser supports Selection API
  if (
    typeof window.getSelection !== "undefined" &&
    typeof document.createRange !== "undefined"
  ) {
    const range = document.createRange();

    // Select all the contents inside the element
    range.selectNodeContents(element);

    // Collapse the range to the end point (false = collapse to end, true = collapse to start)
    range.collapse(false);

    const selection = window.getSelection();

    // Clear any current text selections
    selection.removeAllRanges();

    // Add the new range which places the cursor at the end
    selection.addRange(range);
  }
}

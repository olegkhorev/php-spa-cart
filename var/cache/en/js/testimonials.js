/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
function check_new_testimonial() {
  var error = false;

  if (!$("#testimonial_name").val()) {
    func_highlight($("#testimonial_name"));
    error = true;
  }

  if (!$("#testimonial_message").val()) {
    func_highlight($("#testimonial_message"));
    error = true;
  }

  if (error) return false;
}

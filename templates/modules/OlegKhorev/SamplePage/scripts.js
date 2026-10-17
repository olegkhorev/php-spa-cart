/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
function init_sample_page() {
  $(".sample-page-execute_module_button")
    .unbind("click")
    .on("click", function () {
      alert("{lng[Hello world!]}");
    });
}

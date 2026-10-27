/**
* Flirtle
* Copyright (c) Flirtle.com
*
* Released under the ... License.
* https://flirtle.com
*/
(function($) {
    const originalFocus = $.fn.focus;
    const originalBlur  = $.fn.blur;
    $.fn.focus = function(handler) {
        if (typeof handler === 'function') {
            return originalFocus.apply(this, arguments);
        }

        return originalFocus.apply(this, arguments);
    };

    $.fn.blur = function(handler) {
        if (typeof handler === 'function') {
            return originalBlur.apply(this, arguments);
        }

        return originalBlur.apply(this, arguments);
    };

})(jQuery);
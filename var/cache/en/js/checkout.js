var register_form = [];

register_form['firstname'] = "Firstname";

register_form['lastname'] = "Lastname";

register_form['email'] = "E-mail";

register_form['password'] = "Password";



register_form['address'] = "Address";

register_form['city'] = "City";

register_form['zipcode'] = "Zip/Postal code";

register_form['phone'] = "Phone";



(function($) {

"use strict";

  $(document).ready(function() {

	if (page == 'checkout') {
		checkout_actions();

		coupon_actions();

		checkout_changes();

		$('#place_order *').attr('disabled', true);

	}

  });

})($);
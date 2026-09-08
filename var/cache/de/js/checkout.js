var register_form = [];

register_form['firstname'] = "Vorname";

register_form['lastname'] = "Nachname";

register_form['email'] = "E-mail";

register_form['password'] = "Passwort";



register_form['address'] = "Adresse";

register_form['city'] = "Stadt";

register_form['zipcode'] = "Zip/Postal code";

register_form['phone'] = "Telefon";



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
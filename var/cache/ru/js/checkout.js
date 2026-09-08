var register_form = [];

register_form['firstname'] = "Имя";

register_form['lastname'] = "Фамилия";

register_form['email'] = "Электронная почта";

register_form['password'] = "Пароль";



register_form['address'] = "Адрес";

register_form['city'] = "Город";

register_form['zipcode'] = "Почтовый индекс";

register_form['phone'] = "Телефон";



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
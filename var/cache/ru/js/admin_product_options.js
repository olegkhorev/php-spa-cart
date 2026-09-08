(function($) {
"use strict";
	$('#data_type').change(function() {
		if ($(this).val() == 'g') {
			$('#data_view_type').html("<option value='s'>Поле выбора</option><option value='p'>Квадраты</option>");
		} else {
			$('#data_view_type').html("<option value='t'>Текстовая область</option><option value='i'>Поле ввода</option>");
		}
	});
})($);

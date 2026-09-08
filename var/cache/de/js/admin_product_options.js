(function($) {
"use strict";
	$('#data_type').change(function() {
		if ($(this).val() == 'g') {
			$('#data_view_type').html("<option value='s'>Select-box</option><option value='p'>Quadrate</option>");
		} else {
			$('#data_view_type').html("<option value='t'>Textbereich</option><option value='i'>Eingabefeld</option>");
		}
	});
})($);

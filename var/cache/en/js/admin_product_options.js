(function($) {
"use strict";
	$('#data_type').change(function() {
		if ($(this).val() == 'g') {
			$('#data_view_type').html("<option value='s'>Select box</option><option value='p'>Squares</option>");
		} else {
			$('#data_view_type').html("<option value='t'>Text area</option><option value='i'>Input box</option>");
		}
	});
})($);

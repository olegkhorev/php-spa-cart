(function($) {
"use strict";
	$('#data_type').change(function() {
		if ($(this).val() == 'g') {
			$('#data_view_type').html("<option value='s'>Sélectionnez la boîte</option><option value='p'>Carrés</option>");
		} else {
			$('#data_view_type').html("<option value='t'>Zone de texte</option><option value='i'>Zone de saisie</option>");
		}
	});
})($);

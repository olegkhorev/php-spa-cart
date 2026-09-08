function submit_category() {
	if (!document.category_form.title.value) {
		alert("Bitte geben Sie Kategorie, Titel");

		bc = false;
		document.category_form.title.focus();

	} else

		document.category_form.submit();
}
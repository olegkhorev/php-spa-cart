function submit_category() {
	if (!document.category_form.title.value) {
		alert("S'il vous plaît, entrez titre de la catégorie");

		bc = false;
		document.category_form.title.focus();

	} else

		document.category_form.submit();
}
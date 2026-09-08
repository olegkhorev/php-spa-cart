function submit_category() {
	if (!document.category_form.title.value) {
		alert("Пожалуйста, введите название категории");

		bc = false;
		document.category_form.title.focus();

	} else

		document.category_form.submit();
}
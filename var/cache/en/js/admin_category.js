function submit_category() {
	if (!document.category_form.title.value) {
		alert("Please, enter category title");

		bc = false;
		document.category_form.title.focus();

	} else

		document.category_form.submit();
}
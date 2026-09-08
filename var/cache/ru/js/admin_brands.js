function submitBrand() {
	if (document.brandform.name.value == '') {
		document.brandform.name.focus();
		bc = false;
		alert("Название бренда не может отсутствовать");
	} else
		document.brandform.submit();
}
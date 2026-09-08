function submitBrand() {
	if (document.brandform.name.value == '') {
		document.brandform.name.focus();
		bc = false;
		alert("Brand-name kann nicht leer sein");
	} else
		document.brandform.submit();
}
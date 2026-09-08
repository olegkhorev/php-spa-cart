function submitBrand() {
	if (document.brandform.name.value == '') {
		document.brandform.name.focus();
		bc = false;
		alert("Brand name cannot be empty");
	} else
		document.brandform.submit();
}
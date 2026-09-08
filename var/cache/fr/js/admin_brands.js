function submitBrand() {
	if (document.brandform.name.value == '') {
		document.brandform.name.focus();
		bc = false;
		alert("Le nom de la marque ne peut pas être vide");
	} else
		document.brandform.submit();
}
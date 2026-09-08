var helptext = [];

helptext['b'] = "Жирным";

helptext['i'] = "Наклон";

helptext['u'] = "Подчеркнуто";

helptext['s'] = "Зачеркнуто";

helptext['url'] = "Ссылка";

helptext['email'] = "Почта";

helptext['img'] = "Картинка";

helptext['list'] = "Лист";

helptext['li'] = "Элемент листа";

helptext['quote'] = "Цитата";

helptext['code'] = "Код";



function bbcode(open, end) {

	var tArea = document.blogform.comment;

	var isIE = (document.all)? true : false;

	var open = (open)? open : "";

	var end = (end)? end : "";

	if (isIE) {

		tArea.focus();

		var curSelect = document.selection.createRange();

		if (arguments[2])

			curSelect.text = open + arguments[2] + "]" + curSelect.text + end;

		else

			curSelect.text = open + curSelect.text + end;

	} else if(!isIE && typeof tArea.selectionStart != "undefined") {

		var selStart = tArea.value.substr(0, tArea.selectionStart);

		var selEnd = tArea.value.substr(tArea.selectionEnd, tArea.value.length);

		var curSelection = tArea.value.replace(selStart, '').replace(selEnd, '');



		if (arguments[2])

			tArea.value = selStart + open + arguments[2] + "]" + curSelection + end + selEnd;

		else

			tArea.value = selStart + open + curSelection + end + selEnd;

	} else

		tArea.value += (arguments[2])? open + arguments[2] + "]" + end : open + end;

}



function bbhelp(text) {

	if (text)

		document.getElementById('helptext').value = helptext[text];

	else

		document.getElementById('helptext').value = '';

}
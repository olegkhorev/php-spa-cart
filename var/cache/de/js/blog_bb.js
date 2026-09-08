var helptext = [];

helptext['b'] = "blog_bbcode_b";

helptext['i'] = "blog_bbcode_i";

helptext['u'] = "blog_bbcode_u";

helptext['s'] = "blog_bbcode_s";

helptext['url'] = "blog_bbcode_url";

helptext['email'] = "blog_bbcode_email";

helptext['img'] = "blog_bbcode_img";

helptext['list'] = "blog_bbcode_list";

helptext['li'] = "blog_bbcode_li";

helptext['quote'] = "blog_bbcode_quote";

helptext['code'] = "blog_bbcode_code";



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
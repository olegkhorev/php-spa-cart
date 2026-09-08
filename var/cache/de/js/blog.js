function quote_comment(id, name) {

	var text = document.getElementById('comment_'+id).innerHTML;



	text = str_replace("&gt;", ">", text);

	text = str_replace("&lt;", "<", text);



	document.blogform.comment.value += '[quote='+name+']'+text+'[/quote]'+"\n\n";



    $('html, body').animate({

        scrollTop: $('[name="comment"]').offset().top

    }, 500);



	document.blogform.comment.focus();

}



function new_comment() {

	if (!document.blogform.comment.value) {

		alert("Bitte geben Sie Ihrem Kommentar.");

		document.blogform.comment.focus();

		return false;

	}



	if (document.blogform.new_name && !document.blogform.new_name.value) {

		alert("Bitte geben Sie Ihren Namen");

		document.blogform.new_name.focus();

		return false;

	}



	document.blogform.submit();

}
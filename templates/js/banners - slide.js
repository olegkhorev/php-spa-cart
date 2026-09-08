var current_banner = 1,	banners_count, banners_delay = 10000, banners_interval;

$(document).ready(function() {	banners();
});

function banners() {
	current_banner = 1;
	clearInterval(banners_interval);
	banners_interval = setInterval("rotate_banners()", banners_delay);
	banners_count = $('#banners li').size();
    $('#banners').mouseenter(function() {
    	clearInterval(banners_interval);
    });

    $('#banners').mouseleave(function() {
    	banners_interval = setInterval("rotate_banners()", banners_delay);
    });

	$('#banners_nav img').click(function() {
		clearInterval(banners_interval);
		var i = $(this).attr('id').replace('g2b_', ''),
			ml = -(i * 730);

/*		if (current_banner < i)
			ml = -((i - current_banner) * 730);
		else
			ml = (i - current_banner) * 730;
*/
		bc = false;
//		alert(current_banner+'|'+ml);
		current_banner = i;

		$('#banners_nav img').removeClass('active');
		$(this).addClass('active');
		$("#banners ul").animate({marginLeft:ml},1000,function(){
//			$(this).find("li:last").after($(this).find("li:first"));
//			$(this).css({marginLeft:0});
		})
	});
}

function rotate_banners() {			$("#banners ul").animate({marginLeft:(current_banner*-730)},1000,function(){
//				$(this).find("li:last").after($(this).find("li:first"));
//				$(this).css({marginLeft:0});
				current_banner++;
				$('#banners_nav img').removeClass('active');
				$('#g2b_'+(current_banner-1)).addClass('active');
				if (current_banner == banners_count)					current_banner = 0;
			})
}
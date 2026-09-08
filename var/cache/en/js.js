/*!
 * jQuery UI Tooltip 1.9.1
 * http://jqueryui.com
 *
 * Copyright 2012 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/tooltip/
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	jquery.ui.position.js
 */
(function( $ ) {

var increments = 0;

function addDescribedBy( elem, id ) {
	var describedby = (elem.attr( "aria-describedby" ) || "").split( /\s+/ );
	describedby.push( id );
	elem
		.data( "ui-tooltip-id", id )
		.attr( "aria-describedby", $.trim( describedby.join( " " ) ) );
}

function removeDescribedBy( elem ) {
	var id = elem.data( "ui-tooltip-id" ),
		describedby = (elem.attr( "aria-describedby" ) || "").split( /\s+/ ),
		index = $.inArray( id, describedby );
	if ( index !== -1 ) {
		describedby.splice( index, 1 );
	}

	elem.removeData( "ui-tooltip-id" );
	describedby = $.trim( describedby.join( " " ) );
	if ( describedby ) {
		elem.attr( "aria-describedby", describedby );
	} else {
		elem.removeAttr( "aria-describedby" );
	}
}

$.widget( "ui.tooltip", {
	version: "1.9.1",
	options: {
		content: function() {
			return $( this ).attr( "title" );
		},
		hide: true,
		// Disabled elements have inconsistent behavior across browsers (#8661)
		items: "[title]:not([disabled])",
		position: {
			my: "left top+15",
			at: "left bottom",
			collision: "flipfit flipfit"
		},
		show: true,
		tooltipClass: null,
		track: false,

		// callbacks
		close: null,
		open: null
	},

	_create: function() {
		this._on({
			mouseover: "open",
			focusin: "open"
		});

		// IDs of generated tooltips, needed for destroy
		this.tooltips = {};
		// IDs of parent tooltips where we removed the title attribute
		this.parents = {};

		if ( this.options.disabled ) {
			this._disable();
		}
	},

	_setOption: function( key, value ) {
		var that = this;

		if ( key === "disabled" ) {
			this[ value ? "_disable" : "_enable" ]();
			this.options[ key ] = value;
			// disable element style changes
			return;
		}

		this._super( key, value );

		if ( key === "content" ) {
			$.each( this.tooltips, function( id, element ) {
				that._updateContent( element );
			});
		}
	},

	_disable: function() {
		var that = this;

		// close open tooltips
		$.each( this.tooltips, function( id, element ) {
			var event = $.Event( "blur" );
			event.target = event.currentTarget = element[0];
			that.close( event, true );
		});

		// remove title attributes to prevent native tooltips
		this.element.find( this.options.items ).andSelf().each(function() {
			var element = $( this );
			if ( element.is( "[title]" ) ) {
				element
					.data( "ui-tooltip-title", element.attr( "title" ) )
					.attr( "title", "" );
			}
		});
	},

	_enable: function() {
		// restore title attributes
		this.element.find( this.options.items ).andSelf().each(function() {
			var element = $( this );
			if ( element.data( "ui-tooltip-title" ) ) {
				element.attr( "title", element.data( "ui-tooltip-title" ) );
			}
		});
	},

	open: function( event ) {
		var that = this,
			target = $( event ? event.target : this.element )
				// we need closest here due to mouseover bubbling,
				// but always pointing at the same event target
				.closest( this.options.items );

		// No element to show a tooltip for
		if ( !target.length ) {
			return;
		}

		// If the tooltip is open and we're tracking then reposition the tooltip.
		// This makes sure that a tracking tooltip doesn't obscure a focused element
		// if the user was hovering when the element gained focused.
		if ( this.options.track && target.data( "ui-tooltip-id" ) ) {
			this._find( target ).position( $.extend({
				of: target
			}, this.options.position ) );
			// Stop tracking (#8622)
			this._off( this.document, "mousemove" );
			return;
		}

		if ( target.attr( "title" ) ) {
			target.data( "ui-tooltip-title", target.attr( "title" ) );
		}

		target.data( "tooltip-open", true );

		// kill parent tooltips, custom or native, for hover
		if ( event && event.type === "mouseover" ) {
			target.parents().each(function() {
				var blurEvent;
				if ( $( this ).data( "tooltip-open" ) ) {
					blurEvent = $.Event( "blur" );
					blurEvent.target = blurEvent.currentTarget = this;
					that.close( blurEvent, true );
				}
				if ( this.title ) {
					$( this ).uniqueId();
					that.parents[ this.id ] = {
						element: this,
						title: this.title
					};
					this.title = "";
				}
			});
		}

		this._updateContent( target, event );
	},

	_updateContent: function( target, event ) {
		var content,
			contentOption = this.options.content,
			that = this;

		if ( typeof contentOption === "string" ) {
			return this._open( event, target, contentOption );
		}

		content = contentOption.call( target[0], function( response ) {
			// ignore async response if tooltip was closed already
			if ( !target.data( "tooltip-open" ) ) {
				return;
			}
			// IE may instantly serve a cached response for ajax requests
			// delay this call to _open so the other call to _open runs first
			that._delay(function() {
				this._open( event, target, response );
			});
		});
		if ( content ) {
			this._open( event, target, content );
		}
	},

	_open: function( event, target, content ) {
		var tooltip, events, delayedShow,
			positionOption = $.extend( {}, this.options.position );

		if ( !content ) {
			return;
		}

		// Content can be updated multiple times. If the tooltip already
		// exists, then just update the content and bail.
		tooltip = this._find( target );
		if ( tooltip.length ) {
			tooltip.find( ".ui-tooltip-content" ).html( content );
			return;
		}

		// if we have a title, clear it to prevent the native tooltip
		// we have to check first to avoid defining a title if none exists
		// (we don't want to cause an element to start matching [title])
		//
		// We use removeAttr only for key events, to allow IE to export the correct
		// accessible attributes. For mouse events, set to empty string to avoid
		// native tooltip showing up (happens only when removing inside mouseover).
		if ( target.is( "[title]" ) ) {
			if ( event && event.type === "mouseover" ) {
				target.attr( "title", "" );
			} else {
				target.removeAttr( "title" );
			}
		}

		tooltip = this._tooltip( target );
		addDescribedBy( target, tooltip.attr( "id" ) );
		tooltip.find( ".ui-tooltip-content" ).html( content );

		function position( event ) {
			positionOption.of = event;
			if ( tooltip.is( ":hidden" ) ) {
				return;
			}
			tooltip.position( positionOption );
		}
		if ( this.options.track && event && /^mouse/.test( event.originalEvent.type ) ) {
			this._on( this.document, {
				mousemove: position
			});
			// trigger once to override element-relative positioning
			position( event );
		} else {
			tooltip.position( $.extend({
				of: target
			}, this.options.position ) );
		}

		tooltip.hide();

		this._show( tooltip, this.options.show );
		// Handle tracking tooltips that are shown with a delay (#8644). As soon
		// as the tooltip is visible, position the tooltip using the most recent
		// event.
		if ( this.options.show && this.options.show.delay ) {
			delayedShow = setInterval(function() {
				if ( tooltip.is( ":visible" ) ) {
					position( positionOption.of );
					clearInterval( delayedShow );
				}
			}, $.fx.interval );
		}

		this._trigger( "open", event, { tooltip: tooltip } );

		events = {
			keyup: function( event ) {
				if ( event.keyCode === $.ui.keyCode.ESCAPE ) {
					var fakeEvent = $.Event(event);
					fakeEvent.currentTarget = target[0];
					this.close( fakeEvent, true );
				}
			},
			remove: function() {
				this._removeTooltip( tooltip );
			}
		};
		if ( !event || event.type === "mouseover" ) {
			events.mouseleave = "close";
		}
		if ( !event || event.type === "focusin" ) {
			events.focusout = "close";
		}
		this._on( target, events );
	},

	close: function( event ) {
		var that = this,
			target = $( event ? event.currentTarget : this.element ),
			tooltip = this._find( target );

		// disabling closes the tooltip, so we need to track when we're closing
		// to avoid an infinite loop in case the tooltip becomes disabled on close
		if ( this.closing ) {
			return;
		}

		// only set title if we had one before (see comment in _open())
		if ( target.data( "ui-tooltip-title" ) ) {
			target.attr( "title", target.data( "ui-tooltip-title" ) );
		}

		removeDescribedBy( target );

		tooltip.stop( true );
		this._hide( tooltip, this.options.hide, function() {
			that._removeTooltip( $( this ) );
		});

		target.removeData( "tooltip-open" );
		this._off( target, "mouseleave focusout keyup" );
		// Remove 'remove' binding only on delegated targets
		if ( target[0] !== this.element[0] ) {
			this._off( target, "remove" );
		}
		this._off( this.document, "mousemove" );

		if ( event && event.type === "mouseleave" ) {
			$.each( this.parents, function( id, parent ) {
				parent.element.title = parent.title;
				delete that.parents[ id ];
			});
		}

		this.closing = true;
		this._trigger( "close", event, { tooltip: tooltip } );
		this.closing = false;
	},

	_tooltip: function( element ) {
		var id = "ui-tooltip-" + increments++,
			tooltip = $( "<div>" )
				.attr({
					id: id,
					role: "tooltip"
				})
				.addClass( "ui-tooltip ui-widget ui-corner-all ui-widget-content " +
					( this.options.tooltipClass || "" ) );
		$( "<div>" )
			.addClass( "ui-tooltip-content" )
			.appendTo( tooltip );
		tooltip.appendTo( this.document[0].body );
		if ( $.fn.bgiframe ) {
			tooltip.bgiframe();
		}
		this.tooltips[ id ] = element;
		return tooltip;
	},

	_find: function( target ) {
		var id = target.data( "ui-tooltip-id" );
		return id ? $( "#" + id ) : $();
	},

	_removeTooltip: function( tooltip ) {
		tooltip.remove();
		delete this.tooltips[ tooltip.attr( "id" ) ];
	},

	_destroy: function() {
		var that = this;

		// close open tooltips
		$.each( this.tooltips, function( id, element ) {
			// Delegate to close method to handle common cleanup
			var event = $.Event( "blur" );
			event.target = event.currentTarget = element[0];
			that.close( event, true );

			// Remove immediately; destroying an open tooltip doesn't use the
			// hide animation
			$( "#" + id ).remove();

			// Restore the title
			if ( element.data( "ui-tooltip-title" ) ) {
				element.attr( "title", element.data( "ui-tooltip-title" ) );
				element.removeData( "ui-tooltip-title" );
			}
		});
	}
});

}( jQuery ) );
/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);var $window = $(window),
	original_content,
	original_pageid,
	original_title,
	original_page,
	original_bread_crumbs,
	$animation_elements = $('.page-container-2, .page-container-news, .page-container-blog'),
	are_you_sure = "Are you sure?",
	mobile_screen = 850,
	instant_search_ajax,
	yes = "Yes",
	no = "No",
	ok = "ok",
	chat_w = 0,
	alerts = Math.floor(Math.random() * 10000),
	at,
	bc = true,
	confirmed = false,
	ajaxed = false,
	hp = false,
	ie = (window.navigator.appName == "Microsoft Internet Explorer"),
	ff = navigator.userAgent.toLowerCase().indexOf('firefox') > -1,
	wid,rtm,
	cursor = [],
	$ = jQuery,
	pushed = false,
	original_content, original_title, original_bread_crumbs,
	body_loading_t,
	body_id,
	pushed_history_ok = false,
	mobile_design = false,
	dontloadfilter = false;

if (typeof window.janrain !== 'object') window.janrain = {};
if (typeof window.janrain.settings !== 'object') window.janrain.settings = {};

$(window).scroll(function() {
	on_scroll_header();
	scrolltop();
});

$(document).on('keyup', function(e) {
	if (e.keyCode == 27) {
		removePopups();
	}
});

(function($) {
"use strict";
  $(document).ready(function() {
		if ($('html.itsinvoicepage').length)
			return;

		if (!getCookie('allow_cookies') && !$('html.area-a').length) {
				$('body').append('<div class="allow-cookies"><p>We use cookies for better user experience</p><button>Accept</button></div>');
				$('.allow-cookies button').on('click', function() {
					$('.allow-cookies').remove();
					setCookie('allow_cookies', '1', 30);
				});
    }

    setInterval(function() {
        $.ajax({
            url: '/refresh'
        });
    }, 15000);

	body_id = $('body').attr('id');
	on_scroll_header();
	mobile_design = $('body').data('mobile');
	$('#subsform').on('submit', function() {
		var r = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if ($('#sub-email').val() && r.test($('#sub-email').val())) {
			$.ajax({
				url:'/subscribe?email='+$('#sub-email').val()
			}).done(function(r) {
				alert(r);
				$('.alert_message').css('top', '150px');
				unfade();
			});
		} else {
			func_highlight($('#subscribe'));
		}

		return false;
	});

	$(document).mousemove(function(e) {
		cursor = [e.pageX, e.pageY];
	});

	$('.alerts').on('click', function() {
		bc = false;
	});

	$(document).on('click', function() {
		if (bc != false) {
			$('.popup, .alert_message, .alerts').not('.login_alert').remove();
			$('.login_alert').hide();
			unfade();
		}

		bc = true;
	});

	$('.search input').on('focus', function() {
		if ($(this).val() == 'Search')
			$(this).val('');
	});

    $(document).tooltip();

	original_content = $('.ajax_container').html();
	original_title = $('title').html();
	original_page = page;
	original_bread_crumbs = $('#bread_crumbs_container').html();

	if (page == 'home' || page == 'category' || (page == 'brands' && pageid))
		is_ajax_page = true;

	if (is_ajax_page)
		ajax_clicks();

	$('.currency_select a').on('click', function() {
		aload();
		$.ajax({
			url: '/set_currency/'+$(this).data('id')
		}).done(function() {
			location.reload();
		});

		return false;
	});

	$('.language_select a').on('click', function() {
		aload();
		$.ajax({
			url: '/set_language/'+$(this).data('id')
		}).done(function() {
			location.reload();
		});

		return false;
	});
                              1
	$('.currency_select select').change(function() {
		aload();
		$.ajax({
			url: '/set_currency/'+$(this).val()
		}).done(function() {
			location.reload();
		});
	});

	$('.language_select select').change(function() {
		aload();
		$.ajax({
			url: '/set_language/'+$(this).val()
		}).done(function() {
			location.reload();
		});
	});

	cart_clicks();
	original_pageid = pageid;
	instant_search();
	responsive_init();
	scrolltop();
  });
})($);

function ajax_clicks() {
	if ($('html.area-a').length)
		return;

	init_translate();
	$(document).tooltip();
		$('.filter_switcher').unbind('click').on('click', function() {
			$('body').toggleClass('filteropen');
		});
	$('body').removeClass('filteropen');
	left_filter_max_height();
	mdl_elements();
	$animation_elements = $('.page-container-2, .page-container-news, .page-container-blog')
	$window.trigger('scroll');
	mobile_menu_clicked = true;
	mobile_menu_open();

	try {
		ga('set', 'page', window.location.pathname);
		ga('send', 'pageview');
	} catch (err) {
	}

	$('.searchform').unbind('submit').on('submit', function() {
		var substring = $(this).find('input[type="text"]').val();
		if (!substring)
			return false;

		if (mobile_design) {
			$('html, body').animate({
				scrollTop: 0
			}, 500);
		}

		var h = '/search?q='+substring;
		if (!pushed) {
			pushed = true;
		}

		$('body').append('<div id="content-loading"><div class="cssload-container"><div class="cssload-speeding-wheel"></div></div></div>');
		$.ajax({
			dataType: 'json',
			url: h,
			error: function() {
				self.location = h;
			},
			success: function(r) {
				$('#content-loading').remove();
				$('body').attr('id', 'body-search');
				$('.ajax_container').html(r[0]);
				$('#bread_crumbs_container').html(r[2]);
				ajax_clicks();
				window.history.pushState({"html":r[0],"pageTitle":r[1], 'bread_crumbs': r[2], 'page': r[3], 'parentid': r[4], 'pageid': r[5]},"", h);
				document.title = r[1];
				proceed_clicks(r[3]);
				tabs_clicks();
			}
		});

		return false;
	});

	$('#menu a, a.ajax_link, .ajax_mobile_link, .logo-link, .bread_crumbs a, #subcategories a, .brands a, .test-links a, .foot a').unbind('click').on('click', function(e) {
		if ($(this).hasClass('no-ajax'))
			return true;

		if ($(this).closest('.product_popup').length)
			$('.fade').click();

		if (mobile_design) {
			$('html, body').animate({
				scrollTop: 0
			}, 500);
			mobile_menu_clicked = false;
			$('.mobile-left_menu').animate({left: -500}, 500);
    	} else {
			$('html, body').animate({
				scrollTop: 0
			}, 500);
    	}

		var h = $(this).attr('href');
		if (!pushed) {
			pushed = true;
		}

		var site_loader_to = setTimeout(function() {
			$('body').append('<div id="content-loading"><div class="cssload-container"><div class="cssload-speeding-wheel"></div></div></div>');
		}, 1000);

		$.ajax({
			dataType: 'json',
			url: create_ajax_link(h),
			error: function() {
				self.location = h;
			},
			success: function(r) {
				clearTimeout(site_loader_to);
				$('#content-loading').remove();
				$('body').attr('id', 'body-'+r[3]);
				$('.ajax_container').html(r[0]);

				$('#bread_crumbs_container').html(r[2]);
				ajax_clicks();
				page = r[3];
				window.history.pushState({"html":r[0],"pageTitle":r[1], 'bread_crumbs': r[2], 'page': r[3], 'parentid': r[4], 'pageid': r[5]},"", h);
				document.title = r[1];
				pageid = r[5];
				recalc_menus(r[3], r[4]);
				proceed_clicks(r[3]);
				tabs_clicks();
			}
		});

		return false;
	});

	try {
		login_clicks();
		register_actions();
	} catch (err) {
	}

	try {
		profile_clicks();
	} catch (err) {
	}

	contact_form();
}

function contact_form() {
	$('#body-help .submit_help').unbind('click').on('click', function() {
		var allgood = true;
		$('#help_form input').each(function() {
			if (!$(this).val()) {
				$(this).addClass('error');
				allgood = false;
			}
		});

		$('#help_form textarea').each(function() {
			if (!$(this).val()) {
				$(this).addClass('error');
				allgood = false;
			}
		});

		if (allgood)
			document.help.submit();
	});
}

window.onpopstate = function(e) {
	if (current_area == 'A') {
		self.location = window.location.href;
		return false;
	}

	if (is_ajax_page) {
		$('.page-container-2, #home-tabs').remove();
		if (e.state) {
			$('.ajax_container').html(e.state.html);
			$('body').attr('id', 'body-'+e.state.page);
			document.title = e.state.pageTitle;
			$('#bread_crumbs_container').html(e.state.bread_crumbs);
			if (e.state.parentid || (e.state.page != 'category' && e.state.page != 'search'))
				recalc_menus(e.state.page, e.state.parentid);

			var this_page = e.state.page;
			if (e.state.dontrealodfilter)
				dontloadfilter = true;

			pageid = e.state.pageid;
		} else {
			$('.ajax_container').html(original_content);
			document.title = original_title;
			$('#bread_crumbs_container').html(original_bread_crumbs);
			recalc_menus(page, parentid);
			var this_page = original_page;
			pageid = original_pageid;
			$('body').attr('id', body_id);
		}

		ajax_clicks();
		proceed_clicks(this_page);
		tabs_clicks();
	}
};

function proceed_clicks(whats_page) {
	if (whats_page == 'category' || whats_page == 'search' || (whats_page == 'brands' && pageid)) {
		$('body').addClass('withfilter');
		if (dontloadfilter)
			dontloadfilter = false;
		else
			load_filter();
	} else {
		$('body').removeClass('withfilter');
	}

	products_clicks();
	banners();
	product_clicks();
	filter_clicks();
	cart_actions();
	coupon_actions();
	cart_clicks();
	checkout_actions();
}

$(window).resize(function() {
	if ($('.fade').length > 0)
		fade();
});

function aload() {
	$('.loading').show();
}

function unload() {
	$('.loading').hide();
}

function alert(message, nook, h, classes, noshake, alert2, nofade) {
	clearTimeout(at);
	var id = alerts;
	if (alert2)
	    $('body').append('<div class="alert_message '+classes+'" id="a'+id+'" tabindex="'+id+'"><div class="background"></div><div class="alert_content"><span class="close_alert">x</span>'+message+(nook ? '' : '<div class="close-alert"><button>'+ok+'</button>')+'</div></div>');
	else {
		if (!nofade)
			fade();

		bc = false;
	    $('body').append('<div class="alert_message '+classes+'" id="a'+id+'" tabindex="'+id+'"><span class="close_alert">x</span>'+message+(nook ? '' : '<div class="close-alert"><button>'+ok+'</button>')+'</div></div>');
	}

	if (noshake == 2) {
		$('#a'+id).hide();
		$('#a'+id).show();
	}

	$('#a'+id+' .close_alert').on('click', function() {
		var othis = $(this);
		bc = false;
		if (alert2)
	    	var e = $(this).parent().parent();
		else
	    	var e = $(this).parent();

		e.css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
		setTimeout(function() {
			e.css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
			if (othis.closest('.login_alert').length || othis.closest('.register_alert').length)
		    	unfade();

	    	if (!$('.popup').length && !$('.register_alert').length && !$('.login_alert').length)
		    	unfade();

			setTimeout(function() {
				e.remove();
			}, 200);
		}, 200);

	});

	$('#a'+id+' .close-alert button').on('click', function() {
		bc = false;
		bb = true;
    	var e = $('#a'+id);
		e.css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
		setTimeout(function() {
			e.css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
	    	if (!$('.popup').length && !$('.register_alert').length && !$('.login_alert').length)
		    	unfade();

			setTimeout(function() {
				e.remove();
			}, 200);
		}, 200);

	});

	$('.alert_message').on('click', function() {
		bc = false;
		bb = true;
	});

	if (h)
		at = setTimeout(function(){$('#a'+id).fadeOut();unfade();}, 5000);

	$('#a'+id).focus();
	$('#a'+id).on('keyup', function(e) {
		if (e.which == 27) {
			$('#a'+id).hide();
    		if (!$('.popup').length)
				unfade();
		}
	});

	alerts += 1;

	return id;
}

function confirm(text, o, goto) {
	if (!text)
		text = are_you_sure;

	$('.confirm').remove();
	bc = false;
	alert(text+'<br /><br /><button class="yes">'+yes+'</button> <button onclick="javascript: $(\'.confirm\').remove(); unfade();" class="no">'+no+'</button>', 1, '', 'confirm', 2);
	$('.confirm').focus();
	$('.confirm .yes').on('click', function() {
		bc = false;
		confirmed = true;
		if (goto)
			self.location = goto;
		else
			o.trigger('click');

		unfade();
		$('.confirm').remove();
		confirmed = false;
	});

	$('.confirm').keydown(function(e) {
		if (e.which == 13)
			$('.confirm .yes').trigger('click');
		else if (e.which == 27)
			$('.confirm .no').trigger('click');
	});
}

function fade() {
	if ($('.fade').length == 0) {
		$('html').prepend('<div class="fade"></div>');
		$('.fade').height($(document).height());
		$('.fade').show();
	} else
		$('.fade').height($(document).height());

	$('.fade').unbind('click').on('click', function() {
		bc = false;
		removePopups();
return;
		bc = true;
	});
}


function removePopups(no_unfade) {
	if (current_area == 'C')
		setTimeout(function() {
			oid = 0;
			product_clicks();
		}, 500);

	if (no_unfade) {
		$('.popup, .alert, .alert_message:not(.not_remove)').remove();
		return;
	}

	$('.popup, .alert, .alert_message').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
	setTimeout(function() {
		$('.popup, .alert, .alert_message').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
    	unfade();

		setTimeout(function() {
			$('.popup, .alert, .alert_message:not(.not_remove)').remove();
		}, 200);
	}, 200);
}

function unfade() {
	clearTimeout(at);
	if (($('.checkout_popup').is(':visible') || $('.product_popup').is(':visible')) && ($('.login_alert').is(':visible') || $('.register_alert').is(':visible'))) {
		setTimeout(function() {
			if (!$('.checkout_popup').is(':visible') && !$('.product_popup').is(':visible')) {
				$('.prev').remove();
				$('.fade').remove();
			}
		}, 500);
		return;
	}

	$('.prev').remove();
	$('.fade').remove();
}

function price_format(price, thousand_delim, decimal_delim, precision) {
	var thousand_delim = (arguments.length > 1 && thousand_delim !== false) ? thousand_delim : '';
	var decimal_delim = (arguments.length > 2 && decimal_delim !== false) ? decimal_delim : '.';
	var precision = (arguments.length > 3 && precision !== false) ? precision : '2';

	if (precision > 0) {
		precision = Math.pow(10, precision);
		price = Math.round(price*precision)/precision;
		var top = Math.floor(price);
		var bottom = Math.round((price-top)*precision)+precision;

	} else {
		var top = Math.round(price);
		var bottom = 0;
	}

	top = top+"";
	bottom = bottom+"";
	var cnt = 0;
	for (var x = top.length; x >= 0; x--) {
		if (cnt % 3 == 0 && cnt > 0 && x > 0)
			top = top.substr(0, x)+thousand_delim+top.substr(x, top.length);

		cnt++;
	}

	return (bottom > 0) ? (top+decimal_delim+bottom.substr(1, bottom.length)) : top;
}

function IsNumeric(num) {
     return (num >=0 || num < 0);
}

function cart_clicks() {
	mdl_elements();
	$('.cart-link').unbind('click').on('click', function() {
		if (mobile_screen > $(window).width())
			return true;


		$('.cart_popup').remove();
		if (!$('.checkout_popup').length)
			aload();

		$('.checkout_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, -70)');
		setTimeout(function() {
			$('.checkout_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
			setTimeout(function() {
				$('.checkout_popup').remove();
			}, 200);
		}, 200);

		$('body').append('<div class="load hidden"><span class="close close-popup">x</span></div>');
		$.ajax({
			dataType: 'json',
			url: '/cart',
			error: function() {
				alert('We cannot process this request. Please, contact site administrator.');
			},
			success: function(r) {
				$('.load').html('<span class="close close-popup">x</span>'+r[0]);
				unload();
				fade();
				$('.load').addClass('popup cart_popup').removeClass('load');
				var top = ($(window).scrollTop() + $(window).height() / 2 - $('.cart_popup').height() / 2) - 50;
				if (top < $(window).scrollTop())
					top = $(window).scrollTop() + 30;

				$('.cart_popup').css('top', top + 'px');
				$('.cart_popup').css('left', ($(window).width() / 2 - $('.cart_popup').width() / 2 - 10) + 'px');
				$('.cart_popup').css('opacity', 0).css('transform', 'matrix(0.1, 0, 0, 0.1, 0, 0)');
				setTimeout(function() {
					$('.cart_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
					setTimeout(function() {
						$('.cart_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
					}, 200);
				}, 200);

				$('.cart_popup').show();
				$(window).resize(function() {
					var top = ($(window).scrollTop() + $(window).height() / 2 - $('.cart_popup').height() / 2) - 50;
					if (top < $(window).scrollTop())
						top = $(window).scrollTop() + 30;

					$('.cart_popup').css('top', top + 'px');
					$('.cart_popup').css('left', ($(window).width() / 2 - $('.cart_popup').width() / 2 - 10) + 'px');
				});

				$('.cart_popup .close, .cart_popup .close_popup').on('click', function() {
					removePopups();
				});

				$('.cart_popup').on('click', function() {
					bc = false;
					bb = true;
				});

				cart_actions();
				coupon_actions();
				cart_clicks();
			}
		});

		return false;
	});

	$('.wishlist-link').unbind('click').on('click', function() {
		$('.wl_popup').remove();
		$('body').append('<div class="load hidden"><span class="close close-popup">x</span></div>');
		$.ajax({
			dataType: 'json',
			url: '/wishlist',
			error: function() {
				alert('We cannot process this request. Please, contact site administrator.');
			},
			success: function(r) {
				$('.load').html('<span class="close close-popup">x</span>'+r[0]);
				unload();
				fade();
				$('.load').addClass('popup wl_popup').removeClass('load');
				var top = ($(window).scrollTop() + $(window).height() / 2 - $('.wl_popup').height() / 2) - 50;
				if (top < $(window).scrollTop())
					top = $(window).scrollTop() + 30;

				$('.wl_popup').css('top', top + 'px');
				$('.wl_popup').css('left', ($(window).width() / 2 - $('.wl_popup').width() / 2 - 10) + 'px');
				$('.wl_popup').css('opacity', 0).css('transform', 'matrix(0.1, 0, 0, 0.1, 0, 0)');
				setTimeout(function() {
					$('.wl_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
					setTimeout(function() {
						$('.wl_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
					}, 200);
				}, 200);

				$('.wl_popup').show();
				$(window).resize(function() {
					var top = ($(window).scrollTop() + $(window).height() / 2 - $('.cart_popup').height() / 2) - 50;
					if (top < $(window).scrollTop())
						top = $(window).scrollTop() + 30;

					$('.wl_popup').css('top', top + 'px');
					$('.wl_popup').css('left', ($(window).width() / 2 - $('.cart_popup').width() / 2 - 10) + 'px');
				});

				$('.wl_popup .close, .wl_popup .close_popup').on('click', function() {
					removePopups();
				});

				$('.wl_popup').on('click', function() {
					bc = false;
					bb = true;
				});

				wl_actions();
				init_translate();
			}
		});

		return false;
	});

	$('.checkout-link').unbind('click').on('click', function() {
		if (mobile_screen > $(window).width())
			return true;

		if ($('.checkout_popup').length) {
			$('.checkout_popup').remove();
			aload();
		} else if (!$('.cart_popup').length)
			aload();

		$('.cart_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, -70)');
		setTimeout(function() {
			$('.cart_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
			setTimeout(function() {
				$('.cart_popup').remove();
			}, 200);
		}, 200);

		$('body').append('<div class="load hidden"><span class="close close-popup">x</span></div>');
		$.ajax({
			dataType: 'json',
			url: '/checkout',
			error: function() {
				alert('We cannot process this request. Please, contact site administrator.');
			},
			success: function(r) {
				$('.load').html('<span class="close close-popup">x</span>'+r[0]);
				unload();
				fade();
				$('.load').addClass('popup checkout_popup').removeClass('load');
				var top = ($(window).scrollTop() + $(window).height() / 2 - $('.checkout_popup').height() / 2) - 50;
				if (top < $(window).scrollTop())
					top = $(window).scrollTop() + 30;

				$('.checkout_popup').css('top', top + 'px');
				$('.checkout_popup').css('left', ($(window).width() / 2 - $('.checkout_popup').width() / 2 - 10) + 'px');
				$('.checkout_popup').css('opacity', 0).css('transform', 'matrix(0.1, 0, 0, 0.1, 0, 0)');
				setTimeout(function() {
					$('.checkout_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
					setTimeout(function() {
						$('.checkout_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
					}, 200);
				}, 200);

				$('.checkout_popup').show();
				$(window).resize(function() {
					var top = ($(window).scrollTop() + $(window).height() / 2 - $('.checkout_popup').height() / 2) - 50;
					if (top < $(window).scrollTop())
						top = $(window).scrollTop() + 30;

					$('.checkout_popup').css('top', top + 'px');
					$('.checkout_popup').css('left', ($(window).width() / 2 - $('.checkout_popup').width() / 2 - 10) + 'px');
				});

				$('.checkout_popup .close, .checkout_popup .close_popup').on('click', function() {
					removePopups();
				});

				$('.checkout_popup').on('click', function() {
					bc = false;
					bb = true;
				});

				checkout_actions();
				checkout_changes();
				$('#place_order *').attr('disabled', true);
				coupon_actions();
				cart_clicks();
				init_translate();
			}
		});

		return false;
	});
}

function cart_actions() {
	init_translate();
	$('.cart-quantity').on('keyup', function() {
		var max = $(this).data('max');
		if ($(this).val() > max)
			$(this).val(max);
	});

	$('.clear-cart').on('click', function() {
		$.ajax({url: '/cart/clear'}).done(function(r) {
			$('#minicart').html(r);
			$('#head_mobile #minicart').html(r);
			cart_clicks();
		});
		removePopups();
		return false;
	});

	$('.update-cart').on('click', function(e) {
	    $.ajax({
           type: "POST",
           url: '/cart',
           data: $("#cartform").serialize(),
           success: function(data) {
				$('.cart-link').click();
           }
         });

	    e.preventDefault();
		return false;
	});

	$('.remove-link').on('click', function() {
		var url = $(this).attr('href');
		$.ajax({url: url}).done(function(r) {
			$('#minicart').html(r);
			$('#head_mobile #minicart').html(r);
			if ($('#minicart .cart-link').length) {
				cart_clicks();
				$('.cart-link').click();
			} else
				removePopups();
		});

		return false;
	});
}

function wl_actions() {
	$('.clear-wl').on('click', function() {
		$.ajax({url: '/wishlist/clear'}).done(function(r) {});
		removePopups();
		return false;
	});

	$('.remove-wl-link').on('click', function() {
		var url = $(this).attr('href');
		$.ajax({url: url}).done(function(r) {
			$('.wishlist-link').click();
		});

		return false;
	});
}

function recalculate_shipping(shippingid) {
	$('#place_order').animate({opacity: .6 }, 50);
	$('#place_order *').attr('disabled', true);
    $.ajax({
		type: "POST",
		url: '/checkout?shippingid='+shippingid,
		success: function(data) {
			$('#place_order').animate({opacity: 1 }, 200);
			$('#place_order *').attr('disabled', false);
			$('#place_order').html(data);
			checkout_actions();
			$('#paymentid').trigger('change');
		}
	});
}

function checkout_actions() {
	configure_stripe();
	states_actions();
	if ($('#same_address').is(':checked')) {
			$('.billing_address input').prop('required', false);
			$('.billing_address input').attr('required', false);
			$('.billing_address input').removeProp('required');
			$('.billing_address input').removeAttr('required');
	} else {
		$('.billing_address input').prop('required', true);
	}

	$('#same_address').unbind('change').change(function() {
		if ($(this).is(':checked')) {
			$('.billing_address input').prop('required', false);
			$('.billing_address input').attr('required', false);
			$('.billing_address input').removeProp('required');
			$('.billing_address input').removeAttr('required');
		} else {
			$('.billing_address input').prop('required', true);
		}

		$('.billing_address').toggle();
	});

	$('#paymentid').change(function() {
	        if ($(this).val() == '2') {
	        	$("#cc-info").show()
	        	$("#place-order").hide()
	        } else {
	        	$("#cc-info").hide()
	        	$("#place-order").show()
	        }
	});

	$('#checkout_user_form').unbind('submit').on('submit', function(e) {
	    e.preventDefault();
		var allgood = true;
		$('#checkout_user_form input').each(function() {
			var o = $(this);
			if (!o.val()) {
			}
		});

		if (!allgood)
			return false;

	    $.ajax({
           type: "POST",
           url: '/checkout/user_form',
           data: $('#checkout_user_form').serialize(),
           success: function(data) {
				if (data == 'Email') {
	                alert('Enterd email already registered for another user');
				} else {
					$('#place_order').animate({opacity: 1 }, 200);
					$('#place_order *').attr('disabled', false);
					$('#place_order').html(data);
					init_translate();
					checkout_actions();
					$('html, body').animate({
						scrollTop: $('#checkoutform').offset().top - 200
					}, 500);
					if ($('#paymentid').val() == '2')
						$('#cc-info').show();
						mdl_elements()
				}
           }
         });

		return false;
	});

	$('#place_order button').unbind('click').on('click', function(e) {
		if ($('#paymentid').val() == 7) {
			aload();
		    $.ajax({
    	    	type: "POST",
				url: '/checkout/place_order',
				data: $('#checkoutform').serialize(),
				success: function(data)
				{
stripe_lib.redirectToCheckout({
  // Make the id field from the Checkout Session creation API response
  // available to this file, so you can provide it as parameter here
  // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
  sessionId: data
}).then(function (result) {
	alert("Unable to redirect to Stripe");
  // If `redirectToCheckout` fails due to a browser or network
  // error, display the localized error message to your customer
  // using `result.error.message`.
});
						alert('Please, wait we are connecting you to Stripe');
				}
			});

			return false;
		} else if ($('#paymentid').val() == '2') {
			aload();
			hostedFieldsInstance_obj.tokenize(function (err, payload) {
				if (err) {
					unload();
					alert(err.message);
					console.error(err);
					return;
				}

    braintree.threeDSecure.create({
      authorization: client_token,
      version: 2
	}, function (createError, threeDSecure) {
  threeDSecure.on('lookup-complete', function (data, next) {
    // check lookup data

    next();
  });

threeDSecure.verifyCard({
  amount: $('#order_total').val(),
  nonce: payload.nonce,
  bin: payload.details.bin
  // other fields such as billing address
}, function (verifyError, payload) {
							unload();
  if (verifyError) {
  	alert(verifyError.message);
    if (verifyError.code === 'THREEDS_VERIFY_CARD_CANCELED_BY_MERCHANT ') {
      // flow was cancelled by merchant, 3ds info can be found in the payload
      // for cancelVerifyCard
    }

    return;
  }

        if ('undefined' != typeof payload.verificationDetails && payload.verificationDetails.liabilityShiftPossible == false && payload.verificationDetails.liabilityShifted == false && this.isAcceptNo3dSecure == false) {
        }


        		$('#payment-method-nonce').val(payload.nonce);
			    $.ajax({
	    	       type: "POST",
        		   url: '/checkout/place_order',
	    	       data: $('#checkoutform').serialize(), // serializes the form's elements.
    		       success: function(data)
	        	   {
						if (data == 'Error') {
							unload();
		            	    alert('Please, contact site administrator');
						} else if (data == 'StripeError') {
							$('#stripe_token').val('');
							$('#payment-method-nonce').val('');
							$('.checkout_popup').css('opacity', 1);
	            		    alert('There was error processing your credit card');
						} else {
							self.location = '/invoice/'+data+'/success';
						}
		        	}
	    		});

});
    });

return;

        		$('#payment-method-nonce').val(payload.nonce);
			    $.ajax({
	    	       type: "POST",
        		   url: '/checkout/place_order',
	    	       data: $('#checkoutform').serialize(), // serializes the form's elements.
    		       success: function(data)
	        	   {
						if (data == 'Error') {
							unload();
		            	    alert('Please, contact site administrator');
						} else if (data == 'StripeError') {
							$('#stripe_token').val('');
							$('#payment-method-nonce').val('');
							$('.checkout_popup').css('opacity', 1);
	            		    alert('There was error processing your credit card');
						} else {
							self.location = '/invoice/'+data+'/success';
						}
		        	}
	    		});
        	});
		} else {
		    $.ajax({
    	       type: "POST",
        	   url: '/checkout/place_order',
	           data: $('#checkoutform').serialize(), // serializes the form's elements.
    	       success: function(data)
        	   {
					if (data == 'Error') {
	            	    alert('Please, contact site administrator');
					} else if (data == 'StripeError') {
						$('#stripe_token').val('');
						$('.checkout_popup').css('opacity', 1);
	            	    alert('There was error processing your credit card');
					} else if (strstr(data, 'paypal.com')) {
						$('body').append(data);
						document.paypalform.submit();
						alert('Please, wait we are connecting you to PayPal');
					} else {
						self.location = '/invoice/'+data+'/success';
					}
	           }
	         });
		}
	});

	$('.apply_gc').on('click', function() {
		bc = false;
		var id = alert('<div class="coupon_screen"></div>', 1, '', 'coupon_alert');
		$('.coupon_screen').html('<br/><div class="group"><input type="text" size="30" required /><span class="highlight"></span><span class="bar"></span><label>Enter your Gift Card code here</label></div><div class="coupon-error"></div><button>Apply</button><br/><br/>');
		$('.coupon_screen input').on('keyup', function() {
			$('.coupon-error').hide();
		});

		$('.coupon_screen button').on('click', function() {
			if (!$('.coupon_screen input').val()) {
				func_highlight($('.coupon_screen input'));
				return false;
			}

			$.ajax({url: '/checkout?gc='+$('.coupon_screen input').val()}).done(function(r) {
				if (r == 'S') {
					$('.coupon_alert').remove();
					refresh_coupon();
				} else {
					$('.coupon-error').html(r);
					$('.coupon-error').show();
				}
			});
		});
	});

	$('.apply_coupon').on('click', function() {
		bc = false;
		var id = alert('<div class="coupon_screen"></div>', 1, '', 'coupon_alert');
		$('.coupon_screen').html('<div class="group"><input type="text" size="30" required /><span class="highlight"></span><span class="bar"></span><label>Enter your coupon code here</label></div><div class="coupon-error"></div><button>Apply</button><br/><br/>');
		$('.coupon_screen input').on('keyup', function() {
			$('.coupon-error').hide();
		});

		$('.coupon_screen button').on('click', function() {
			if (!$('.coupon_screen input').val()) {
				func_highlight($('.coupon_screen input'));
				return false;
			}

			$.ajax({url: '/checkout?coupon='+$('.coupon_screen input').val()}).done(function(r) {
				if (r == 'S') {
					$('.coupon_alert').remove();
					refresh_coupon();
				} else {
					$('.coupon-error').html(r);
					$('.coupon-error').show();
				}
			});
		});
	});

	$('#local_pickup').change(function() {
		if ($(this).is(':checked')) {
			recalculate_shipping('L');
		} else {
			recalculate_shipping($('[name="shippingid"]').val());
		}

	});
}

var handler,
	stripe_loaded = false,
	stripe_lib;
function configure_stripe() {
	if (stripe_loaded)
		return;

  	stripe_loaded = true;
$.ajax({
  url: "https://js.stripe.com/v3/",
  dataType: "script",
  success: function() {
	stripe_lib = Stripe(stripe_key);
  }
});
}


function checkout_changes() {
	$('#checkout_user_form input').on('paste change keyup click', function() {
		$('#place_order *').attr('disabled', true);
		$('#place_order').css('opacity', .3);
	});

	$('#checkout_user_form select').change(function() {
		$('#place_order *').attr('disabled', true);
		$('#place_order').css('opacity', .3);
	});
}

function coupon_actions() {
	$('.remove_coupon').on('click', function() {
		$.ajax({url:'/checkout/remove_coupon'}).done(function() {
			refresh_coupon();
		});
	});

	$('.remove_gc').on('click', function() {
		$.ajax({url:'/checkout/remove_gc'}).done(function() {
			refresh_coupon();
		});
	});
}

function refresh_coupon() {
	if ($('.checkout_popup').is(':visible'))
		$('.checkout-link').click();
	else if ($('.cart_popup').is(':visible'))
		$('.cart-link').click();
	else
		window.location.reload();
}

function setCookie(cn,v,ed,seconds) {
	if (seconds) {
		var date = new Date(new Date().getTime() + ed * 1000);
		document.cookie=cn + "=" + v + ((ed==null) ? "" : "; expires="+date.toUTCString())+'; path=/;';//
	} else {
		var e = new Date();
		e.setDate(e.getDate() + ed);
		document.cookie=cn + "=" + v + ((ed==null) ? "" : "; expires="+e.toUTCString())+'; path=/;';
	}
}

function getCookie(cn) {
	var i, x, y, a = document.cookie.split(";");
	for (i = 0; i < a.length; i++) {
		x = a[i].substr(0, a[i].indexOf("="));
		y = a[i].substr(a[i].indexOf("=") + 1);
		x = x.replace(/^\s+|\s+$/g,"");
		if (x == cn)
			return y;
	}
}

function func_highlight(el) {
	if ($('html.area-c').length) {
		el.addClass('error');
		return;
	}

	el.css('background', '#ff3000');
	setTimeout(function() {
		el.css('background', '#fff');
		setTimeout(function() {
			el.css('background', '#ff3000');
			setTimeout(function() {
				el.css('background', '#fff');
			}, 200);
		}, 200);
	}, 100);
}

function print_invoice(el) {
	$('#iframe-invoice').remove();
	$("<iframe id='iframe-invoice' name='invoice' style='height: 0px; width: 0px;' src='" + el.attr('href') + "' />").appendTo('body');
	$('#iframe-invoice').on('load', function() {
		window.frames['invoice'].focus();
		window.frames['invoice'].print();
	});

	return false;
}

function strstr(haystack, needle, bool) {
	var pos = 0;

	pos = haystack.indexOf(needle);
	if (pos == -1)
		return false;
	else {
		if (bool)
			return haystack.substr( 0, pos );
		else
			return haystack.slice( pos );
	}
}

function recalc_menus(pg, pi) {
	$('.menu-container li').removeClass('active');
	if (pi) {
		$('li#menu-'+pi).addClass('active');
	} else {
		$('li#menu-'+pg).addClass('active');
	}
}

function on_scroll_header() {
	if ($('body').data('mobile') || $('body').hasClass('admin-area'))
		return;

	if ($(this).scrollTop() > 190) {
		$('body').addClass('scrolled');
	} else {
		$('body').removeClass('scrolled');
	}
}

function instant_search() {
	$('.search input').unbind('focus').on('focus', function() {
		var val = $(this).val();
		if (val.length < 2) {
			$('.instant-search').html("<div class='enter-3-chars'>Enter at least 2 characters</div>");
			return;
		}

		setTimeout(function() {
			search_instant(val);
		}, 300);
	});

	$('.search').unbind('mouseleave').mouseleave(function() {
		$('.instant-search').fadeOut();
	});

	$('.search').unbind('mouseover').mouseover(function() {
		return false;
		$('.instant-search').fadeIn();
		var val = $(this).find('input').val();
		if (val.length < 2) {
			$('.instant-search').html("<div class='enter-3-chars'>Enter 2 characters</div>");
			return;
		}

		setTimeout(function() {
			search_instant(val);
		}, 300);
	});

	$('.search input').on('keyup', function() {
		if ($(this).val().length < 2) {
			$('.instant-search').html("<div class='enter-3-chars'>Enter 2 characters</div>");
			return;
        }

		search_instant($(this).val());
	});
}

function search_instant(val) {
		try {
			instant_search_ajax.abort();
		} catch (err) {
		}

		instant_search_ajax = $.ajax({
			url: '/instant_search?q='+encodeURIComponent(val)
		}).done(function(r) {
			$('.instant-search').html(r);
			$('.instant-search').show();
			ajax_clicks();
			$('.more-no-search').on('click', function() {
				if (mobile_screen > $(window).width()) {
					$('.searchform_desktop').submit();
        } else
					$('.searchform_mobile').submit();

				$('.instant-search').hide();
			});
		});
}

function responsive_init() {
	$('.navigation-toggle').on('click', function() {
		mobile_menu_open();
		$('body').removeClass('filteropen');
	});
}

var mobile_menu_clicked = false;
$('.mobile-menu-fade').on('click', function() {
	mobile_menu_open();
});

function mobile_menu_open() {
		if (mobile_menu_clicked) {
			mobile_menu_clicked = false;
			$('.mobile-left_menu').animate({left: -500}, 500);
			$('.navigation-toggle').removeClass('is-active');
			$('.mobile-menu-fade').fadeOut();
		} else {
			var top = $(window).scrollTop() + 80;
			$('.mobile-left_menu').css('top', top+'px');
			mobile_menu_clicked = true;
			$('.mobile-left_menu').animate({left: 0}, 500);
			$('.navigation-toggle').addClass('is-active');
			$('.mobile-menu-fade').fadeIn();
		}
}

function create_ajax_link(href) {
	try {
		if (href.indexOf('?') == -1) {
			href = href+'?its_ajax_page=1';
		} else {
			href = href+'&its_ajax_page=1';
		}
	} catch (err) {
	}

	return href;
}

function scrolltop() {
	if ($(window).scrollTop() > 100)
		$('#scrolltop').show();
	else
		$('#scrolltop').hide();

	$('#scrolltop').unbind('click').on('click', function() {
		$('html, body').animate({
			scrollTop: 0
		}, 500);
	});
}

function check_if_in_view() {
	return false;
  var window_height = $window.height();
  var window_top_position = $window.scrollTop();
  var window_bottom_position = (window_top_position + window_height);

  $.each($animation_elements, function() {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);

    //check to see if this current container is within viewport
    if ((element_bottom_position >= window_top_position) &&
        (element_top_position <= window_bottom_position)) {
      $element.addClass('in-view');
    } else {
    }
  });
}

function close_ticket(id, what) {
	if (what == '1') {
		$('#ticket-status-'+id).html("Closed");
		var sid = 'C';
		alert('Ticket closed');
	} else {
		$('#ticket-status-'+id).html("Cancelled");
		alert('Ticket cancelled');
		var sid = '3';
	}

	$('#ticket-status-links-'+id).html("");
	$.ajax({url: '/ticket/status/'+id+'/'+sid});
}

$('body').on('keyup focus', function(event) {
	if ($(event.target).prop('nodeName').toLowerCase() == 'input' || $(event.target).prop('nodeName').toLowerCase() == 'textarea') {
		$(event.target).removeClass('error');
	}
});

function mdl_elements() {
    $('div.group:not(.mdl_element)').each(function() {
			$(this).addClass('mdl_element');
			if ($(this).find('input').val()) {
        $(this).addClass('withval');
      }
			
			$(this).find('input').on('input', function() {
				if ($(this).val()) {
          $(this).parent().addClass('withval');
        } else
					$(this).parent().removeClass('withval');
			});

			if ($(this).find('textarea').val()) {
        $(this).addClass('withval');
      }
			
			$(this).find('textarea').on('input', function() {
				if ($(this).val()) {
          $(this).parent().addClass('withval');
        } else
					$(this).parent().removeClass('withval');
			});
		});
}

function init_translate() {
    $('.translate').unbind('click').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			var lbl = $(this).find('.hidden.translate-phrase').html(),
					word = $(this).find('.hidden.word').html();
			alert('<textarea id="translate_me">'+lbl+'</textarea><div class="close-alert"><button>Save</button></div>', '1', '', 'translate-alert');
			$('.translate-alert').on('click', function() {
				$.ajax({
					url: '/translate?lbl='+encodeURIComponent(word)+'&translate='+encodeURIComponent($('.translate-alert textarea').val())
				});
			});
    });
}

function str_replace(search, replace, subject) {
	return subject.split(search).join(replace);
}var helptext = [];

helptext['b'] = "Bold";

helptext['i'] = "Italic";

helptext['u'] = "Underlined";

helptext['s'] = "Line through";

helptext['url'] = "Link";

helptext['email'] = "Email";

helptext['img'] = "Image";

helptext['list'] = "List";

helptext['li'] = "List point";

helptext['quote'] = "Quote";

helptext['code'] = "Code";



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

}var current_banner = 1,	banners_count, banners_delay = 5000, banners_interval;



/*

 * We trigger the factory() function is different

 * ways to support modular JavaScript libraries. See

 * the 'Wrapping Up' section of the tutorial for

 * more information

 *

 */

  /*

	 * We define Zippy as a variable of type �function�.

   * Here, we use an anonymous function to ensure

   * that the logic inside the function is executed immediately.

	 *

	 */

  var Zippy = (function(element, settings){



    var instanceUid = 0;



    /*

     * The constructor function for Zippy

     *

     */

    function _Zippy(element, settings){

      this.defaults = {

        slideDuration: '3000',

        speed: 500,

        arrowRight: '.arrow-right',

        arrowLeft: '.arrow-left'

      };



      // We create a new property to hold our default settings after they

      // have been merged with user supplied settings

      this.settings = $.extend({},this,this.defaults,settings);



      // This object holds values that will change as the plugin operates

      this.initials = {

        currSlide : 0,

        $currSlide: null,

        totalSlides : false,

        csstransitions: false

      };



      // Attaches the properties of this.initials as direct properties of Zippy

      $.extend(this,this.initials);



      // Here we'll hold a reference to the DOM element passed in

      // by the $.each function when this plugin was instantiated

      this.$el = $(element);



      // Ensure that the value of 'this' always references Zippy

      this.changeSlide = $.proxy(this.changeSlide,this);



      // We'll call our initiator function to get things rolling!

      this.init();



      // A little bit of metadata about the instantiated object

      // This property will be incremented everytime a new Zippy carousel is created

		 // It provides each carousel with a unique ID

      this.instanceUid = instanceUid++;

    }



    return _Zippy;



  })();



  /**

	 * Called once per instance

	 * Calls starter methods and associate the '.zippy-carousel' class

	 * @params void

	 * @returns void

	 *

	 */

   Zippy.prototype.init = function(){

    //Test to see if cssanimations are available

    this.csstransitionsTest();

    // Add a class so we can style our carousel

    this.$el.addClass('zippy-carousel');

    // Build out any DOM elements needed for the plugin to run

    // Eg, we'll create an indicator dot for every slide in the carousel

    this.build();

    // Eg. Let the user click next/prev arrows or indicator dots

    this.events();

    // Bind any events we'll need for the carousel to function

    this.activate();

    // Start the timer loop to control progression to the next slide

    this.initTimer();

  };



	/**

	 * Appropriated out of Modernizr v2.8.3

	 * Creates a new DOM element and tests existence of properties on it's

	 * Style object to see if CSSTransitions are available

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.csstransitionsTest = function(){

		var elem = document.createElement('modernizr');

		//A list of properties to test for

		var props = ["transition","WebkitTransition","MozTransition","OTransition","msTransition"];

		//Iterate through our new element's Style property to see if these properties exist

		for ( var i in props ) {

			var prop = props[i];

			var result = elem.style[prop] !== undefined ? prop : false;

			if (result){

				this.csstransitions = result;

				break;

			}

		}

	};



	/**

	 * Add the CSSTransition duration to the DOM Object's Style property

	 * We trigger this function just before we want the slides to animate

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.addCSSDuration = function(){

		var _ = this;

		this.$el.find('.slide').each(function(){

			this.style[_.csstransitions+'Duration'] = _.settings.speed+'ms';

		});

	}



	/**

   * Remove the CSSTransition duration from the DOM Object's style property

   * We trigger this function just after the slides have animated

   * @params void

   * @returns void

   *

   */

	Zippy.prototype.removeCSSDuration = function(){

		var _ = this;

		this.$el.find('.slide').each(function(){

			this.style[_.csstransitions+'Duration'] = '';

		});

	}



	/**

	 * Creates a list of indicators based on the amount of slides

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.build = function(){

		var $indicators = this.$el.append('<ul class="indicators" >').find('.indicators');

		this.totalSlides = this.$el.find('.slide').length;

		for(var i = 0; i < this.totalSlides; i++) $indicators.append('<li data-index='+i+'>');

	};



	/**

	 * Activates the first slide

	 * Activates the first indicator

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.activate = function(){

		this.$currSlide = this.$el.find('.slide').eq(0);

		this.$el.find('.indicators li').eq(0).addClass('active');

	};



	/**

   * Associate event handlers to events

   * For arrow events, we send the placement of the next slide to the handler

   * @params void

   * @returns void

   *

   */

	Zippy.prototype.events = function(){

		$('body')

			.on('click',this.settings.arrowRight,{direction:'right'},this.changeSlide)

			.on('click',this.settings.arrowLeft,{direction:'left'},this.changeSlide)

			.on('click','.indicators li',this.changeSlide);

	};



	/**

	 * TIMER

	 * Resets the timer

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.clearTimer = function(){

		if (this.timer) clearInterval(this.timer);

	};



	/**

	 * TIMER

	 * Initialise the timer

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.initTimer = function(){

		this.timer = setInterval(this.changeSlide, this.settings.slideDuration);

	};



	/**

	 * TIMER

	 * Start the timer

	 * Reset the throttle to allow changeSlide to be executable

	 * @params void

	 * @returns void

	 *

	 */

	Zippy.prototype.startTimer = function(){

		this.initTimer();

		this.throttle = false;

	};



	/**

	 * MAIN LOGIC HANDLER

	 * Triggers a set of subfunctions to carry out the animation

	 * @params	object	event

	 * @returns void

	 *

	 */

	Zippy.prototype.changeSlide = function(e){

		//Ensure that animations are triggered one at a time

		if (this.throttle) return;

		this.throttle = true;



		//Stop the timer as the animation is getting carried out

		this.clearTimer();



		// Returns the animation direction (left or right)

		var direction = this._direction(e);



		// Selects the next slide

		var animate = this._next(e,direction);

		if (!animate) return;



		//Active the next slide to scroll into view

		var $nextSlide = this.$el.find('.slide').eq(this.currSlide).addClass(direction + ' active');



    if (!this.csstransitions){

			this._jsAnimation($nextSlide,direction);

		} else {

			this._cssAnimation($nextSlide,direction);

		}

	};



	/**

	 * Returns the animation direction, right or left

	 * @params	object	event

	 * @returns strong	animation direction

	 *

	 */

	Zippy.prototype._direction = function(e){

		var direction;



		// Default to forward movement

		if (typeof e !== 'undefined'){

			direction = (typeof e.data === 'undefined' ? 'right' : e.data.direction);

		} else {

			direction = 'right';

		}

		return direction;

	};



	/**

	 * Updates our plugin with the next slide number

	 * @params	object	event

	 * @params	string	animation direction

	 * @returns boolean continue to animate?

	 *

	 */

	Zippy.prototype._next = function(e,direction){



    // If the event was triggered by a slide indicator, we store the data-index value of that indicator

		var index = (typeof e !== 'undefined' ? $(e.currentTarget).data('index') : undefined);



		//Logic for determining the next slide

		switch(true){

			//If the event was triggered by an indicator, we set the next slide based on index

       case( typeof index !== 'undefined'):

				if (this.currSlide == index){

					this.startTimer();

					return false;

				}

				this.currSlide = index;

			break;

			case(direction == 'right' && this.currSlide < (this.totalSlides - 1)):

				this.currSlide++;

			break;

			case(direction == 'right'):

				this.currSlide = 0;

			break;

			case(direction == 'left' && this.currSlide === 0):

				this.currSlide = (this.totalSlides - 1);

			break;

			case(direction == 'left'):

				this.currSlide--;

			break;

		}

		return true;

	};



	/**

	 * Executes the animation via CSS transitions

	 * @params	object	Jquery object the next slide to slide into view

	 * @params	string	animation direction

	 * @returns void

	 *

	 */

	Zippy.prototype._cssAnimation = function($nextSlide,direction){

    //Init CSS transitions

		setTimeout(function(){

			this.$el.addClass('transition');

			this.addCSSDuration();

			this.$currSlide.addClass('shift-'+direction);

		}.bind(this),100);



		//CSS Animation Callback

		//After the animation has played out, remove CSS transitions

		//Remove unnecessary classes

		//Start timer

		setTimeout(function(){

			this.$el.removeClass('transition');

			this.removeCSSDuration();

			this.$currSlide.removeClass('active shift-left shift-right');

			this.$currSlide = $nextSlide.removeClass(direction);

			this._updateIndicators();

			this.startTimer();

		}.bind(this),100 + this.settings.speed);

	};



	/**

	 * Executes the animation via JS transitions

	 * @params	object	Jquery object the next slide to slide into view

	 * @params	string	animation direction

	 * @returns void

	 *

	 */

	Zippy.prototype._jsAnimation = function($nextSlide,direction){

		//Cache this reference for use inside animate functions

		var _ = this;



     // See CSS for explanation of .js-reset-left

		if(direction == 'right') _.$currSlide.addClass('js-reset-left');



     var animation = {};

		animation[direction] = '0%';



		var animationPrev = {};

		animationPrev[direction] = '100%';



		//Animation: Current slide

		this.$currSlide.animate(animationPrev,this.settings.speed);



		//Animation: Next slide

		$nextSlide.animate(animation,this.settings.speed,'swing',function(){

			//Get rid of any JS animation residue

			_.$currSlide.removeClass('active js-reset-left').attr('style','');

			//Cache the next slide after classes and inline styles have been removed

			_.$currSlide = $nextSlide.removeClass(direction).attr('style','');

			_._updateIndicators();

			_.startTimer();

		});

	};



  /**

	 * Ensures the slide indicators are pointing to the currently active slide

	 * @params	void

	 * @returns	void

	 *

	 */

	Zippy.prototype._updateIndicators = function(){

		this.$el.find('.indicators li').removeClass('active').eq(this.currSlide).addClass('active');

	};



	/**

	 * Initialize the plugin once for each DOM object passed to jQuery

	 * @params	object	options object

	 * @returns void

	 *

	 */

	$.fn.Zippy = function(options){



    return this.each(function(index,el){



      el.Zippy = new Zippy(el,options);



    });



  };





/*});*/



function banners() {

	if (!$('.banners-homepage').length)

		return;



// Custom options for the carousel

	var args = {

		arrowRight : '.arrow-right', //A jQuery reference to the right arrow

		arrowLeft : '.arrow-left', //A jQuery reference to the left arrow

		speed : 1000, //The speed of the animation (milliseconds)

		slideDuration : banners_delay //The amount of time between animations (milliseconds)

	};



	$('.banners-homepage').Zippy(args);



	current_banner = 1;

	banners_count = $("#banners_nav img").length;

	if (banners_count < 2)

		return;



	clearInterval(banners_interval);

	banners_interval = setInterval("rotate_banners()", banners_delay);

	$('#banners_nav img').on('click', function() {

		clearInterval(banners_interval);

		banners_interval = setInterval("rotate_banners()", banners_delay);

		var i = $(this).attr('id').replace('g2b_', '');

		current_banner = i;

		$('#banners_nav img').removeClass('active');

		$(this).addClass('active');

		$(".banners-slider div").hide();

		$("#banner_"+i).fadeIn();

		$(".hp_banner").hide();

		$("#hp_banner_"+i).fadeIn();

	});

}



function rotate_banners() {
				current_banner++;

				$('#banners_nav img').removeClass('active');

				$('#g2b_'+(current_banner-1)).addClass('active');



				$(".banners-slider div").hide();

				$("#banner_"+(current_banner-1)).fadeIn();

				$(".hp_banner").hide();

				$("#hp_banner_"+(current_banner-1)).fadeIn();



				if (current_banner == banners_count)

					current_banner = 0;

}



$(document).ready(function() {

	banners();

});(function($) {

"use strict";

	$(document).ready(function() {

		tabs_clicks();

	});

})($);



var containerWidths = [],
	scrollWidth0,
	scroll_size = 276,
	duration = 600,
	defaultContainerWidth = 1600,
	scrollWidthToContainerWidthRatio = 1;


function initCarousels() {
	for (var i = 0; i < 6; i++) {
		containerWidths[containerWidths.length] = 0;
		if ($('#carousel-'+i).length) {
			containerWidths[i] = $('#carousel-'+i+' .res-item').length * scroll_size;
			var width_2 = $('#carousel-'+i+' .res-item').length * scroll_size;
			$('#carousel-'+i+' .responsive-columns').width(width_2).css('min-width', width_2+'px');
			var width = $('#carousel-'+i+' .content-pr').outerWidth() + 20;
			if (width <= containerWidths[i]) {
				$('#carousel-'+i).find('.controls > .button-right').css('display', 'block').css('left', (containerWidths[i]-52)+'px');
			} else {
				if (parseInt($('#carousel-'+i+' .content-pr').css('left')) < 0) {
					$('#carousel-'+i+' .content-pr').animate({
						left: 0
					}, 100);
				}

				$('#carousel-'+i).find('.controls > .button-left').css('display', 'none');
				$('#carousel-'+i).find('.controls > .button-right').css('display', 'none');
			}

			$('#carousel-'+i+' .controls > .button-right').unbind('click').on('click', function() {
				var that = $(this);
				var button_cLeft = that.siblings();
				var scrollContent = that.closest('.carousel-pr').find('.content-pr');
				var width = 0;

				scrollContent.find('.res-item').each(function(){
				  width += $(this).outerWidth();
				  width += parseInt($(this).css('margin-left'));
				  width += parseInt($(this).css('margin-right'));
				  width += parseInt($(this).css('padding-left'));
				  width += parseInt($(this).css('padding-right'));
				})

				width = scrollContent.find('.res-item').length * scroll_size;
				var width_2 = $('.carousel-wrapper').outerWidth();
				if ($(window).width() < 600)
					var width_2 = scroll_size;
				else
					var width_2 = $('.carousel-wrapper').outerWidth();

				var maxScrollWidth = Math.floor(width - width_2);

				var left = parseInt(scrollContent.css('left'));

				var isEnd = false;

				scrollWidth0 = Math.floor(width_2 * scrollWidthToContainerWidthRatio);
				if (Math.abs(left - scrollWidth0) >= maxScrollWidth) {
					scrollWidth0 = maxScrollWidth + left;
					isEnd = true;
				}

				scrollContent.animate({
					left: left - scrollWidth0
				}, duration, function() {
					button_cLeft.fadeIn(duration);

					if (isEnd) {
						that.fadeOut(duration);
					}
				});
			});

  			$('#carousel-'+i+' .controls > .button-left').unbind('click').on('click', function() {
				var that = $(this);
				var button_cRight = that.siblings();
				var scrollContent = that.closest('.carousel-pr').find('.content-pr');

				// Get current scroll position
				var left = parseInt(scrollContent.css('left'));

				var isEnd = false;

				// Determine scrollWidth
				if ($(window).width() < 600)
					var width_2 = scroll_size;
				else
					var width_2 = $('.carousel-wrapper').outerWidth();

				scrollWidth0 = Math.floor(width_2 * scrollWidthToContainerWidthRatio);
				if (left + scrollWidth0 >= 0) {
					isEnd = true;
				}

				scrollContent.animate({
					left: isEnd ? 0 : left + scrollWidth0
				}, duration, function() {
					// Display left button_c
					button_cRight.fadeIn(duration);

					// Determine if we've reached the end
					if (isEnd) {
						// Hide right button_c
						that.fadeOut(duration);
					}
				});
			});
		}
	}
}

$(window).resize(function() {
	initCarousels();
});

function tabs_clicks() {
	initCarousels();
	$('.home-tabs li').on('click', function() {
		return false;
		$('.home-tabs li').removeClass('active');
		$(this).addClass('active');
		$('.tab-content').addClass('hidden');
		$('#tab-'+$(this).data('tab')).removeClass('hidden');
	});

	$('.product-tabs li').on('click', function() {
		$('.product-tabs li').removeClass('active');
		$(this).addClass('active');
		$('.tab-content').addClass('hidden');
		$('#tab-'+$(this).data('tab')).removeClass('hidden');
	});
}var put_filter_push = '';
(function($) {
"use strict";
  $(document).ready(function() {
	if (page == 'search' || page == 'category' || (page == 'brands' && pageid))
		load_filter();

	products_clicks();
  });
})($);

function products_clicks() {
	if ($('body').hasClass('admin-area'))
		return false;

	$('.navigation a, .sort-by a').unbind('click').on('click', function() {
		var h = $(this).attr('href');
		if (!pushed) {
			pushed = true;
		}

		if ($(this).closest('.bottom-pagination').length) {
			$('html, body').animate({
				scrollTop: $('.products-results').offset().top - 100
			}, 300);
		}

		$.ajax({
			url: h,
			error: function() {
				self.location = h;
			},
			success: function(r) {
				$('#content-loading').remove();
				$('.products-results').html(r);
				window.history.pushState({'page': 'search', 'dontrealodfilter': '1', "html":$('.ajax_container').html(),"pageTitle":$('title').html(), 'bread_crumbs': $('#bread_crumbs_container').html()},"", h);
				ajax_clicks();
				dontloadfilter = true;
				proceed_clicks('search');
			}
		});

		return false;
	});

	$('.products .res-item').unbind('mouseenter').mouseenter(function() {
    var photo_box = $(this).find('.photo');
		photo_box.append('<div class="view-quicklook"><svg><use xlink:href="/images/sprite.svg#search"></use></svg></div>');
		var q = photo_box.find('.view-quicklook'),
			i = photo_box.closest('.photo'),
			product_id = i.find('.product-image').attr('id').replace('pid-', '');

		q.css('left', (i.width() / 2 - 35) + 'px');
		q.css('top', (i.height() / 2 - 20)+'px');
		q.css('z-index', 3);
		q.on('click', function() {
			load_quick_look(product_id);
		});
	});

	$('.products .quick-look').unbind('click').on('click', function() {
		var product_id = $(this).data('productid');
		load_quick_look(product_id);
	});

	$('.products .res-item').unbind('mouseleave').mouseleave(function() {
		$(this).find('.view-quicklook').remove();
	});
	$('.products button').unbind('click').on('click', function() {
		bc = false;
		add_to_cart($(this).attr('id').replace('pid',''), 'Y');
	});
}

function load_quick_look(product_id) {
			aload();
			$('body').append('<div class="load hidden"><span class="close close-popup">x</span></div>');
			$('.popup-wrap').css('top', $(window).scrollTop()+'px');

			$('.load').load('/product/'+product_id+'?popup=1', function(r) {
				$('.popup-wrap').height($(window).height());
				unload();
				fade();
				$('.load').html('<span class="close close-popup">x</span>'+r);
				$('.load').addClass('popup product_popup');
				var top = ($(window).scrollTop() + $(window).height() / 2 - $('.product_popup').height() / 2) - 50;
				if (top < $(window).scrollTop())
					top = $(window).scrollTop() + 30;

				$('.product_popup').css('top', top + 'px');

				$(".product_popup img").on('load', function() {
					var top = ($(window).scrollTop() + $(window).height() / 2 - $('.product_popup').height() / 2) - 50;
					if (top < $(window).scrollTop())
						top = $(window).scrollTop() + 30;

					$('.product_popup').css('top', top + 'px');
					$('.product_popup').css('left', ($(window).width() / 2 - $('.product_popup').width() / 2 - 10) + 'px');
				});

				$('.product_popup').css('left', ($(window).width() / 2 - $('.product_popup').width() / 2 - 10) + 'px');
				$('.product_popup').css('opacity', 0).css('transform', 'matrix(0.1, 0, 0, 0.1, 0, 0)');
				setTimeout(function() {
					$('.product_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
					setTimeout(function() {
						$('.product_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
					}, 200);
				}, 200);

				$('.product_popup').show();
				$(window).resize(function() {
					var top = ($(window).scrollTop() + $(window).height() / 2 - $('.product_popup').height() / 2) - 50;
					if (top < $(window).scrollTop())
						top = $(window).scrollTop() + 30;

					$('.product_popup').css('top', top + 'px');

					$('.product_popup').css('left', ($(window).width() / 2 - $('.product_popup').width() / 2 - 10) + 'px');
				});

				$('.product_popup .close, .product_popup .close_popup').on('click', function() {
					removePopups();
					return;
					$('.product_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
					setTimeout(function() {
						$('.product_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
				    	unfade();
					}, 200);

					return;
    				var e = $('.product_popup');
	    			e.slideUp();
					setTimeout(function(){$('body').css('overflow-y', 'auto');e.remove()}, 500);
				});

				$('.product_popup').on('click', function() {
					bc = false;
					bb = true;
				});

				product_clicks()
			});
}

function load_filter(url_params, url_replace) {
	$('#left_filter').html('<div class="cssload-container"><div class="cssload-speeding-wheel"></div></div>');
	if (url_replace)
		var url = url_replace;
	else
		var url = window.location.href;

	if (!strstr(url, '?'))
		url += '?'

	$.ajax({
		url: url+'&load_filter=1'+(url_params ? url_params : '')
	}).done(function(r) {
		$('#left_filter').html(r);
    if (filter_box) {
      $('.filter-box-'+filter_box).html(filter_box_html);
      $('.withfilter .left_filter').animate({
        scrollTop: $('.filter-box-'+filter_box).position().top - 30 + $('.withfilter .left_filter').scrollTop()
      }, 500);
      filter_box = '';
    }

		if (put_filter_push) {
			window.history.pushState({'page': 'search', 'dontrealodfilter': '1', "html":$('.ajax_container').html(),"pageTitle":$('title').html(), 'bread_crumbs': $('#bread_crumbs_container').html()},"", put_filter_push);
			put_filter_push = '';
		}

    ajax_clicks();
		filter_clicks();
	});
}

var filter_box,
  filter_box_html;
function filter_clicks() {
	var url = $('.filter-url').html(),
    filter_url = url ? url.replace("&amp;", "&") : '',
		min_value = parseInt($("#min_price").val()),
		max_value = parseInt($("#max_price").val());

  $('.reset_filter').unbind('click').on('click', function() {
    $('.reset_filter_url').click();
  });

	$('.selected-filter').unbind('click').on('click', function() {
		var what_uncheck = $(this).data('what'),
			url = filter_url,
			id = $(this).data('id'),
			url_params = '';

		$('.selected-filter').each(function() {
			var what = $(this).data('what');
			if (what_uncheck != what) {
				if (what == 'brand') {
					url_params += '&filter[brandid]='+$(this).data('id');
				}

				if (what == 'price') {
					url_params += '&filter[price]='+$(this).data('id');
				}
			}

			if (what == 'attr') {
				if (id != $(this).data('id'))
					url_params += '&filter[attr]['+encodeURIComponent($(this).data('id'))+'][]='+encodeURIComponent($(this).data('oid'));
			}
		});

		load_filter_process(url, url_params);
	});

  $('#left_filter h4.pointer').unbind('click').on('click', function() {
    $(this).next().toggleClass('opened');
    $(this).toggleClass('opened');
  });

	$('#left_filter li').unbind('click').on('click', function() {
    var input = $(this).find('input');
    if (input.is(':checked')) {
      input.prop('checked', false);
      input.attr('checked', false);
  } else {
      input.prop('checked', true);
      input.attr('checked', true);
    }

		var what = $(this).closest('ul').data('what'),
			url = filter_url,
			url_params = '';

		if (what == 'brand') {
			url_params += '&filter[brandid]='+$(this).data('id');
		}

		if (what == 'price') {
			url_params += '&filter[price]='+$(this).data('id');
		}

		if (what == 'attr') {
		}

		$('.selected-filter').each(function() {
			var what = $(this).data('what');
			if (what == 'brand') {
				url_params += '&filter[brandid]='+$(this).data('id');
			}

			if (what == 'price') {
				url_params += '&filter[price]='+$(this).data('id');
			}
    });

    $('.filter-attr input:checked').each(function() {
			url_params += '&filter[attr]['+encodeURIComponent($(this).closest('li').data('id'))+'][]='+encodeURIComponent($(this).closest('li').data('oid'));
    });

    filter_box = $(this).closest('ul').attr('groupid');
    filter_box_html = $(this).closest('ul').html();
		load_filter_process(url, url_params);
	});
}

function load_filter_process(url, url_params) {
    $('body').removeClass('filteropen');
		var h = url+url_params;
		$('html, body').animate({
			scrollTop: $('.products-results').offset().top - 150
		}, 300);

		$('.ajax_container').append('<div id="content-loading" style="margin-top: '+($('.products-results').offset().top - 200)+'px"><div class="cssload-container"><div class="cssload-speeding-wheel"></div></div></div>');
		$('#content-loading').width($('.ajax_container').width());
		$('#content-loading').height($('.ajax_container').height());
		$.ajax({
			url: h,
			error: function() {
				self.location = h;
			},
			success: function(r) {
				$('#content-loading').remove();
				$('.products-results').html(r);
				h = h.replace('filtered=1&amp;', '');
				ajax_clicks();
				put_filter_push = h;
				load_filter(url_params, url);
				dontloadfilter = true;
				proceed_clicks('search');
			}
		});
}

$(window).resize(function() {
  left_filter_max_height();
});

$(window).scroll(function() {
  left_filter_max_height();
});

function left_filter_max_height() {
  if ($('.withfilter .left_filter').length) {
    var max_height = ($(window).height() - 100);
    if ($(window).scrollTop() < 230) {
      max_height = 2000;
    }

    $('.withfilter .left_filter').css('max-height', max_height+'px');
  }
}/*!Zoom v1.7.11 - 2013-11-12	Enlarge images on click or mouseover.	(c) 2013 Jack Moore - http://www.jacklmoore.com/zoom	license: http://www.opensource.org/licenses/mit-license.php*//*!
	Zoom v1.7.11 - 2013-11-12
	Enlarge images on click or mouseover.
	(c) 2013 Jack Moore - http://www.jacklmoore.com/zoom
	license: http://www.opensource.org/licenses/mit-license.php
*/
(function(o){var t={url:!1,callback:!1,target:!1,duration:120,on:"mouseover",touch:!0,onZoomIn:!1,onZoomOut:!1,magnify:1};o.zoom=function(t,n,e,i){var u,c,a,m,r,l,s,f=o(t).css("position");return o(t).css({position:/(absolute|fixed)/.test(f)?f:"relative",overflow:"hidden"}),e.style.width=e.style.height="",o(e).addClass("zoomImg").css({position:"absolute",top:0,left:0,opacity:0,width:e.width*i,height:e.height*i,border:"none",maxWidth:"none"}).appendTo(t),{init:function(){c=o(t).outerWidth(),u=o(t).outerHeight(),n===t?(m=c,a=u):(m=o(n).outerWidth(),a=o(n).outerHeight()),r=(e.width-c)/m,l=(e.height-u)/a,s=o(n).offset()},move:function(o){var t=o.pageX-s.left,n=o.pageY-s.top;n=Math.max(Math.min(n,a),0),t=Math.max(Math.min(t,m),0),e.style.left=t*-r+"px",e.style.top=n*-l+"px"}}},o.fn.zoom=function(n){return this.each(function(){var e,i=o.extend({},t,n||{}),u=i.target||this,c=this,a=document.createElement("img"),m=o(a),r="mousemove.zoom",l=!1,s=!1;(i.url||(e=o(c).find("img"),e[0]&&(i.url=e.data("src")||e.attr("src")),i.url))&&(a.onload=function(){function t(t){e.init(),e.move(t),m.stop().fadeTo(o.support.opacity?i.duration:0,1,o.isFunction(i.onZoomIn)?i.onZoomIn.call(a):!1)}function n(){m.stop().fadeTo(i.duration,0,o.isFunction(i.onZoomOut)?i.onZoomOut.call(a):!1)}var e=o.zoom(u,c,a,i.magnify);"grab"===i.on?o(c).on("mousedown.zoom",function(i){1===i.which&&(o(document).one("mouseup.zoom",function(){n(),o(document).off(r,e.move)}),t(i),o(document).on(r,e.move),i.preventDefault())}):"click"===i.on?o(c).on("click.zoom",function(i){return l?void 0:(l=!0,t(i),o(document).on(r,e.move),o(document).one("click.zoom",function(){n(),l=!1,o(document).off(r,e.move)}),!1)}):"toggle"===i.on?o(c).on("click.zoom",function(o){l?n():t(o),l=!l}):"mouseover"===i.on&&(e.init(),o(c).on("mouseenter.zoom",t).on("mouseleave.zoom",n).on(r,e.move)),i.touch&&o(c).on("touchstart.zoom",function(o){o.preventDefault(),s?(s=!1,n()):(s=!0,t(o.originalEvent.touches[0]||o.originalEvent.changedTouches[0]))}).on("touchmove.zoom",function(o){o.preventDefault(),e.move(o.originalEvent.touches[0]||o.originalEvent.changedTouches[0])}),o.isFunction(i.callback)&&i.callback.call(a)},a.src=i.url,o(c).one("zoom.destroy",function(){o(c).off(".zoom"),m.remove()}))})},o.fn.zoom.defaults=t})(window.jQuery);var rate_clicked = 0,
	gst_applied = false,
	qty_clicked = false,
	clear_clicked = false,
	image_popup_clicked = false,
	lbl_buy1click = "Enter your phone number";

(function($) {
"use strict";
  $(document).ready(function() {
	if (!$('body').hasClass('admin-area')	&& !$('html.itsinvoicepage').length)
		product_clicks();
  });
})($);

var social_loaded = false;

function load_social() {
	return;
	try {
		if (social_loaded) {
			FB.init({
		          status: true,
		          cookie: true,
				xfbml: true
			});

			FB.XFBML.parse();

			twttr.widgets.load();
			return;
		}

	console.log(facebook_api);

		$.ajax({
		  url: facebook_api,
		  dataType: "script",
		  success: function() {
			try {
				FB.init({
					xfbml: true
				});

				FB.XFBML.parse();
			  	social_loaded = true;
				} catch (err) {
				}
		  }
		});

		$.ajax({
		  url: twitter_api,
		  dataType: "script",
		  success: function() {
				try {
					twttr.widgets.load();
			  	social_loaded = true;
				} catch (err) {
				}
		  }
		});
		} catch (err) {
		}
}

function product_clicks() {
	ajax_clicks();
	$('.gift_cards button').unbind('click').on('click', function() {
		var val = $('#gift_card').val();
		if (val) {
			$.ajax({
				type: 'POST',
				url: current_location+'/cart/add_gc/'+val
			}).done(function(r) {
				if (r) {
					alert('Gift Card added to cart');
					$('#minicart').html(r);
					$('#head_mobile #minicart').html(r);
					cart_clicks();
				} else {
					alert('Please, enter numeric value');
				}
			});
		}
	});

	if ($(window).width() > 700)
		$('#zoom').zoom();

	load_social();
	if (oid == 0) {
		qadd = '';
		product_base = $('.product');
	} else {
		qadd = '.product_popup ';
		product_base = $('.product_popup');
	}

	if (oid == 0)
		default_images = $(qadd+'.product .photo table').html();
	else
		default_images_ql = $(qadd+'.product .photo table').html();

	postprocess();
	var rating_clicked = false;
	$('.rating').unbind('mouseleave').mouseleave(function() {
		if (rating_clicked) {
			$('.rating span.r'+$('#review_rating').val()).click();
		} else
			$('.rating').removeClass('r1').removeClass('r2').removeClass('r3').removeClass('r4').removeClass('r5');
	});

	$('.rating span').on('click', function() {
		rating_clicked = true;
		recalc_rating($(this));
		$('#review_rating').val($(this).attr('class').replace('r', ''));
	});

	$('.rating span').unbind('mouseover').mouseover(function() {
		recalc_rating($(this));
	});

	recaptchaOnload();
}

function recalc_rating(span) {
		$('.rating').removeClass('r1').removeClass('r2').removeClass('r3').removeClass('r4').removeClass('r5');
		if (span.hasClass('r1')) {
			$('.rating').addClass('r1');
		} else if (span.hasClass('r2')) {
			$('.rating').addClass('r1').addClass('r2');
		} else if (span.hasClass('r3')) {
			$('.rating').addClass('r1').addClass('r2').addClass('r3');
		} else if (span.hasClass('r4')) {
			$('.rating').addClass('r1').addClass('r2').addClass('r3').addClass('r4');
		} else if (span.hasClass('r5')) {
			$('.rating').addClass('r1').addClass('r2').addClass('r3').addClass('r4').addClass('r5');
		}
}

function postprocess(ql) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		$('[name=pricematch] input').on('keyup', function() {
			if ($(this).parent().parent().find('.star').length > 0) {
				if ($(this).val() != '' && $(this).parent().find('img.mark-green').length == 0 && ($(this).attr('name') != 'email' || emailReg.test($(this).val()))) {
					$(this).parent().find('img.mark-red').remove();
					$(this).removeClass('input-incorrect');
					$(this).parent().append('<img src="'+$('.spacer-src').attr('src')+'" class="mark-green" alt="Field correct" />');
					$(this).addClass('input-correct');
				} else if ($(this).val() == '' || ($(this).attr('name') == 'email' && !emailReg.test($(this).val()))) {
					$(this).parent().find('img.mark-green').remove();
					$(this).removeClass('input-correct');
				}
			}
		});

		$('[name=crform] input, [name=crform] textarea').on('keyup', function() {
			if ($(this).parent().parent().find('.star').length > 0) {
				if ($(this).val() != '' && $(this).parent().find('img.mark-green').length == 0) {
					$(this).parent().find('img.mark-red').remove();
					$(this).removeClass('input-incorrect');
					$(this).parent().append('<img src="'+$('.spacer-src').attr('src')+'" class="mark-green" alt="Field correct" />');
					$(this).addClass('input-correct');
				} else if ($(this).val() == '') {
					$(this).parent().find('img.mark-green').remove();
					$(this).removeClass('input-correct');
				}
			}
		});

		rate_clicked = 0;
		$('div.gst-tab').unbind('click').on('click', function() {
			$('div.gst-tab').removeClass('active');
			$(this).addClass('active');
			if ($(this).attr('id') == 'inc_gst') {
				gst_applied = true;
			} else {
				gst_applied = false;
			}

			recalculate_gst();
		});

		// Save gallery list items
		var o = this;
		if ($(qadd+'#hasVariants').length > 0) {
		}

		$(qadd+'.price-breaks').mouseover(function() {
			$(qadd+'.price-breaks div').show();
		});

		$(qadd+'.price-breaks').mouseout(function() {
			$(qadd+'.price-breaks div').hide();
		});

		$(qadd+'[name=amount]').change(function() {
			if ($(this).val() < 1)
				$(this).val('1');

			product_options(o);
		}).on('keyup', function() {
			product_options(o);
		});

		$('.clear_option').unbind('click').on('click', function() {
			var groupid = $(this).attr('id').replace('poa-', '');
			$('#pot-'+groupid).html('');
			$('#pot-'+groupid).hide();
			$('#poa-'+groupid).hide();
			$('#pog-'+groupid+' img.checked').remove();
			$('#po-'+groupid).val('');
			map_variants(o);
			product_options(o);
			$(qadd+'.options-error').hide();
		});

		$(qadd+'.options_container div').unbind('click').on('click', function() {
			if ($(this).hasClass('unavailable') || !($(this).hasClass('option-image') || $(this).hasClass('option-name')) || clear_clicked) {
				clear_clicked = false;
				return false;
			}

			$(this).parent().find('div img.checked').remove();
			var val = '';
			if ($(this).find('img').length > 0)
				val = $(this).find('img').attr('alt');
			else
				val = $(this).html();

			var groupid = $(this).parent().attr('id').replace('pog-', '');
			$('#pot-'+groupid).html(': '+val);
			$('#pot-'+groupid).show();
			$('#poa-'+groupid).show();
			$(this).append("<img src='"+current_location+"/images/check-mark.png' class='checked'>");
			var optionid = $(this).attr('id').replace('poi-', '');
			$('#po-'+groupid).val(optionid);
			map_variants(o, groupid);
			product_options(o);
			$(qadd+'.options-error').hide();
		});

		$(qadd+'.product_options').unbind('change').change(function() {
			var id = $(this).attr('id').replace('po-', '');
			if ($(this).val()) {
				$('#pot-'+id).html(': '+$(this).find('option:selected').text());
				$('#pot-'+id).show();
				$('#poa-'+id).show();
			} else {
				$('#pot-'+id).hide();
				$('#poa-'+id).hide();
			}

			map_variants(o, id);
			product_options(o);
			$(qadd+'.options-error').hide();
		});

		product_options(o);
		map_variants(o);

		$('.add2cart').unbind('click').on('click', function() {
			if (!option_selected())
				return false;
		});
		// Form AJAX-based submit
		$('form.product-details', product_base).eq(0).unbind('submit').on('submit',
			function(event)
			{
				return o.addProductToCart(event, this);
			}
		);
		// Cloud zoom
		var cloud = $('.cloud-zoom', product_base);
		if (cloud.length) {
			this.zoomWidget = true;
			if (core.getCommentedData(cloud, 'kZoom')) {
				this.kZoom = core.getCommentedData(cloud, 'kZoom');
			}
			var imageWrapper = $(document.createElement('div')).addClass('wrapper');
			cloud.wrap(imageWrapper);
		}
		if ($(qadd+'.product-image-gallery li a').length) {
			// TODO: improve to skip additional JS manipulations
			// like resizing etc when it is not needed
			this.selectImage(0);
		} else if (this.zoomWidget && !cloud.data('zoom')) {
			cloud.CloudZoom();
		}
		// Change Continue shopping button for QuickLook mode
		make_gallery_click_on_quick_look();
		$('.ql-zoom', product_base).css('z-index', 10999);
		// Gallery
		if (typeof(window.lightBoxImagesDir) != 'undefined') {
			$('.loupe', product_base).on('click',
				function(event) {
					o.showLightbox();
					setTimeout(
						function() {
							$('.product-image-gallery li.selected a').eq(0).trigger('click');
						},
						500
					);
					return false;
				}
			);
		}

		// Tabs
		$('.product-details-tabs .tabs div', product_base).on('click',
			function () {
				if (!$(this).hasClass('active')) {
					var id = $(this).find('a').attr('id').substr(5);
					$('.product-details-tabs .tabs div.active').removeClass('active');
					$(this).addClass('active');
					var box = $(this).parents('.product-details-tabs');
					if (box.find('#' + id).hasClass('scroll-pane')) {
						destroy_custom_scrolls_bars(box.find('#' + id));
					}

					destroy_custom_scrolls_bars(box.find('.variants-list'));
					box.find('.tab-container').hide();
					box.find('#' + id).show();
					box.find('.faq-answer').eq(0).show();
					if (box.find('#' + id).hasClass('scroll-pane')) {
						if (box.find('#' + id).hasClass('Reviews-tab')) {
							scroll_apis[scroll_apis.length] = [box.find('#' + id), box.find('#' + id).jScrollPane().data().jsp];
						} else {
							custom_scrolls_bars(box.find('#' + id));
						}
					}

					custom_scrolls_bars(box.find('.variants-list'));
					if ($('.cp_message .progress-bar').length > 0) {
						$('.cp_message div').html('');
						$('.cp_message_fade').hide();
						$('.cp_message').hide();
						$('.cp_message button').show();
					}

					if ($('.cr_message .progress-bar').length > 0) {
						$('.cr_message div').html('');
						$('.cr_message_fade').hide();
						$('.cr_message').hide();
						$('.cr_message button').show();
					}
				}

				return true;
			}
		);
	$('.add-review', product_base).on('click', function() {
		if ($('.norelated').length > 0)
			$('html, body').animate({scrollTop: $(".customerReviews h3").offset().top}, 2000);
		else {
			$('.Reviews-tab').data('jsp').scrollTo(0, $('.Reviews-tab .jspPane').height());
			$(this).hide();
		}
	});
	$('.Reviews-tab').on(
		'jsp-scroll-y',
		function(event, scrollPositionY) {
			$('.add-review').show();
			$('.add-review').css('top', scrollPositionY);
		}
	);
	$('.faq-question', product_base).on('click',
		function() {
			var o = $(this);
			$('.faq-answer').each(
				function() {
					if (o[0] != $(this).parents()[0])
						$(this).slideUp();
				}
			);
			$(this).find('.faq-answer').slideDown(
				'',
				function() {
					custom_scrolls_bars($('.FAQ-tab'));
				}
			);
		}
	);
		// Related Tabs
		$('.related-items .tabs div', product_base).on('click',
			function () {
				if (!$(this).hasClass('active')) {
					var id = $(this).attr('id').substr(5);
					$('.related-items .tabs div.active').removeClass('active');
					$(this).addClass('active');

					var box = $(this).parents('.related-items');
					box.find('.tab-container').hide();
					box.find('#' + id).show();
				}

				return true;
			}
		);
		// Bottom tabs
		$('.product-details-bottom-tabs .tabs div', product_base).on('click',
			function () {
				if (!$(this).hasClass('active')) {
					var id = $(this).find('a').attr('id').replace('link-bt-', '');
					$('.product-details-bottom-tabs .tabs div.active').removeClass('active');
					$(this).addClass('active');
					var box = $(this).parents('.product-details-bottom-tabs');
					if (box.find('.FAQ-tab').length > 0) {
						destroy_custom_scrolls_bars($('.FAQ-tab'));
						box.find('.tab-container').hide();
						$('.FAQ-tab').show();
						custom_scrolls_bars($('.FAQ-tab'));
					} else {
						destroy_custom_scrolls_bars(box.find('#tab-content-'+id+' .scroll-pane'));
						box.find('.tab-container').hide();
						box.find('#tab-content-'+id).show();
						custom_scrolls_bars(box.find('#tab-content-'+id+' .scroll-pane'));
					}
				}

				return true;
			}
		);

		// Custom quantity
		custom_quantity();

		if (!product_base.hasClass('product-quicklook') && !(0 < product_base.parents('.blockUI').length)) {
			$('#relatedItems .img img').on('click', function() {
				popup.postprocessRequestCallback = function()
				{
					popup.postprocessRequest.apply(popup, arguments);
					$(qadd+'.product-image-gallery a').eq(0).trigger('click');
				};

				return !popup.load(
					URLHandler.buildURL({
						target:			'quick_look',
						action:			'',
						productid:		$(this).parent().attr('id').replace('ip', ''),
						only_center:	1
					}),
					'product-quicklook',
					function () {
						oid = 0;
						qadd = '';
						$('.formError').hide();
					},
					50000
				);
			});
			$('.related-to-cart').on('click',
				function()
				{
					if ($(this).hasClass('no-options')) {
						var pid = $(this).attr('id').replace('p', '');
						var data = 'target=cart&action=add&productid='+pid+'&amount='+$(this).parent().find('.value').html()+'&returnURL='+$(qadd+'[name=returnURL]').val();
						var o2 = this;
						$.ajax({
							type: 'POST',
							url: '/store/cart',
							data: data,
							beforeSend: function ( xhr ) {
								$(o2).parent().find('.cquantity').hide();
								$(o2).parent().find('img').hide();
								if ($(o2).parent().find('.progress-bar').length > 0) {
									$(o2).parent().find('.progress-bar').show();
								} else {
									$(o2).parent().append('<div class="progress-bar"><div class="block-wait"><div></div></div></div>');
								}
							}
						}).done(function(data) {
							$('#status-messages ul').html('<li style="" class="status">Product has been added to cart</li>');
							$('#status-messages').slideDown(50);
							setTimeout(function() {$('#status-messages').slideUp(500);$('#status-messages ul').html('<li class="dump">Dump</li>');}, 10000);
							$.ajax({
								type: 'GET',
								url: '?productid='+pid+'&q=store/main/?productid='+pid+'/widget-XLite\\Module\\XCDev\\Medshop\\View\\GetAvail',
								data: data
							}).done(function(data) {
								core.trigger('updatecart', eval('({"items":[]})'));
								if (data != 'N') {
									var qty = data.split('|')[0];
									if (qty == 0) {
										$(o2).parent().find('.cquantity').remove();
										$(o2).parent().append('<div class="ofs">Out of stock</div>');
									} else
										$(o2).parent().find('.values').html(qty);
								}
								custom_quantity();
								$(o2).parent().find('.progress-bar').hide();
								$(o2).parent().find('.cquantity').show();
								if (!(data != 'N' && qty == 0))
									$(o2).parent().find('img').show();
							});
						});
					} else {
						popup.postprocessRequestCallback = function()
						{
							popup.postprocessRequest.apply(popup, arguments);
							$(qadd+'.product-image-gallery a').eq(0).trigger('click');
						};

						return !popup.load(
							URLHandler.buildURL({
								target:			'quick_look',
								action:			'',
								amount:		 $(this).parent().find('.value').html(),
								productid:	$(this).attr('id').replace('p', ''),
								only_center: 1
							}),
							'product-quicklook',
							function () {
								oid = 0;
								qadd = '';
								$('.formError').hide();
							},
							50000
						);
					}
				}
			)
		}

		$('.customerReviews .rate img', product_base).unbind('mouseover').mouseover(function() {
			$('.customerReviews .rate img', product_base).removeClass('hover');
			var id = $(this).attr('id').replace('star-', '');
			for (var i = 0; i < 5; i++) {
				if (i <= id) {
					$('#star-'+i).addClass('hover');
				}
  			}
		}).unbind('click').on('click', function() {
			$('.customerReviews .rate img', product_base).removeClass('hover');
  			var id = parseInt($(this).attr('id').replace('star-', ''));
  			rate_clicked = id+1;
  			for (var i = 0; i < 5; i++) {
	  			if (i <= id) {
	  				$('#star-'+i).addClass('hover');
	  			}
  			}
		});

		$('.customerReviews .rate', product_base).unbind('mouseout').mouseout(function() {
			$('.customerReviews .rate img', product_base).removeClass('hover');
			if (rate_clicked > 0) {
	  			for (var i = 0; i < 5; i++) {
	  				if (i <= rate_clicked-1) {
	  					$('#star-'+i).addClass('hover');
		  			}
	  			}
			}
		});

		$('.r-show-more').mouseover(function() {
			$('.r-over').show();
		});
		$('.r-show-more').mouseout(function() {
			$('.r-over').hide();
		});
		$('.otfilter select').unbind('change').change(function() {
			var found = false;
			$('.otfilter select').each(function() {
				if ($(this).val()) {
					found = true;
				}
			});
			if (found) {
				$('.otfilter .submit').addClass('active');
			}
		});
		$(qadd+'.otfilter .submit').on('click', function() {
			filter_variants(1);
			$('.otfilter .submit').removeClass('active');
		});
		$('.otfilter .reset').unbind('click').on('click', function() {
			if ($(this).hasClass('active')) {
				for (var i = 0; i < document.otfilter.elements.length; i++)
					document.otfilter.elements[i].value='';
				filter_variants(2);
				$(this).removeClass('active');
				$('.otfilter .submit').removeClass('active');
			}
		});
		$('.sorting li').unbind('click').on('click', function() {
			if ($(this).attr('id') && !$(this).hasClass('active')) {
				$(qadd+'.sorting li').removeClass('active');
				$(this).addClass('active');
				filter_variants(0,$(this).attr('id'));
			}
		});

        variantsClicks();

		$('.getquote').on('click', function(){
			if (!option_selected())
				return false;

			var options = '';
			$(qadd+'.product-option textarea').each(function(){
				var name = $(this).attr('name').replace('product_options[', '');
				name = name.replace(']', '');
				options += name+'(|,|)'+encodeURIComponent($(this).val())+'(|;|)';
			});

			$(qadd+'.product-option input').each(function(){
				var name = $(this).attr('name').replace('product_options[', '');
				name = name.replace(']', '');
				options += name+'(|,|)'+encodeURIComponent($(this).val())+'(|;|)';
			});

			$(qadd+'.product-option select').each(function(){
				var name = $(this).attr('name').replace('product_options[', '');
				name = name.replace(']', '');
				options += name+'(|,|)'+encodeURIComponent($(this).val())+'(|;|)';
			});

			popup.load(
				URLHandler.buildURL({
					target:			'get_quote',
					action:			'',
					productid:		$(this).attr('id').replace('gq', ''),
					only_center:	1,
					product_options:options,
					amount:			$(qadd+'[name=amount]').val()
				}),
				'get-quote',
				function () {
					oid = 0;
					qadd = '';
					$('.formError').hide();
				},
				50000
			);
		});

		if (self.location.hash) {
			$('.product-details-tabs .tabs li a#link-' + self.location.hash.substr(1), product_base).click();
		}
}

$('body').on('click',
	function() {
		if (!qty_clicked)
			$('.cquantity .values').hide();

		qty_clicked = false;

		if (!image_popup_clicked)
			$('.image_popup').hide();

		image_popup_clicked = false;
	}
);

$(function() {
	if ($('.related-delim .related-items').length == 1 && $('.related-delim .related-exist .product-details-bottom-tabs').length == 0) {
		$('.product-details-tabs .tab-container').height(427);
	}
});

function make_gallery_click_on_quick_look() {
	$('.product-quicklook .gallery_left, .product-quicklook .vgallery_left').unbind('click').on('click', function() {
		var visible_id = 0;
		var previous_id = 0;
		var prev_id = 0;
		if ($(this).hasClass('vgallery_left')) {
			$('.product-quicklook .variants-gallery ul').each(function() {
				var id = $(this).attr('id').substring(9, 10);
				if (!$(this).hasClass('inactive')) {
					visible_id = id;
					previous_id = prev_id;
				}

				prev_id = id;
			});

			$('.product-quicklook .variants-gallery ul').addClass('inactive');
			if (previous_id == 0 && visible_id == 0)
				$('#vgallery_'+prev_id+'_quick_look').removeClass('inactive');
			else
				$('#vgallery_'+previous_id+'_quick_look').removeClass('inactive');
		} else {
			$('.product-quicklook .product-image-gallery ul.dgallery').each(function() {
				var id = $(this).attr('id').substring(8, 9);
				if (!$(this).hasClass('inactive')) {
					visible_id = id;
					previous_id = prev_id;
				}

				prev_id = id;
			});

			$('.product-quicklook .product-image-gallery ul').addClass('inactive');
			if (previous_id == 0 && visible_id == 0)
				$('#gallery_'+prev_id+'_quick_look').removeClass('inactive');
			else
				$('#gallery_'+previous_id+'_quick_look').removeClass('inactive');
		}
	});

	$('.product-quicklook .gallery_right, .product-quicklook .vgallery_right').unbind('click').on('click', function() {
		var visible_id = 0;
		if ($(this).hasClass('vgallery_right')) {
			var visible_id = 0;
			$('.product-quicklook .variants-gallery ul').each(function() {
				var id = $(this).attr('id').substring(9, 10);
				if (!$(this).hasClass('inactive')) {
					visible_id = id;
				}
			});

			$('.product-quicklook .variants-gallery ul').addClass('inactive');
			var defined = false;
			$('.product-quicklook .variants-gallery ul').each(function() {
				var id = $(this).attr('id').substring(9, 10);
				if (id > visible_id && !defined) {
					$(this).removeClass('inactive');
					defined = true;
				}
			});

			if (!defined) {
				$('#vgallery_0_quick_look').removeClass('inactive');
			}
		} else {
			$('.product-quicklook .product-image-gallery ul.dgallery').each(function() {
				var id = $(this).attr('id').substring(8, 9);
				if (!$(this).hasClass('inactive')) {
					visible_id = id;
				}
			});

			$('.product-quicklook .product-image-gallery ul').addClass('inactive');

			var defined = false;
			$('.product-quicklook .product-image-gallery ul.dgallery').each(function() {
				var id = $(this).attr('id').substring(8, 9);
				if (id > visible_id && !defined) {
					$(this).removeClass('inactive');
					defined = true;
				}
			});

			if (!defined) {
				$('#gallery_0_quick_look').removeClass('inactive');
			}
		}
	});
}

function product_options(o) {
	if (oid == 1) {
		var price = product_price_ql,
			weight = product_weight_ql;
	} else {
		var price = product_price,
			weight = product_weight;
	}

	var variantid = 0;
	if ($(qadd+'#hasVariants').length > 0) {
		$(qadd+'.add2cart').addClass('add2cartN');
		var tmp = getVariantId(),
			idx = tmp[1];

		variantid = tmp[0];
			if (variantid > 0 && variants[oid][idx][5].length > 0) {
				var html = '';
				for (var x in variants[oid][idx][5]) {
					if (x == 0 || x == 4 || x == 9)
						html += '<tr>';

					html += '<td>'+variants[oid][idx][5][x]+'</td>';

					if (x == 3 || x == 7)
						html += '</tr>';
				}

				html += '</tr>';
				$(qadd+'.product .photo table').html(html);
				switch_photo($(qadd+'.product .photo table a:first'));
			} else if ($(qadd+'.variants-gallery').hasClass('isvisible')) {
				$(qadd+'.product-image-gallery').show();
				$(qadd+'.variants-gallery').hide();
				if ($(qadd+'.ql-zoom').length == 0) {
					var next = $('#gallery_0');
				} else {
					var next = $('#gallery_0_quick_look');
				}
			} else {
				if (oid == 0)
					$(qadd+'.product .photo table').html(default_images);
				else
					$(qadd+'.product .photo table').html(default_images_ql);
			}

		if (variantid > 0) {
			$(qadd+'.add2cart').removeClass('add2cartN');
			if (variants[oid][idx][8])
				$(qadd+'.fn.title').html(variants[oid][idx][8]);
			else
				$(qadd+'.fn.title').html($(qadd+'.fntitle').html());

			$(qadd+'.product-sku').html(variants[oid][idx][0]);
			if (variants[oid][idx][2]) {
				$(qadd+'.product-weight').html(price_format(variants[oid][idx][2])+' <span class="weight-symbol">'+weight_symbol+'</span>');
				$(qadd+'.product-weight').closest('tr').removeClass('hidden');
			}

			$(qadd+'.variants-data').show();
			var html = '';
			for (var x in groups[oid]) {
				if (groups[oid][x][1]) {
					if (options[oid][$('#po-'+groups[oid][x][0]).val()]) {
						html += '<td nowrap><a href="javascript: void(0);" class="clearOption" id="co-'+groups[oid][x][0]+'">(x)</a> '+options[oid][$('#po-'+groups[oid][x][0]).val()]+'</td>';
					}
				}
			}

			html += '<td nowrap><a href="javascript: void(0);" class="clearAll">Clear all</a></td>';
			$(qadd+'.variants-data table').html(html);
			$('.clearOption').unbind('click').on('click', function() {
				var groupid = $(this).attr('id').replace('co-', '');
				$('#pot-'+groupid).html('');
				$('#pot-'+groupid).hide();
				$('#poa-'+groupid).hide();
				$('#pog-'+groupid+' img.checked').remove();
				$('#po-'+groupid).val('');
				map_variants(o);
				product_options(o);
			});

			$('.clearAll').unbind('click').on('click', function() {
				for (var x in groups[oid]) {
					var groupid = groups[oid][x][0];
					$('#pot-'+groupid).html('');
					$('#pot-'+groupid).hide();
					$('#poa-'+groupid).hide();
					$('#pog-'+groupid+' img.checked').remove();
					$('#po-'+groupid).val('');
				}
				map_variants(o);
				product_options(o);
			});

			price = variants[oid][idx][1];
			var old_price = price;
			if (variants[oid][idx][7].length > 0) {
				var item_amount = $(qadd+'[name=amount]').val();
				var hv = [];
				var i = 0;
				for (var x in variants[oid][idx][7]) {
					if (variants[oid][idx][7][x][0] <= item_amount) {
						price = variants[oid][idx][7][x][1];
					}

					hv[i] = variants[oid][idx][7][x];
					i++;
				}

				var html = "<tr><th class='left'>Quantity</th><th>Price Per Unit</th></tr>";
				html += '<tr><th class="td left">1-'+hv[0][0]+'</th><th class="td default" id="whpr-'+price_format(old_price)+'">$'+price_format(old_price)+'</th></tr>';
				for (var x in hv) {
					if (x == hv.length-1) {
						html += '<tr><th class="td left">'+hv[x][0]+'+</th><th class="td right" id="whpr-'+hv[x][1]+'">$'+price_format(hv[x][1])+'</th></tr>';
					} else {
						html += '<tr><th class="td left">'+hv[x][0]+'-'+hv[parseInt(x)+1][0]+'</th><th class="td right" id="whpr-'+hv[x][1]+'">$'+price_format(hv[x][1])+'</th></tr>';
					}
				}

				$(qadd+'.price-breaks div table').html(html);
				$(qadd+'table.product-qty').addClass('with-p-b');
				$(qadd+'.price-breaks').show();
				$(qadd+'.price-breaks div').show();
				$(qadd+'.price-breaks div').height($(qadd+'.price-breaks div table').height());
				$(qadd+'.price-breaks div').hide();
			} else {
				$(qadd+'.price-breaks').hide();
				$(qadd+'table.product-qty').removeClass('with-p-b');
			}

			var tmp = $(qadd+'.quantity-box-container input').attr('class').split(" ");
			var classes = '';
			for (var x in tmp) {
				if (tmp[x].indexOf('validate[') > -1) {
					classes += "min[1],max["+variants[oid][idx][3].toString()+"]] ";
				} else {
					classes += tmp[x]+' ';
				}
			}

			if ($(qadd+'.quantity-box-container input').val() > variants[oid][idx][3]) {
				$(qadd+'.quantity-box-container input').val(variants[oid][idx][3]);
			}

			$(qadd+'.quantity-box-container input').attr('class', classes);
			if (variants[oid][idx][3].toString() == '0') {
				console.log(idx);
				$(qadd+'.add2cart').addClass('add2cartN');
				$(qadd+'#quantity').hide();
				$(qadd+'.price-breaks').hide();
				$(qadd+'#out_of_stock').show();
			} else {
				$(qadd+'#out_of_stock').hide();
				$(qadd+'#quantity').show();
				if ($(qadd+'#quantity input').val() < 1)
					$(qadd+'#quantity input').val('1');
			}

			$(qadd+'.options_container').each(function() {
				if ($(this).find('img.checked').length == 0) {
					var gid = $(this).attr('id').replace('pog-', '');
					$(qadd+'#pot-'+gid).html(' <b class="optional">(Optional)</b>');
					$(qadd+'#pot-'+gid).show();
				}
			});
		} else {
			if ($(qadd+'.fntitle').length > 0)
				$(qadd+'.fn.title').html($(qadd+'.fntitle').html());

			var cnt = 0,
				cnt2 = 0;

			$(qadd+'.options_container, '+qadd+'.product-option select').each(function() {
				if (!$(this).hasClass('novar')) {
					cnt2++;
					if ($(this).get(0).tagName == 'DIV') {
						if ($('#po-'+$(this).attr('id').replace('pog-', '')).val())
							cnt++;
					} else if ($(this).val())
						cnt++;
				}
			});

			if (cnt == cnt2) {
				$('[name="options_ex"]').val(1);
				bc = false;
				alert("This options combination is not available");
			} else {
				$('[name="options_ex"]').val(0);
			}

			$(qadd+'.variants-data').hide();
			$(qadd+'.price-breaks').hide();
			$(qadd+'table.product-qty').removeClass('with-p-b');
		}
	} else if (w_prices[oid] && w_prices[oid].length > 0) {
		var item_amount = $(qadd+'[name=amount]').val();
		var hv = [];
		var i = 0;
		var old_price = price;
		for (var x in w_prices[oid]) {
			if (w_prices[oid][x][0] <= item_amount) {
				price = w_prices[oid][x][1];
			}

			hv[i] = w_prices[oid][x];
			i++;
		}

		var html = "<tr><th class='left'>Quantity</th><th>Price Per Unit</th></tr>";
		html += '<tr><th class="td left">1-'+hv[0][0]+'</th><th class="td default" id="whpr-'+price_format(old_price)+'">$'+price_format(old_price)+'</th></tr>';
		for (var x in hv) {
			if (x == hv.length-1) {
				html += '<tr><th class="td left">'+hv[x][0]+'+</th><th class="td right" id="whpr-'+hv[x][1]+'">$'+price_format(hv[x][1])+'</th></tr>';
			} else {
				html += '<tr><th class="td left">'+hv[x][0]+'-'+hv[parseInt(x)+1][0]+'</th><th class="td right" id="whpr-'+hv[x][1]+'">$'+price_format(hv[x][1])+'</th></tr>';
			}
		}

		$(qadd+'.price-breaks div table').html(html);
		$(qadd+'table.product-qty').addClass('with-p-b');
		$(qadd+'.price-breaks').show();
		$(qadd+'.price-breaks div').show();
		$(qadd+'.price-breaks div').height($(qadd+'.price-breaks div table').height());
		$(qadd+'.price-breaks div').hide();
	}

	if (exceptions[oid] && exceptions[oid].length > 0) {
		var ex = exceptions[oid],
			ex_ok = true;

		for (var x in ex) {
			var found = true;
			for (var c in ex[x]) {
				var value = $('#po-'+c).val();
				if (!value) {
					ex_ok = true;
					found = false;
					break;
				}

				if (value != ex[x][c]) {
					found = false;
					break;
				}
			}

			if (found) {
				ex_ok = false;
				break;
			}
		}

    	if (!ex_ok) {
			$('[name="options_ex"]').val(1);
			bc = false;
			alert("This options combination is not available");
		} else
			$('[name="options_ex"]').val(0);
	}

	if ($(qadd+'.quantity-box-container input').val() > product_avail[oid]) {
		$(qadd+'.quantity-box-container input').val(product_avail[oid]);
	}

	if (!variantid && $(qadd+'.product-options').length > 0) {
		var price_modifier = 0,
			weight_modifier = 0;

		for (var x in groups[oid]) {
			for (var y in groups[oid][x][3]) {
				if ($(qadd+'#po-'+x).val() == y) {
					if (groups[oid][x][3][y]) {
						var modifier = groups[oid][x][3][y];
						if (modifier[1] == '%') {
							price_modifier += parseFloat(price) * parseFloat(modifier[0]) / 100;
						} else {
							price_modifier += parseFloat(modifier[0]);
						}

						if (modifier[3] == '%') {
							weight_modifier += parseFloat(weight) * parseFloat(modifier[2]) / 100;
						} else {
							weight_modifier += parseFloat(modifier[2]);
						}
					}
				}
			}
		}

		$(qadd+'[name=nongstprice]').val(parseFloat(price)+parseFloat(price_modifier));
		$('.price-breaks table th').each(function() {
			if ($(this).hasClass('right')) {
				var pr = parseFloat($(this).attr('id').replace('whpr-', ''));
				if (pr > 0) {
					if ($(this).hasClass('default')) {
						$(this).html('$'+price_format(old_price+parseFloat(price_modifier)));
						$(this).attr('id', 'whpr-'+price_format(old_price+parseFloat(price_modifier)));
					} else {
						$(this).html('$'+price_format(pr+parseFloat(price_modifier)));
						$(this).attr('id', 'whpr-'+price_format(pr+parseFloat(price_modifier)));
					}
				}
			}
		});

		$(qadd+'.product-to-cart .product-details-price').html('<span class="currency">'+currency_symbol+'</span>'+price_format(parseFloat(price)+parseFloat(price_modifier)));
		weight = parseFloat(weight)+parseFloat(weight_modifier);
		$(qadd+'.product-weight').html(price_format(weight)+' <span class="weight-symbol">'+weight_symbol+'</span>');
	} else {
		$(qadd+'.product-to-cart .product-details-price').html('<span class="currency">'+currency_symbol+'</span>'+price_format(parseFloat(price)));
	}

	if (oid == 0) {
		recalculate_gst();
	}
}

function getVariantId(r) {
	var variantid = 0;
	var idx = 0;
	for (var x in variants[oid]) {
		var c = 0;
		for (var y in variants[oid][x][4])
			c++;

		var c2 = $(qadd+'.options_container div img.checked').length;
		$(qadd+'.product_options').each(function(){
			if ($(this).val() > 0 && !$(this).hasClass('novar'))
				c2++;
		});

		if (c == c2) {
			variantid = variants[oid][x][6];
			idx = x;
			for (var y in variants[oid][x][4])
				if ($(qadd+'#po-'+y).val() != variants[oid][x][4][y]) {
					variantid = false;
					break;
				}

			if (variantid)
				break;
		}
	}

	return [variantid, idx];
}

function map_variants(o, groupid) {
	var ids = [],
		vids = [],
		cnt = 0;

	$(qadd+'.options_container, '+qadd+'.product-option select').each(function() {
		if (!$(this).hasClass('novar'))
			cnt++;
	});

	if (cnt > 1) {
		var ids = [];
		$(qadd+'.options_container, '+qadd+'.product-option select').each(function() {
			if (!$(this).hasClass('novar')) {
				var gid = $(this).attr('id').replace('pog-', '');
				if ($(this).get(0).tagName == 'DIV') {
					ids[gid] = $('#po-'+gid).val();
				} else {
					ids[$(this).attr('id').replace('po-', '')] = $(this).val();
				}
			}
		});

		var vids = [];
		for (var x in variants[oid]) {
			var found = true;
			for (var y in variants[oid][x][4]) {
				if (ids[y] > 0) {
					var found2 = false;
					for (var z in ids) {
						if (z == y && ids[z] == variants[oid][x][4][y]) {
							found2 = true;
							break;
						}
					}

					if (!found2) {
						found = false;
						break;
					}
				}
			}

			if (found) {
				vids[x] = 1;
			}
		}

		var ids = [];
		for (var x in vids) {
			for (var y in variants[oid][x][4]) {
				if (!ids[y]) {
					ids[y] = [];
				}

				ids[y][variants[oid][x][4][y]] = 1;
			}
		}

		var ids2 = [];
		for (var x in ids) {
			for (var y in ids[x]) {
				ids2[y] = 1;
			}
		}

		remove_options(groupid, ids2);
	}

	$('.help-option').remove();
	$(qadd+'.unavailable').each(function() {
		if (!$(this).parent().hasClass('novar')) {
			var html = '<table>',
				id = $(this).parent().attr('id'),
				found = false;

			$(qadd+'.options_container img.checked').each(function() {
				if (id != $(this).parent().parent().attr('id')) {
					html += '<tr><td>'+$(this).parent().attr('data-title')+'</td><td class="clear"><a href="javascript: void(0);" class="clear-option" id="co-'+$(this).parent().parent().attr('id').replace('pog-', '')+'">Clear</a></td></tr>';
					found = true;
				}
			});

			$(qadd+'.product_options').each(function() {
				if (id != $(this).attr('id').replace('po-', '')) {
					html += '<tr><td>'+$(this).find('option:selected').text()+'</td><td class="clear"><a href="javascript: void(0);" class="clear-option" id="co-'+$(this).attr('id').replace('po-', '')+'">Clear</a></td></tr>';
					found = true;
				}
			});
		}

		html += '</table>';
		if (found)
			$(this).append("<div class='help-option'>Option Not Available in Combination with"+html+'<img src="'+current_location+'/images/spacer.gif" alt="" /></div>');
		else
			$(this).append("<div class='help-option'>Option Not Available<img src='"+current_location+"/images/spacer.gif' alt='' /></div>");
	});

	$('.clear-option').unbind('click').on('click', function() {
		$(this).parent().parent().parent().parent().parent().parent().find('.help-option').remove();
		var groupid = $(this).attr('id').split('-')[1];
		$('#pot-'+groupid).html('');
		$('#pot-'+groupid).hide();
		$('#poa-'+groupid).hide();
		$('#pog-'+groupid+' img.checked').remove();
		$('#po-'+groupid).val('');
		map_variants(o, groupid);
		product_options(o);
		clear_clicked = true;
	});
}

function remove_options(groupid, ids) {
	$(qadd+'.options_container div').each(function() {
		if (!$(this).parent().hasClass('novar') && !$(this).hasClass('clear') && !$(this).hasClass('help-option')) {
			var gid = $(this).parent().attr('id').replace('pog-', '');
			if (gid != groupid) {
				var optid = $(this).attr('id').replace('poi-', '');
				if (ids[optid] == 1) {
					$(this).removeClass('unavailable');
				} else {
					$(this).addClass('unavailable');
					if ($(this).find('img.checked').size > 0) {
						$(this).find('img.checked').remove();
						$(qadd+'#pot-'+groupid).html('');
						$(qadd+'#pot-'+groupid).hide();
						$(qadd+'#poa-'+groupid).hide();
						$(qadd+'#po-'+groupid).val('');
					}
				}
			}
		}
	});

	$(qadd+'.product-option select').each(function() {
		var gid = $(this).attr('id').replace('po-', '');
		if (!$(this).hasClass('novar') && gid != groupid) {
			for (var x = 0; x < $(this).find('option').length; x++) {
				var opt = $(this).find('option:eq('+x+')');
				var optid = opt.val();
				if (!optid || ids[optid] == 1) {
					opt.removeClass('unallowed');
					opt.attr('disabled', false);
				} else {
					opt.addClass('unallowed');
					opt.attr('disabled', true);
				}
			}
		}
	});
}

function recalculate_gst() {
	var price = $('[name=nongstprice]').val();
	if (price) {
		if (gst_applied) {
			$('.product-to-cart h3').html('$' + price_format(price * 1.1));
			$('.price-breaks table th').each(function() {
				if ($(this).hasClass('td')) {
					var pr = parseFloat($(this).attr('id').replace('whpr-', ''));
					if (pr > 0) {
						$(this).html('$'+price_format(pr * 1.1));
					}
				}
			});

		} else {
			$('.product-to-cart h3').html('$' + price_format(price));
		}
	}
}

function custom_quantity() {
	var cq_zindexes = parseInt($(qadd+'.cquantity').length) + 5;

	$(qadd+'.cquantity').each(
		function() {
			var max = parseInt($(this).find('.values').html());
			if (!IsNumeric(max))
				return true;

			if (max == 0) {
				$(this).find('.value').html('0');
				$(this).parent().find('.related-to-cart').hide();
			} else {
				var current = parseInt($(this).find('.value').html());
				if (max > 50)
					max = 50;
				var html = '<ul>';
				for (var i = 1; i <= max; i++) {
					html += '<li'+(i == current?' class="selected"':'')+'>'+i+'</li>';
				}
				html += '</ul>';
				$(this).find('.values').html(html);
				$(this).css('z-index', cq_zindexes);
				cq_zindexes--;
			}
		}
	).unbind('click').on('click',
		function() {
			if ($(this).hasClass('sbclicked')) {
				$(this).removeClass('sbclicked');
			} else {
				qty_clicked = true;
				var was_visible = false;
	 			if ($(this).find('.values').is(':visible')) {
	 				$(this).find('.values').hide();
	 				was_visible = true;
		 		}
				$('.cquantity .values').hide();
				if (!was_visible && !$(this).hasClass('clicked')) {
					destroy_custom_scrolls_bars($(this).find('.values'));
					$('.cquantity .values').hide();
					$(this).find('.values').show();
					custom_scrolls_bars($(this).find('.values'));
					$(this).find('.jspVerticalBar').on('click', function() {
						qty_clicked = true;
						$(this).parent().parent().parent().addClass('sbclicked');
					});
					$(this).find('.values li').unbind('click').on('click',
						function() {
							$('.values li').removeClass('selected');
							$(this).addClass('selected');
							$(this).parent().parent().parent().parent().parent().find('.value').html($(this).html());
							$(this).parent().parent().parent().parent().hide();
							$('.cquantity').removeClass('clicked');
							$(this).parent().parent().parent().parent().parent().addClass('clicked');
						}
					);
				}
				$('.cquantity').removeClass('clicked');
   			}
		}
	);
}

function filter_variants(f,sort) {
	var data = '';
	for (var i = 0; i < document.otfilter.elements.length; i++)
		if (document.otfilter.elements[i].name != '' && document.otfilter.elements[i].value != '')
			data += document.otfilter.elements[i].name+'='+cp_escape(document.otfilter.elements[i].value)+'&';

	if (f == 1) {
		if (data && $('.otfilter .submit').hasClass('active'))
			$('.otfilter .reset').addClass('active');
		else
			return false;
	}

	$.ajax({
		type: 'GET',
		url: '?productid='+$('form.product-details', product_base).get(0).elements.namedItem('productid').value+'&'+data+'sort='+sort+'&q=store/main/?/widget-XLite\\Module\\XCDev\\Medshop\\View\\OptionsTableFilter',
		beforeSend: function ( xhr ) {
			if ($('.variants-list').width() < 800)
				$('.Table-tab .progress-bar').css('left', '241px');
			else
				$('.Table-tab .progress-bar').css('left', '500px');
			$('.Table-tab .progress-bar').show();
			$('.variants-list').addClass('variants-loading');
		}
	}).done(function(data) {
		$('.variants-list').hide();
		$('.Table-tab .progress-bar').hide();
		$('.variants-list').removeClass('variants-loading');
		destroy_custom_scrolls_bars($('.variants-list'));
		$('.variants-list').html(data);
		$('.variants-list').html($('.variants-list .ajax-container-loadable').html());
		$('.variants-list').show();
		custom_scrolls_bars($('.variants-list'));
		variantsClicks();
		custom_quantity();
	});
}

function variantsClicks() {
	$('.sku img').unbind('click').on('click', function() {
		$('.otfilter .image_popup .img').remove();
		$('.otfilter .image_popup').append('<div class="img">'+$(this).parent().find('.image').html()+'</div>');
		$('.otfilter .image_popup').show();
		image_popup_clicked = true;
	});

	$('.otfilter .image_popup .close').unbind('click').on('click', function() {
		$('.otfilter .image_popup').hide();
	});

	$('.otfilter .image_popup').unbind('click').on('click', function() {
		image_popup_clicked = true;
	});

	$('.v2cart, .wp img').unbind('click').on('click', function() {
		if ($(this).hasClass('v2cart')) {
			var amount = 1;
			var vid = $(this).parent().attr('id').replace('v-', '');
		} else {
			var amount = $(this).parent().find('.value').html();
			var vid = $(this).parent().parent().attr('id').replace('v-', '');
		}

		var pid = $('.product-details [name=productid]').val();
		var data = 'target=cart&action=add&productid='+pid+'&variantid='+vid+'&amount='+amount+'&returnURL='+$(qadd+'[name=returnURL]').val();
		var o2 = this;
		$.ajax({
			type: 'POST',
			url: '/store/cart',
			data: data,
			beforeSend: function ( xhr ) {
				if ($(o2).hasClass('v2cart')) {
					$(o2).parent().append('<img src="'+$('.spacer-src').attr('src')+'" class="loading" alt="Please, wait." />');
					$(o2).hide();
					$(o2).parent().find('.wp').addClass('wphidden');
				} else {
					$(o2).parent().parent().append('<img src="'+$('.spacer-src').attr('src')+'" class="loading" alt="Please, wait." />');
					$(o2).parent().parent().find('.v2cart').hide();
					$(o2).parent().addClass('wphidden');
				}
			}
		}).done(function(data) {
			$('#status-messages ul').html('<li style="" class="status">Product has been added to cart</li>');
			$('#status-messages').slideDown(50);
			setTimeout(function() {$('#status-messages').slideUp(500);$('#status-messages ul').html('<li class="dump">Dump</li>');}, 10000);
			$.ajax({
				type: 'GET',
				url: '?productid='+pid+'&variantid='+vid+'&q=store/main/?productid='+pid+'/widget-XLite\\Module\\XCDev\\Medshop\\View\\GetAvail',
				data: data
			}).done(function(data) {
				core.trigger('updatecart', eval('({"items":[]})'));
				var qty = -1;
				if (data != 'N') {
					qty = data.split('|')[0];
					$(o2).parent().find('.values').html(qty);
				}

				if (qty == 0) {
					if ($(o2).hasClass('v2cart')) {
						$(o2).parent().parent().addClass('ofs');
						$(o2).parent().parent().html('Out Of Stock');
					} else {
						$(o2).parent().parent().parent().addClass('ofs');
						$(o2).parent().parent().parent().html('Out Of Stock');
					}
				} else {
					custom_quantity();
					if ($(o2).hasClass('v2cart')) {
						$(o2).parent().find('.loading').remove();
						$(o2).parent().find('.wp').removeClass('wphidden');
						$(o2).show();
					} else {
						$(o2).parent().parent().find('.loading').remove();
						$(o2).parent().parent().find('.v2cart').show();
						$(o2).parent().removeClass('wphidden');
					}
				}
			});
		});
	});
}

function option_selected() {
	if ($(qadd+'#hasVariants').length > 0) {
		if ($(qadd+' input.quantity').val() == 0)
			return false;
		else {
			var tmp = getVariantId();
			var variantid = tmp[0];
			if (!(variantid > 0)) {
				$(qadd+'.options-error').show();
				setTimeout('hideOptionsError()', 1000);
				return false;
			}
		}
	} else {
		for (var x in groups[oid]) {
			if (!$(qadd+'#po-'+x).get(0)) {
				continue;
			}

			if (!($(qadd+'#po-'+x).val() > 0)) {
				$(qadd+'.options-error').show();
				setTimeout('hideOptionsError()', 1000);
				return false;
			}
		}
	}

	return true;
}

function validate_gq() {
	if (!document.gqform.name.value) {
		document.gqform.name.focus();
		$('[name=gqform] [name=name]').addClass('input-incorrect');
		return false;
	}

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if (!document.gqform.email.value || !emailReg.test(document.gqform.email.value)) {
		document.gqform.email.focus();
		$('[name=gqform] [name=email]').addClass('input-incorrect');
		return false;
	}

	var data = '&';
	for (var i = 0; i < document.gqform.elements.length; i++) {
		if (document.gqform.elements[i].name != '')
			data += document.gqform.elements[i].name+'='+cp_escape(document.gqform.elements[i].value)+'&';
	}

	$.ajax({
		type: 'GET',
		url: '?q=store/main/?'+data+'/widget-XLite\\Module\\XCDev\\Medshop\\View\\GetQuote',
		beforeSend: function (xhr) {
			$('[name=gqform]').html('<div class="progress-bar"><div class="block-wait"><div></div></div></div>');
		}
	}).done(function(data) {
		$('[name=gqform]').html('<h2>Thank you. We will get back soon.</h2>');
	});

	return false;
}

function add_to_cart(productid, is_quick) {
	aload();
	$('.product_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
	setTimeout(function() {
		$('.product_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
		setTimeout(function() {
			$('.product_popup').remove();
		}, 200);
	}, 200);

	if (!mobile_design)
		$('body').append('<div class="popup no_animation cart_popup hidden"></div>');

	$.ajax({
		url: current_location+'/cart/add',
		type: 'POST',
		data: (is_quick == 'Y' ? "productid="+productid+"&amount=1" : $(qadd+'form[name="product-details"]').serialize())
	}).done(function(r) {
		unload();
		if (r == "1") {
			alert("Please, select options");
			return false;
		}

		if (mobile_design) {
			alert("Product has been added to your cart.<br /><br /><a href='/cart'><button>View cart</button></a> &nbsp; <a href='/checkout'><button>Checkout</button></a>", 1);
		}

		var result = r.toString().split(ajax_delimiter);
		$('.cart_popup').html('<span class="close close-popup">x</span>'+result['1']);
		$('#minicart').html(result['0']);
		$('#head_mobile #minicart').html(result['0']);
		unload();
		fade();
		var top = ($(window).scrollTop() + $(window).height() / 2 - $('.cart_popup').height() / 2) - 50;
		if (top < $(window).scrollTop())
			top = $(window).scrollTop() + 30;

		$('.cart_popup').css('top', top + 'px');
		$('.cart_popup').css('opacity', 0).css('left', ($(window).width() / 2 - $('.cart_popup').width() / 2 - 20) + 'px');
		$('.cart_popup').removeClass('no_animation');
		$('.cart_popup').css('opacity', 0).css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
		setTimeout(function() {
			$('.cart_popup').css('opacity', 1).css('transform', 'matrix(1.1, 0, 0, 1.1, 0, 70)');
			setTimeout(function() {
				$('.cart_popup').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
			}, 200);
		}, 200);

		$('.cart_popup').removeClass('hidden');

		$(window).resize(function() {
			var top = ($(window).scrollTop() + $(window).height() / 2 - $('.cart_popup').height() / 2) - 50;
			if (top < $(window).scrollTop())
					top = $(window).scrollTop() + 30;

			$('.cart_popup').css('top', top + 'px');
			$('.cart_popup').css('left', ($(window).width() / 2 - $('.cart_popup').width() / 2 - 20) + 'px');
		});

		$('.cart_popup .close, .cart_popup .close_popup').on('click', function() {
			$('.fade').click();
			return;
    		var e = $('.cart_popup');
	    	e.slideUp();
	    	unfade();
			setTimeout(function(){e.remove()}, 500);
		});

		$('.cart_popup').on('click', function() {
			bc = false;
			bb = true;
		});

		cart_clicks();
	});

	return false;
}

function check_exceptions() {
  for (var x in exceptions) {
    if (!hasOwnProperty(exceptions, x) || isNaN(x))
      continue;

    var found = true;
    for (var c in exceptions[x]) {
      if (!hasOwnProperty(exceptions[x], c))
        continue;

      var value = getPOValue(c);
      if (!value)
        return true;

      if (value != exceptions[x][c]) {
        found = false;
        break;
      }
    }

    if (found)
      return false;
  }

  return true;
}

function switch_photo(a) {
	if (mobile_design) {
		$('#zoom-mobile').html('<img src="'+a.attr('href')+'">');
	} else if ($('.product_popup').is(':visible')) {
		$('.product_popup #zoom').html('<img src="'+a.attr('href')+'">');
		if ($(window).width() > 700)
			$('.product_popup #zoom').zoom();
	} else {
		$('#zoom').html('<img src="'+a.attr('href')+'">');
		if ($(window).width() > 700)
			$('#zoom').zoom();
	}

	return false;
}

function send_to_friend() {
	if (!$('#send_to_friend [name="name"]').val()) {
		func_highlight($('#send_to_friend [name="name"]'));

		return false;
	}

	var r = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if (!$('#send_to_friend [name="email"]').val() || !r.test($('#send_to_friend [name="email"]').val())) {
		func_highlight($('#send_to_friend [name="email"]'));
		return false;
	}

	if (!$('#send_to_friend [name="friend"]').val() || !r.test($('#send_to_friend [name="friend"]').val())) {
		func_highlight($('#send_to_friend [name="friend"]'));
		return false;
	}

	$('#send_to_friend').submit();
}

function add_review() {
	if (!$('#tab-5 [name="rating"]').val()) {
		alert('Please, select your rating.');
		return false;
	}

	if (!$('#tab-5 [name="name"]').val()) {
		func_highlight($('#tab-5 [name="name"]'));
		return false;
	}

	if (!$('#tab-5 [name="message"]').val()) {
		func_highlight($('#tab-5 [name="message"]'));
		return false;
	}

	aload();
	$.ajax({
		url: window.location.href,
		type: 'POST',
		data: $('#tab-5 form').serialize()
	}).done(function(r) {
		unload();
		if (r == "1") {
			alert("Please, enter your name and message");
			return false;
		} else if (r == '2') {
			recaptchaOnload();
			alert("Captcha is incorrect");
			return false;
		} else if (r == '3') {
			recaptchaOnload();
			alert("Your review has been sent to moderation");
			$('#tab-5 [name="name"]').val('');
			$('#tab-5 [name="message"]').val('');
			return false;
		}
	});
}

function add_wishlist(id) {
	$.ajax({
		url: current_location+'/wishlist?add='+id
	}).done(function(r) {
		alert("Product has been added to your Wishlist");
	});
}

function buy_one_click(pid) {
	alert("We will contact you soon<br /><input type='text' placeholder='"+lbl_buy1click+"' /> <a class='main-button'>Send</a>", 1, '', 'buy_one_click');
	$('.buy_one_click a.main-button').on('click', function() {
		var val = $('.buy_one_click input').val();
		if (!val)
			return false;
		$.ajax({
			url: current_location+'/buy1click?productid='+pid+'&phone='+val
		}).done(function(r) {
			$('.buy_one_click').remove();
			if (r == 'N') {
				alert("You can require quick sale not more than once per 10 seconds");
			} else {
				alert("Please, allow us a few minutes to receive your request");
			}
		});

		return false;
	});
}

var recaptcha1, recaptcha2, recaptcha3, recaptcha4, recaptcha_reg;
function recaptchaOnload() {
	if ($('#recaptcha_reviews').length) {
		try {
			grecaptcha.reset(recaptcha1);
		} catch (err) {
		}
		try {
    	  var verifyCallback = function(response) {
	      };

    	    recaptcha1 = grecaptcha.render(document.getElementById('recaptcha_reviews'), {
        	  'sitekey' : $('#recaptcha_reviews').data('sitekey'),
	          'callback' : verifyCallback
    	    });
		} catch (err) {
		}
	}

	if ($('#recaptcha_s2f').length) {
		try {
			grecaptcha.reset(recaptcha2);
		} catch (err) {
		}
		try {
    	  var verifyCallback = function(response) {
	      };

    	    recaptcha2 = grecaptcha.render(document.getElementById('recaptcha_s2f'), {
        	  'sitekey' : $('#recaptcha_s2f').data('sitekey'),
	          'callback' : verifyCallback
    	    });
		} catch (err) {
		}
	}

	if ($('#recaptcha_contact').length) {
		try {
			grecaptcha.reset(recaptcha3);
		} catch (err) {
		}
		try {
    	  var verifyCallback = function(response) {
	      };

    	    recaptcha3 = grecaptcha.render(document.getElementById('recaptcha_contact'), {
        	  'sitekey' : $('#recaptcha_contact').data('sitekey'),
	          'callback' : verifyCallback
    	    });
		} catch (err) {
		}
	}

	if ($('#recaptcha_register').length) {
		try {
			grecaptcha.reset(recaptcha_reg);
		} catch (err) {
		}
		try {
    	  var verifyCallback = function(response) {
	      };

    	    recaptcha_reg = grecaptcha.render(document.getElementById('recaptcha_register'), {
        	  'sitekey' : $('#recaptcha_register').data('sitekey'),
	          'callback' : verifyCallback
    	    });
		} catch (err) {
		}
	}

	if ($('#recaptcha_ticket').length) {
		try {
			grecaptcha.reset(recaptcha4);
		} catch (err) {
		}
		try {
    	  var verifyCallback = function(response) {
	      };

    	    recaptcha4 = grecaptcha.render(document.getElementById('recaptcha_ticket'), {
        	  'sitekey' : $('#recaptcha_ticket').data('sitekey'),
	          'callback' : verifyCallback
    	    });
		} catch (err) {
		}
	}
}(function($) {
"use strict";
  $(document).ready(function() {
	states_actions();
  });
})($);

function states_actions() {
	$('#country').unbind('change').change(function() {
		console.log('Country changed');
		bc = false;
		if (states[$(this).val()]) {
			var s = states[$(this).val()]['states'],
				html = '<select name="posted_data[state]" id="state">';
			for (var x in s)
				html += '<option value="'+s[x]['code']+'"'+(s[x]['code'] == user_state ? ' selected' : '')+'>'+s[x]['state']+'</option>';

			html += '</select>';
			if ($('.admin-area').length)
				$('#state').closest('td').html('<div class="select-title">State</div>'+html);
			else
				$('#state').parent().html(html);

			$('#state').unbind('change').change(function() {
				user_state = $(this).val();
			});
		} else {
			if ($('.admin-area').length)
				$('#state').closest('td').html('<input type="text" name="posted_data[state]" id="state" value="'+user_state+'" /></td>');
			else
				$('#state').parent().html('<input type="text" name="posted_data[state]" id="state" value="'+user_state+'" /></td>');

			$('#state').unbind('keyup').on('keyup', function() {
				user_state = $(this).val();
			});

			if ($('.admin-area').length) {
				try {
					custom_elements();
					reinitialize_mdl();
				} catch (err) {
				}
			}
		}
	});

	$('#b_country').unbind('change').change(function() {
		console.log('Country changed');
		bc = false;
		if (states[$(this).val()]) {
			var s = states[$(this).val()]['states'],
				html = '<select name="posted_data[b_state]" id="b_state">';

			for (var x in s)
				html += '<option value="'+s[x]['code']+'"'+(s[x]['code'] == user_state_b ? ' selected' : '')+'>'+s[x]['state']+'</option>';

			html += '</select>';
			$('#b_state').parent().html(html);

			$('#b_state').unbind('change').change(function() {
				user_state_b = $(this).val();
			});
		} else {
			$('#b_state').parent().html('<input type="text" name="posted_data[b_state]" id="b_state" required value="'+user_state+'" /></td>');

			$('#b_state').unbind('keyup').on('keyup', function() {
				user_state_b = $(this).val();
			});
		}
	});

	$('#country_checkout').unbind('change').change(function() {
		console.log('Country changed');
		bc = false;
		if (states[$(this).val()]) {
			var s = states[$(this).val()]['states'],
				html = '<select name="posted_data[state]" id="state_checkout">';

			for (var x in s)
				html += '<option value="'+s[x]['code']+'"'+(s[x]['code'] == user_state ? ' selected' : '')+'>'+s[x]['state']+'</option>';

			html += '</select>';
			$('#state_checkout').parent().html(html);
			$('#state_checkout').unbind('change').change(function() {
				user_state = $(this).val();
			});
		} else {
			$('#state_checkout').parent().html('<input type="text" name="posted_data[state]" id="state_checkout" value="'+user_state+'" /></td>');
			$('#state_checkout').unbind('keyup').on('keyup', function() {
				user_state = $(this).val();
			});
		}

		try {
			checkout_changes();
		} catch (err) {
		}
	});

	setTimeout(function() {
		$('#country_checkout').trigger('change');
		$('#country').trigger('change');
		$('#b_country').trigger('change');
	}, 100);
}var register_form = [];

register_form['firstname'] = "Firstname";

register_form['lastname'] = "Lastname";

register_form['email'] = "E-mail";

register_form['password'] = "Password";



register_form['address'] = "Address";

register_form['city'] = "City";

register_form['zipcode'] = "Zip/Postal code";

register_form['phone'] = "Phone";



(function($) {

"use strict";

  $(document).ready(function() {

	if (page == 'checkout') {
		checkout_actions();

		coupon_actions();

		checkout_changes();

		$('#place_order *').attr('disabled', true);

	}

  });

})($);var register_form = [];

register_form['firstname'] = "Firstname";

register_form['lastname'] = "Lastname";

register_form['email'] = "E-mail";

register_form['password'] = "Password";



register_form['address'] = "Address";

register_form['city'] = "City";

register_form['zipcode'] = "Zip/Postal code";

register_form['phone'] = "Phone";



(function($) {

"use strict";

  $(document).ready(function() {

	if (page == 'checkout') {
		checkout_actions();

		coupon_actions();

		checkout_changes();

		$('#place_order *').attr('disabled', true);

	}

  });

})($);function check_new_testimonial() {
	var error = false;



	if (!$('#testimonial_name').val()) {

		func_highlight($('#testimonial_name'));

		error = true;

	}



	if (!$('#testimonial_message').val()) {
		func_highlight($('#testimonial_message'));
		error = true;

	}



	if (error)

		return false;
}var ticket_cats = [],

	ticket_cat1 = '',

	ticket_cat2 = '',

	ticket_cat3 = '',

	ticket_cat4 = '',

	ticket_cat5 = '';



(function($) {

"use strict";

  $(document).ready(function() {

	if (page == 'ticket')

		make_ticket_form();
  });

})($);



function make_ticket_form() {
	$('#ticket_email').unbind('keyup').on('keyup', function() {
		if (this.value && document.getElementById('error_mes').style.display == 'block')

			document.getElementById('error_mes').style.display='none';
	});



	$('#ticket_subject').unbind('keyup').on('keyup', function() {

		if (this.value && document.getElementById('error_mes').style.display == 'block')

			document.getElementById('error_mes').style.display='none';

	});



	$('#ticket_message').unbind('keyup').on('keyup', function() {

		if (this.value && document.getElementById('error_mes').style.display == 'block')

			document.getElementById('error_mes').style.display='none';

	});



	$('#post_new_message').unbind('keyup').on('keyup', function() {

		if (this.value && document.getElementById('error_mes').style.display == 'block')

			document.getElementById('error_mes').style.display='none';

	});



	$('#ticketmesform').unbind('submit').on('submit', function() {
		if (document.mesform.message.value == '') {
			document.getElementById('error_mes').style.display='block';

			return false;

		} else {
			document.getElementById('error_mes').style.display='none';

			this.disabled=true;

			submitForm(this, 'create_new');

		}
	});


	var html = '<select id="ticket_cat_1" name="ticket_cat_1"><option value=""></option>',

		array = [];



	for (var x in ticket_cats) {
		if (in_array(ticket_cats[x][0], array))

			continue;


		array[array.length] = ticket_cats[x][0];
		html += '<option value="'+ticket_cats[x][0].replace(/"/g, '&quot;')+'">'+ticket_cats[x][0]+'</option>';
	}



	html += '</select><div class="ticket-tooltip" id="ticket-tooltip_1"></div><div class="mdl-tooltip" for="ticket-tooltip_1">Select version</div>';

	$('#ticket_category').html(html);

	$('#ticket_cat_1').change(function() {
		$('#ticket_cat_2, #ticket_cat_3, #ticket_cat_4, #ticket_cat_5, #ticket_fields').remove();

		$('#ticket-tooltip_2, #ticket-label_2, #ticket-tooltip_3, #ticket-label_3, #ticket-tooltip_4, #ticket-label_4, #ticket-tooltip_5, #ticket-label_5').remove();

		ticket_cat1 = $(this).val();

		ticket_cat2 = '';

		ticket_cat3 = '';

		ticket_cat4 = '';

		ticket_cat5 = '';

		ticket_category_1();

	});
}



function ticket_category_1() {

	var html = '<select id="ticket_cat_2" name="ticket_cat_2"><option value=""></option>',

		array = [],

		current_cat = [];



	for (var x in ticket_cats) {

		if (ticket_cats[x][0] == ticket_cat1) {
			if (!ticket_cats[x][1])

				current_cat = [ticket_cats[x][6], ticket_cats[x][7]];



			if (in_array(ticket_cats[x][1], array) || !ticket_cats[x][1])

				continue;



			array[array.length] = ticket_cats[x][1];

			html += '<option value="'+ticket_cats[x][1].replace(/"/g, '&quot;')+'">'+ticket_cats[x][1]+'</option>';

		}

	}



	if (array.length) {

		html += '</select><div class="ticket-tooltip" id="ticket-tooltip_2"></div><div class="mdl-tooltip" for="ticket-tooltip_2">'+(current_cat[1] ? current_cat[1] : 'Select build for AX version selected above. If you are not sure or don’t see your version, choose "I don’t know".')+'</div>';

		$('#ticket_category').append('<div class="ticket-label" id="ticket-label_2">'+(current_cat[0] ? current_cat[0] : 'Build')+'</div>'+html);

		reinitialize_mdl();

		tooltips_clicks();

		$('#ticket_cat_2').change(function() {

			$('#ticket_cat_3, #ticket_cat_4, #ticket_cat_5, #ticket_fields').remove();

			$('#ticket-tooltip_3, #ticket-label_3, #ticket-tooltip_4, #ticket-label_4, #ticket-tooltip_5, #ticket-label_5').remove();

			ticket_cat2 = $(this).val();

			ticket_cat3 = '';

			ticket_cat4 = '';

			ticket_cat5 = '';

			ticket_category_2();

		});

	} else {

		make_tickets_fields();

	}

}



function ticket_category_2() {

	var html = '<select id="ticket_cat_3" name="ticket_cat_3"><option value=""></option>',

		array = [],

		current_cat = [];



	for (var x in ticket_cats) {

		if (ticket_cats[x][0] == ticket_cat1 && ticket_cats[x][1] == ticket_cat2) {

			if (!ticket_cats[x][2])

				current_cat = [ticket_cats[x][6], ticket_cats[x][7]];



			if (in_array(ticket_cats[x][2], array) || !ticket_cats[x][2])

				continue;



			array[array.length] = ticket_cats[x][2];

			html += '<option value="'+ticket_cats[x][2].replace(/"/g, '&quot;')+'">'+ticket_cats[x][2]+'</option>';

		}

	}



	if (array.length) {

		html += '</select>';

		html += '</select><div class="ticket-tooltip" id="ticket-tooltip_3"></div><div class="mdl-tooltip" for="ticket-tooltip_3">'+(current_cat[1] ? current_cat[1] : 'Select service type you want to request. Use guide on the right hand side to get the details on all the services AX prime offers.')+'</div>';

		$('#ticket_category').append('<div class="ticket-label" id="ticket-label_3">'+(current_cat[0] ? current_cat[0] : 'Service')+'</div>'+html);

		reinitialize_mdl();

		tooltips_clicks();

		$('#ticket_cat_3').change(function() {

			$('#ticket_cat_4, #ticket_cat_5, #ticket_fields').remove();

			$('#ticket-tooltip_4, #ticket-label_4, #ticket-tooltip_5, #ticket-label_5').remove();

			ticket_cat3 = $(this).val();

			ticket_cat4 = '';

			ticket_cat5 = '';

			ticket_category_3();

		});

	} else {

		make_tickets_fields();

	}

}



function ticket_category_3() {

	var html = '<select id="ticket_cat_4" name="ticket_cat_4"><option value=""></option>',

		array = [],

		current_cat = [];



	for (var x in ticket_cats) {

		if (ticket_cats[x][0] == ticket_cat1 && ticket_cats[x][1] == ticket_cat2 && ticket_cats[x][2] == ticket_cat3) {

			if (!ticket_cats[x][3])

				current_cat = [ticket_cats[x][6], ticket_cats[x][7]];



			if (in_array(ticket_cats[x][3], array) || !ticket_cats[x][3])

				continue;



			array[array.length] = ticket_cats[x][3];

			html += '<option value="'+ticket_cats[x][3].replace(/"/g, '&quot;')+'">'+ticket_cats[x][3]+'</option>';

		}

	}



	if (array.length) {

		html += '</select><div class="ticket-tooltip" id="ticket-tooltip_4"></div><div class="mdl-tooltip" for="ticket-tooltip_4">'+(current_cat[1] ? current_cat[1] : 'Select functional area that is relevant to your request. If you are not sure or don’t see option that fits, choose "Other".')+'</div>';

		$('#ticket_category').append('<div class="ticket-label" id="ticket-label_4">'+(current_cat[0] ? current_cat[0] : 'Area')+'</div>'+html);

		reinitialize_mdl();

		tooltips_clicks();

		$('#ticket_cat_4').change(function() {

			$('#ticket_cat_5, #ticket_fields').remove();

			$('#ticket-tooltip_5, #ticket-label_5').remove();

			ticket_cat4 = $(this).val();

			ticket_cat5 = '';

			ticket_category_4();

		});

	} else {

		make_tickets_fields();

	}

}



function ticket_category_4() {

	var html = '<select id="ticket_cat_5" name="ticket_cat_5"><option value=""></option>',

		array = [],

		current_cat = [];



	for (var x in ticket_cats) {

		if (ticket_cats[x][0] == ticket_cat1 && ticket_cats[x][1] == ticket_cat2 && ticket_cats[x][2] == ticket_cat3 && ticket_cats[x][3] == ticket_cat4) {

			if (!ticket_cats[x][4])

				current_cat = [ticket_cats[x][6], ticket_cats[x][7]];



			if (in_array(ticket_cats[x][4], array) || !ticket_cats[x][4])

				continue;



			array[array.length] = ticket_cats[x][4];

			html += '<option value="'+ticket_cats[x][4].replace(/"/g, '&quot;')+'">'+ticket_cats[x][4]+'</option>';

		}

	}



	if (array.length) {

		html += '</select><div class="ticket-tooltip" id="ticket-tooltip_5"></div><div class="mdl-tooltip" for="ticket-tooltip_5">'+current_cat[1]+'</div>';

		$('#ticket_category').append('<div class="ticket-label" id="ticket-label_5">'+current_cat[0]+'</div>'+html);

		reinitialize_mdl();

		tooltips_clicks();

		$('#ticket_cat_5').change(function() {

			$('#ticket_fields').remove();

			ticket_cat5 = $(this).val();

			make_tickets_fields();

		});

	} else {

		make_tickets_fields();

	}

}





function make_tickets_fields() {
	var html = '<div id="ticket_fields">',

		array = [],

		current_cat = [];



	for (var x in ticket_cats) {

		if (ticket_cats[x][0] == ticket_cat1 && ticket_cats[x][1] == ticket_cat2 && ticket_cats[x][2] == ticket_cat3 && ticket_cats[x][3] == ticket_cat4 && ticket_cats[x][4] == ticket_cat5) {
			for (var y in ticket_cats[x][5]) {
				if (in_array(ticket_cats[x][5][y][0], array) || !ticket_cats[x][5][y][0])

					continue;



				array[array.length] = ticket_cats[x][5][y][0];

				html += '<div class="mdl-textfield mdl-js-textfield"><textarea class="mdl-textfield__input" data-required="'+ticket_cats[x][5][y][1]+'" id="ticket-field-'+y+'" name="ticket_field['+ticket_cats[x][5][y][0]+']"></textarea><label class="mdl-textfield__label" for="ticket-field-'+y+'">'+ticket_cats[x][5][y][0]+'</label>';

				if (ticket_cats[x][5][y][1])

					html += '<span class="star">*</span>';



				html += '</div><br />';

			}

		}

	}



	if (array.length) {
		html += '</div>';

		$('#ticket_category').append(html);

	}



	reinitialize_mdl();

}



function submit_ticket() {
	var error = false;
	if ($('#ticket_email').length && !$('#ticket_email').val()) {

		error = true;

		func_highlight($('#ticket_email'));

	}



	if (!$('#ticket_subject').val()) {

		error = true;

		func_highlight($('#ticket_subject'));

	}



	if (!$('#ticket_message').val()) {

		error = true;

		func_highlight($('#ticket_message'));

	}



	if (!error) {
		document.ticketform.submit();
	}

}
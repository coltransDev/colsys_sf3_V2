/*
 * jixedbar - jQuery fixed bar.
 * http://code.google.com/p/jixedbar/
 * 
 * Version 0.0.3 (Development) - July 2, 2010
 * 
 * Copyright (c) 2009-2010 Ryan Yonzon, http://ryan.rawswift.com/
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */

(function($) {

	// jixedbar plugin
	$.fn.jixedbar = function(options) {
		var constants = {
				constOverflow: "hidden",
				constTop: "0px"
			};
		var defaults = {
				hoverOpaque: false,
				hoverOpaqueEffect: {enter: {speed: "fast", opacity: 1.0}, leave: {speed: "fast", opacity: 0.80}},
				roundedCorners: false, // only works in FF
				roundedButtons: true, // only works in FF
				menuFadeSpeed: 250,
				tooltipFadeSpeed: "slow",
				tooltipFadeOpaque: 0.8
			};
		var options = $.extend(defaults, options);
		var ie6 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 6.0") != -1);
		var button_active = false;
		var active_button_name = '';
		
		this.each(function() {
			var obj = $(this);
			var screen = jQuery(this);
			var fullScreen = screen.width(); // get screen width
			var centerScreen = (fullScreen/2)*(1); // get screen center
			var hideBar = false;

			if($(this).checkCookie('JXID')) { // check if cookie already exists
				// get cookie value
				//alert($(this).readCookie('JXHID'));
				if($(this).readCookie('JXHID') == 'true') {
					this.hideBar = true;
				}
			} else { // else drop cookie
				$(this).dropCookie('JXID', $(this).genRandID()); // set random ID and drop cookie
				$(this).dropCookie('JXHID', false); // set bar hide to false then drop cookie
			}
			
			// set html and body style for jixedbar to work
			if ($.browser.msie && ie6) {
                $("html").css({"overflow" : "hidden", "height" : "100%"});
                $("body").css({"margin": "0px", "overflow": "auto", "height": "100%"});
			} else {
				$("html").css({"height" : "100%"});
				$("body").css({"margin": "0px", "height": "100%"});
			}

			if ($.browser.msie && ie6) {
				pos = "absolute";
			} else {
				pos = "fixed";
			}
			
			// create hide container and button
			if($(".jx-bar-button-right", this).exists()) {
				$("<ul />").attr("id", "__hide_con__").insertBefore($(this).find(".jx-bar-button-right:first"));
			} else {
				$("<ul />").attr("id", "__hide_con__").appendTo(this);
			}
			$("#__hide_con__").html('<li alt="Hide toolbar"><a id="__hide_button__" class="jx-hide"></a></li>');
			$("#__hide_con__").addClass("jx-bar-button-right");
			
			$("<span />").attr("id", "__hide_sep__").insertAfter("#__hide_con__");
			$("#__hide_sep__").html('<span class="jx-separator-right"></span>');
			
			// add click event on hide button
			$("#__hide_button__").parent().click(function() {
				$("#__menu_con__").fadeOut();
				$(obj).slideToggle("slow", function() {
					$(this).dropCookie('JXHID', true); // set bar hide to true
					$("#__unhide_con__").slideToggle("slow");
				});
				return false;
			});
			
			// initialize bar
			$(this).css({
				"overflow": constants['constOverflow'],
				"position": pos,
				"top": constants['constTop']
			});
			
			// add bar style (theme)
			$(this).addClass("jx-bar");
			
			// rounded corner style (theme)
			if (defaults.roundedCorners) {
				$(this).addClass("jx-bar-rounded-tl jx-bar-rounded-tr");
			}

			// button style (theme)
			$(this).addClass("jx-bar-button");
			
			// rounded button corner style (theme)
			if (defaults.roundedButtons) {
				$(this).addClass("jx-bar-button-rounded");
			}

			// calculate and adjust bar to center
			marginLeft = centerScreen-($(this).width()/2);
			$(this).css({'margin-left': marginLeft});
			
			// fix image vertical alignment and border
			$("img", obj).css({
				"vertical-align": "bottom",
				"border": "#ffffff solid 0px" // no border
			});
			
			// check for alt attribute and set it as button text
			$(this).find("img").each(function() {
				altName = "&nbsp;" + $(this).attr('alt');
				$(this).parent().append(altName);
			});

			// check of hover effect is enabled
			if (defaults.hoverOpaque) {
				$(this).fadeTo(defaults.hoverOpaqueEffect['leave']['speed'], defaults.hoverOpaqueEffect['leave']['opacity']); 
				$(this).bind("mouseenter", function(e){
					$(this).stop().fadeTo(defaults.hoverOpaqueEffect['enter']['speed'], defaults.hoverOpaqueEffect['enter']['opacity']);
					$("#__menu_con__").stop().fadeTo(defaults.hoverOpaqueEffect['enter']['speed'], defaults.hoverOpaqueEffect['enter']['opacity']);
			    });
				$(this).bind("mouseleave", function(e){
					$(this).stop().fadeTo(defaults.hoverOpaqueEffect['leave']['speed'], defaults.hoverOpaqueEffect['leave']['opacity']);
					$("#__menu_con__").stop().fadeTo(defaults.hoverOpaqueEffect['leave']['speed'], defaults.hoverOpaqueEffect['leave']['opacity']);
			    });
			}

			// create menu container first before create tooltip container, so tooltip will be on foreground
			$("<div />").attr("id", "__menu_con__").appendTo("body");
			// add hover effect on menu
			if (defaults.hoverOpaque) {
				$("#__menu_con__").fadeTo(defaults.hoverOpaqueEffect['leave']['speed'], defaults.hoverOpaqueEffect['leave']['opacity']); 
				$("#__menu_con__").bind("mouseenter", function(e){
					$("#__menu_con__").stop().fadeTo(defaults.hoverOpaqueEffect['enter']['speed'], defaults.hoverOpaqueEffect['enter']['opacity']);
					$(obj).stop().fadeTo(defaults.hoverOpaqueEffect['enter']['speed'], defaults.hoverOpaqueEffect['enter']['opacity']);
			    });
				$("#__menu_con__").bind("mouseleave", function(e){
					$("#__menu_con__").stop().fadeTo(defaults.hoverOpaqueEffect['leave']['speed'], defaults.hoverOpaqueEffect['leave']['opacity']);
					$(obj).stop().fadeTo(defaults.hoverOpaqueEffect['leave']['speed'], defaults.hoverOpaqueEffect['leave']['opacity']);
			    });
			}			
			
			/*
			 * create unhide container and button
			 */
			$("<div />").attr("id", "__unhide_con__").appendTo("body"); // create div element and append in html body
			$("#__unhide_con__").addClass("jx-unhide");
			$("#__unhide_con__").css({
				"overflow": constants['constOverflow'],
				"position": pos,
				"top": constants['constTop'],
				"margin-left": ($(this).offset().left + $(this).width()) - $("#__unhide_con__").width()
			});

			// check if we need to hide this bar
			if(this.hideBar) {
				$(this).css({
					"display": "none"
				});				
			}
			
			// check if we need to hide the "unhide" button
			if(!this.hideBar) {
				$("#__unhide_con__").css({
					"display": "none"
				});
			}
			
			$("<ul />").attr("id", "__unhide_item__").appendTo($("#__unhide_con__"));
			$("#__unhide_item__").html('<li alt="Show toolbar"><a id="__unhide_button__" class="jx-unhide-button"></a></li>');

			// unhide container and button style
			if(defaults.roundedCorners) {
				$("#__unhide_con__").addClass("jx-bar-rounded-tl jx-bar-rounded-tr");
			}
			$("#__unhide_con__").addClass("jx-bar-button");
			if(defaults.roundedButtons) {
				$("#__unhide_con__").addClass("jx-bar-button-rounded");
			}
			
			// add click event on unhide button
			$("#__unhide_con__").click(function() {
				$(this).slideToggle("slow", function() {
					$(this).dropCookie('JXHID', false); // set bar hide to false
					$(obj).slideToggle("slow");
					if(active_button_name != '') {
						$("#__menu_con__").fadeIn();
					}
				});
				return false;
			});

			// create tooltip container
			$("<div />").attr("id", "__jx_tooltip_con__").appendTo("body"); // create div element and append in html body
			$("#__jx_tooltip_con__").css({
				"height": "auto",
				"margin-bottom": $(this).height() + 3, // put spacing between tooltip container and fixed bar
				"margin-left": "0px",
				"width": "100%", // use entire width
				"overflow": constants['constOverflow'],
				"position": pos,
				"top": constants['constTop']
			});
			
			// bar container hover in and out event handler
			$("li", obj).hover(
				function () { // in/over event
					var elemID = $(this).attr('id'); // get ID (w/ or w/o ID, get it anyway)					
					var barTooltipID = elemID + "__tooltip__"; // set a tooltip ID
					var tooltipTitle = $(this).attr('title');
					
					if (tooltipTitle == '') { // if no 'title' attribute then try 'alt' attribute
						tooltipTitle = $(this).attr('alt'); // this prevents IE from showing its own tooltip
					}
					
					if (tooltipTitle != '') { // show a tooltip if it is not empty
						// create tooltip wrapper; fix IE6's float double-margin bug
						barTooltipWrapperID = barTooltipID + '_wrapper';
						$("<div />").attr("id", barTooltipWrapperID).appendTo("#__jx_tooltip_con__");
						// create tooltip div element and put it inside the wrapper
						$("<div />").attr("id", barTooltipID).appendTo("#" + barTooltipWrapperID);
						
						// tooltip default style
						$("#" + barTooltipID).css({
							"float": "left"//,
						});
						
						// theme for tooltip (theme)
						$("<div />").html(tooltipTitle).addClass("jx-bar-button-tooltip").appendTo("#" + barTooltipID);
						$("<div />").addClass("jx-tool-arrow").appendTo("#" + barTooltipID);
						
						// fix tooltip wrapper relative to the associated button
						lft_pad = parseInt($(this).css('padding-left'));
						$("#" + barTooltipWrapperID).css({
							"margin-left": ($(this).offset().left - ($("#" + barTooltipID).width() / 2)) + ($(this).width()/2) + lft_pad  
						});
						
						if((($(this).find("a:first").attr('name') == '') || (button_active == false))) {
							$("#" + barTooltipID).fadeTo(defaults.tooltipFadeSpeed, defaults.tooltipFadeOpaque);
						} else if(active_button_name != $(this).find("a:first").attr('name')) {
							$("#" + barTooltipID).fadeTo(defaults.tooltipFadeSpeed, defaults.tooltipFadeOpaque);
						} else {
							// prevent the tooltip from showing; if button if currently on clicked mode
							$("#" + barTooltipID).css({
								"display": "none"
							});
						}
						
					}
				}, 
				function () { // out event
					var elemID = $(this).attr('id'); // get ID (whether there is an ID or none)					
					var barTooltipID = elemID + "__tooltip__"; // set a tooltip ID
					var barTooltipWrapperID = barTooltipID + '_wrapper';
					$("#" + barTooltipID).remove(); // remove tooltip element
					$("#" + barTooltipWrapperID).remove(); // remove tooltip's element DIV wrapper
				}
			);
			
			// unhide container hover in and out event handler
			$("li", $("#__unhide_con__")).hover(
				function () { // in/over event
					var elemID = $(this).attr('id'); // get ID (w/ or w/o ID, get it anyway)					
					var barTooltipID = elemID + "__tooltip__"; // set a tooltip ID
					var tooltipTitle = $(this).attr('title');
					
					if (tooltipTitle == '') { // if no 'title' attribute then try 'alt' attribute
						tooltipTitle = $(this).attr('alt'); // this prevents IE from showing its own tooltip
					}
					
					if (tooltipTitle != '') { // show a tooltip if it is not empty
						// create tooltip wrapper; fix IE6's float double-margin bug
						barTooltipWrapperID = barTooltipID + '_wrapper';
						$("<div />").attr("id", barTooltipWrapperID).appendTo("#__jx_tooltip_con__");
						// create tooltip div element and put it inside the wrapper
						$("<div />").attr("id", barTooltipID).appendTo("#" + barTooltipWrapperID);
						
						// tooltip default style
						$("#" + barTooltipID).css({
							"float": "left"//,
						});
						
						// theme for tooltip (theme)
						$("<div />").html(tooltipTitle).addClass("jx-bar-button-tooltip").appendTo("#" + barTooltipID);
						$("<div />").addClass("jx-tool-arrow").appendTo("#" + barTooltipID);
						
						// fix tooltip wrapper relative to the associated button
						ulft_pad = parseInt($(this).css('padding-left'));
						$("#" + barTooltipWrapperID).css({
							"margin-left": ($(this).offset().left - ($("#" + barTooltipID).width() / 2)) + ($(this).width()/2) + ulft_pad
						});
						
						if((($(this).find("a:first").attr('name') == '') || (button_active == false))) {
							$("#" + barTooltipID).fadeTo(defaults.tooltipFadeSpeed, defaults.tooltipFadeOpaque);
						} else if(active_button_name != $(this).find("a:first").attr('name')) {
							$("#" + barTooltipID).fadeTo(defaults.tooltipFadeSpeed, defaults.tooltipFadeOpaque);
						} else {
							// prevent the tooltip from showing; if button if currently on clicked mode
							$("#" + barTooltipID).css({
								"display": "none"
							});
						}
						
					}
				}, 
				function () { // out event
					var elemID = $(this).attr('id'); // get ID (whether there is an ID or none)					
					var barTooltipID = elemID + "__tooltip__"; // set a tooltip ID
					var barTooltipWrapperID = barTooltipID + '_wrapper';
					$("#" + barTooltipID).remove(); // remove tooltip element
					$("#" + barTooltipWrapperID).remove(); // remove tooltip's element DIV wrapper
				}
			);

			// fix PNG transparency problem in IE6
			if ($.browser.msie && ie6) {
				$(this).find('li').each(function() {
					$(this).find('img').each(function() {
						imgPath = $(this).attr("src");
						altName = $(this).attr("alt");
						srcText = $(this).parent().html();
						$(this).parent().html( // wrap with span element
							'<span style="cursor:pointer;display:inline-block;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + imgPath + '\');">' + srcText + '</span>' + altName
						);
					});
					$(this).find('img').each(function() {
						$(this).attr("style", "filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);"); // show image
					})
				});
			}
			
			// adjust bar on window resize event
			$(window).resize(
				function(){
					var screen = jQuery(this);
					var screenWidth = screen.width(); // get current screen width
					var centerScreen = (screenWidth/2)*(1); // get current screen center
					// re-calculate and adjust bar's position
					marginLeft = centerScreen-($(obj).width()/2);
					$(obj).css({'margin-left': marginLeft});
				}
			);
			
			/**
			 * Element click event
			 */
		
			// hide first level menu
			$("li", obj).find("ul").each(function() {
				$(this).css({'display': 'none'});
			});

			// create menu ID
			i = 1;
			$("li", obj).find("ul").each(function() {
				$(this).attr('id', 'nav-' + i);
				$(this).parent().find('a:first').attr('href', '#'); // replace href attribute
				$(this).parent().find('a:first').attr('name', 'nav' + i); // replace href attribute				

				$("<div />").attr("class", "jx-arrow-up").insertAfter($(this).parent().find("a"));
				
				// add click event
				$(this).parent().find('a:first').click(function() {
					var elemID = $(this).attr('id'); // get ID (whether there is an ID or none)					
					var barTooltipID = elemID + "__tooltip__"; // set a tooltip ID
					var barTooltipWrapperID = barTooltipID + '_wrapper';
					$("#" + barTooltipID).remove(); // remove tooltip element
					$("#" + barTooltipWrapperID).remove(); // remove tooltip's element DIV wrapper

					if((button_active) && (active_button_name == $(this).attr('name'))) {
						$(this).parent().find("div").attr("class", "jx-arrow-up");
						
						$("#__menu_con__").fadeOut(defaults.menuFadeSpeed); // remove menu
						$(this).parent().removeClass("jx-nav-menu-active");

						if(defaults.roundedButtons) {
							$(this).parent().removeClass("jx-nav-menu-active-rounded");
						}
						
						button_active = false;
						active_button_name = '';
						$(this).blur(); // unfocus link/href
					} else {
						$(this).parent().find("div").attr("class", "jx-arrow-down");
						
						$("#__menu_con__").css({"display": "none"});
						$("#__menu_con__").html('<ul>' + $(this).parent().find('ul').html() + '</ul>');
						$("#__menu_con__").css({
												"overflow": constants['constOverflow'],
												"position": pos,
												"top": constants['constTop'],
												"margin-top": $(obj).height() + 3,
												'margin-left': $(this).parent().offset().left
											});
						$("#__menu_con__").addClass("jx-nav-menu");
						$(this).parent().addClass("jx-nav-menu-active");
						if(defaults.roundedButtons) {
							$(this).parent().addClass("jx-nav-menu-active-rounded");
						}
						if(active_button_name != '') {
							$("a[name='" + active_button_name + "']").parent().removeClass("jx-nav-menu-active");
							$("a[name='" + active_button_name + "']").parent().removeClass("jx-nav-menu-active-rounded");
							$("a[name='" + active_button_name + "']").parent().find("div").attr("class", "jx-arrow-up");
						}
						
						button_active = true;
						active_button_name = $(this).attr('name');
						$(this).blur(); // unfocus link/href
						
						$("#__menu_con__").fadeIn(defaults.menuFadeSpeed);

					}
					return false;
				});
				
				i = i + 1;
			});
			
			// nav items click event
			$("li", obj).click(function () {
				if($('ul', this).exists()) {
					$(this).find('a:first').click();
					return false;
				} else if($(this).parent().attr('id') == "__hide_con__") {
					// do nothing
					return false;
				}
				window.location = $(this).find('a:first').attr('href');
				return false;
			});
			
		});
		
		return this;
		
	};
	
})(jQuery);

jQuery.fn.exists = function(){return jQuery(this).length>0;};

/**
 * Drop a cookie
 */
jQuery.fn.dropCookie = function(cookie_name, value) {
	var expiry_date = new Date(2037, 01, 01); // virtually, never expire!
	document.cookie = cookie_name + "=" + escape(value) + ";expires=" + expiry_date.toUTCString();
};

/**
 * Check cookie
 */
jQuery.fn.checkCookie = function(cookie_name) {
	if (document.cookie.length > 0) {
  		cookie_start = document.cookie.indexOf(cookie_name + "=");
  			if (cookie_start != -1) {
    			cookie_start = cookie_start + cookie_name.length + 1;
    			cookie_end = document.cookie.indexOf(";", cookie_start);
    			if (cookie_end == -1) cookie_end = document.cookie.length
    				return true;
			}
  	}
	return false;
}

/**
 * Extract cookie value
 */
jQuery.fn.extractCookieValue = function(value) {
	  if ((endOfCookie = document.cookie.indexOf(";", value)) == -1) {
	     endOfCookie = document.cookie.length;
	  }
	  return unescape(document.cookie.substring(value, endOfCookie));
}

/**
 * Read cookie
 */
jQuery.fn.readCookie = function(cookie_name) {
	  var numOfCookies = document.cookie.length;
	  var nameOfCookie = cookie_name + "=";
	  var cookieLen = nameOfCookie.length;
	  var x = 0;
	  while (x <= numOfCookies) {
	        var y = (x + cookieLen);
	        if (document.cookie.substring(x, y) == nameOfCookie)
	           return (this.extractCookieValue(y));
	           x = document.cookie.indexOf(" ", x) + 1;
	           if (x == 0){
	              break;
	           }
	  }
	  return (null);
}	

/**
 * Generate random ID
 */
jQuery.fn.genRandID = function() {
	var id = "";
	var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for(var i=0; i < 24; i++) {
		id += str.charAt(Math.floor(Math.random() * str.length));
	}
    return id;
}

// end jixedbar plugin
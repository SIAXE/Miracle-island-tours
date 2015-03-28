//Load Tweets
function loadTweets(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<li><div class="colored-icon icon-4"></div>'+status+'</li>');
  }
  return statusHTML.join('');
}

//Resize Layout
function resizeLayout() {
}

//DOM Loaded
jQuery(document).ready(function($) {

	//Menu Pattern
	var menuPatternSRC=$('.global-container').css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
	var fullwidthPattern=false;
	if($('.header .substrate img').length) {
		menuPatternSRC=$('.header .substrate img').attr('src');
		fullwidthPattern=true;
	}
	
	$('.header .menu > ul > li > a').each(function() {
		$(this).textPattern({
			patternID: 'pattern_'+$(this).parent().index(),
			patternSRC: menuPatternSRC,
			fullwidth: fullwidthPattern
		});
	});		
	
	//Dropdown Menu
	$('.header .menu ul').parent('li').addClass('parent-menu-item');
	$('.header .menu li.parent-menu-item').hoverIntent(
		function() {
			var menuItem=$(this);			
			menuItem.children('ul').hide().slideToggle(200);
			menuItem.addClass('hover');
		},
		function() {
			var menuItem=$(this);
			menuItem.children('ul').show().slideToggle(200, function() {
				menuItem.removeClass('hover');
			});
		}
	);
	
	//Fade Slider
	$('.fade-slider').each(function() {
		var sliderOptions={};
		if($(this).hasClass('testimonials-slider')) {
			sliderOptions.controls=true;
		}
		sliderOptions.pause=parseInt($(this).find('.slider-pause').val());
		sliderOptions.speed=parseInt($(this).find('.slider-speed').val());
		sliderOptions.effect=$(this).find('.slider-effect').val();
		$(this).fadeSlider(sliderOptions);
	});
	
	//Placeholders
	$('input, textarea').placeholder();
	$('input[type="text"],input[type="password"],textarea').each(function(index, item){
		item = $(item);
		var defaultStr = item.val();
	
		item.focus(function () {
			var me = $(this);
			if(me.val() == defaultStr){
				me.val('');
			}
		});
		item.blur(function () {
			var me = $(this);			
			if(!me.val()){
				me.val(defaultStr);
			}
		});
	});
	
	//Select Box
	$('.select-box select').fadeTo(0, 0);
	
	$('.select-box').each(function() {
		if($(this).find('option:selected').length) {
			$(this).find('span').text($(this).find('option:selected').text());
		}
	});
	
	$('.select-box select').change(function() {
		$(this).parent().find('span').text($(this).find('option:selected').text());
	});
	
	//Select Menu
	$('.select-menu option').each(function() {
		if(window.location.href==$(this).val()) {
			$('.select-menu span').text($(this).text());
			$(this).attr('selected','selected');
		}
	});
	
	$('.select-menu select').change(function() {
		window.location.href=$(this).find('option:selected').val();
	});
	
	//Range Slider
	$( '.ui-slider' ).each(function() {
		var minPrice=parseInt($(this).parent().find('input.range-min').val());
		var maxPrice=parseInt($(this).parent().find('input.range-max').val());
		var currentMinPrice=parseInt($(this).parent().find('input.current-range-min').val());
		var currentMaxPrice=parseInt($(this).parent().find('input.current-range-max').val());
		$(this).slider({
			range: true,
			min: minPrice,
			max: maxPrice,
			values: [ currentMinPrice, currentMaxPrice ],
			slide: function( event, ui ) {
				$(this).parent().find('.range-min').val(ui.values[0]).find('span').text(ui.values[0]);
				$(this).parent().find('.range-max').val(ui.values[1]).find('span').text(ui.values[1]);
			}
		});
		$(this).find('.ui-slider-handle:eq(0)').addClass('first');
		$(this).parent().find('.range-min').val(currentMinPrice).find('span').text(currentMinPrice);
		$(this).parent().find('.range-max').val(currentMaxPrice).find('span').text(currentMaxPrice);
	});
	
	//Datepicker
	if($('input.datepicker').length) {
		$('input.datepicker').datepicker({ 
			dateFormat: $('input.date-format').val(),
			dayNamesMin: [
				$('input.date-day-1').val(),
				$('input.date-day-2').val(),
				$('input.date-day-3').val(),
				$('input.date-day-4').val(),
				$('input.date-day-5').val(),
				$('input.date-day-6').val(),
				$('input.date-day-7').val()
			],
			monthNames: [
				$('input.date-month-1').val(),
				$('input.date-month-2').val(),
				$('input.date-month-3').val(),
				$('input.date-month-4').val(),
				$('input.date-month-5').val(),
				$('input.date-month-6').val(),
				$('input.date-month-7').val(),
				$('input.date-month-8').val(),
				$('input.date-month-9').val(),
				$('input.date-month-10').val(),
				$('input.date-month-11').val(),
				$('input.date-month-12').val()
			],
			firstDay: 1
		});
	}
	
	//Google Map
	$('.google-map-container').each(function() {
		var container=$(this);		
		var position = new google.maps.LatLng(container.find('input.map-latitude').val(), container.find('input.map-longitude').val());
		var myOptions = {
		  zoom: parseInt(container.find('input.map-zoom').val()),
		  center: position,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(
			document.getElementById('google-map'),
			myOptions);
	 
		var marker = new google.maps.Marker({
			position: position,
			map: map,
			title:container.find('input.map-description').val()
		});  
	 
		var infowindow = new google.maps.InfoWindow({
			content: container.find('input.map-description').val()
		});
	 
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
	});
	
	//Fancybox
	if($('.fancybox').length) {
	
		$('.fancybox').each(function() {
			var link=$(this);
			var iframeSRC='';
			link.fancybox({
				titlePosition: 'inside',
				onComplete: function() {
					var iframe=$('#fancybox-content iframe:eq(0)');
					
					if(iframe.length) {
						iframeSRC=iframe.attr('src');
					}
				},
				onClosed: function() {
					var iframe=link.parent().parent().find('iframe');
					
					if(iframe.length) {
						iframe.attr('src', iframeSRC);
					}
				}
			});		
		});
		
	}
	
	//Popup Forms
	$('.tour-button').click(function() {
		var title=$(this).data('title'),
			id=$(this).data('id'),
			popupForm=$('.popup-form'),
			paymentForm=$('.payment-form');
			
		popupForm.find('.block-title h4').text(title);
		popupForm.find('.themex-form').show();
		popupForm.find('.themex-form-message').hide();
		popupForm.find('input#question_form_tour_id, input#booking_form_tour_id').val(id);
		if(paymentForm.length) {
			paymentForm.find('#item_name').val(title+' '+paymentForm.find('#item_name_postfix').val());
		}
	});
	
	//Verification Form
	if($('.verification-form').length) {
		$.fancybox($('.verification-form').clone().wrap('<div>').parent().html());
	}
	
	//Comments Widget
	if($('.widget_recent_comments').length) {
		$('.widget_recent_comments li').prepend('<div class="colored-icon icon-5"></div>');
	}
	
	//Twitter Widget
	$('.widget-twitter').each(function() {
		var widget=$(this);
		var number=widget.find('input.twitter-number').val();
		var username=widget.find('input.twitter-username').val();
		$.getJSON('http://api.twitter.com/1/statuses/user_timeline/'+username+'.json?count='+number+'&callback=?', function(tweets) {
			widget.find('ul').html(loadTweets(tweets));
		});
	});
	
	//Subscribe Widget	
	function subscribe() {
		var email=$('#subscribe_form input#email').val();
		var data = {
			action: 'themex_subscribe',
			email: email
		};
		
		//hide message
		$('.widget-subscribe .alert').slideUp(300);
		
		//post data to server		
		$.post(ajaxurl, data, function(response) {
			$(".widget-subscribe .alert-box").remove();
			$("#subscribe_form").before(response).slideDown(300);
		});
		
		return false;
	}
	if($('.widget-subscribe').length) {
		$('#subscribe_form .subscribe-button').click( function() { subscribe(); return false; } );
		$('#subscribe_form').submit( function() { subscribe(); return false; } );
	}
	
	//Images Caption
	$('.featured-image-caption').click(function() {
		if($(this).parent().find('a.fancybox:eq(0)').length) {
			$(this).parent().find('a.fancybox:eq(0)').trigger('click');
			return false;
		}
	});
	$('.hidden-caption').each(function() {
		$(this).css('bottom',-$(this).outerHeight());
	});
	
	//Comment Form
	$('#commentform').addClass('formatted-form');
	
	//Submit Button
	$('a.submit:not(.disabled)').click(function() {
		var form=$(this).parent();
		while(!form.is('form')) {
			form=form.parent();
		}
		form.submit();
		return false;
	});
	
	//Tabs
	if($('.tabs-container').length) {	
		$('.tabs-container').each(function() {
			
			var tabs=$(this);
		
			//show first pane
			if(window.location.hash && tabs.find('.pane'+window.location.hash).length) {
				tabs.find('.pane'+window.location.hash).show();
				tabs.find('.tabs li:eq('+tabs.find('.pane'+window.location.hash).index()+')').addClass('current');
			} else {
				tabs.find('.panes .pane:eq(0)').show();
				tabs.find('.tabs li:first-child').addClass('current');
			}
			
			
			tabs.find('.tabs li').click(function() {			
				//set active state to tab
				tabs.find('.tabs li').removeClass('current');
				$(this).addClass('current');
				
				//set tab link
				window.location.hash=$(this).children('a').attr('href').substr(1);
				
				//show current tab
				tabs.find('.pane').hide();
				tabs.find('.pane:eq('+$(this).index()+')').show();

				return false;				
			});
		});	
	}
	
	//Toggles
	if($('.toggle').length) {		
		$('.toggle-title').click(function() {
			var toggle=$(this).parent();
		
			//expand or hide content
			toggle.find('.toggle-content').slideToggle(400,function() {
				if($(this).is(':visible')) {
					//set active state
					toggle.addClass('expanded');
				} else {
					//set hidden state
					toggle.removeClass('expanded');
				}
			});
		});
	}
	
	//Empty Elements
	$('p:empty').remove();
	$('h1,h2,h3,h4,h5,h6,blockquote').prev('br').remove();
	
	//Window Loaded
	$(window).bind('load resize', function() {
		resizeLayout();
	});
	
	$(window).bind('load', function() {
		$('.footer-widgets .column:nth-child(4)').addClass('last');
	});
	
	//IE8 Browser Filter
	if (jQuery.browser.msie  && parseInt(jQuery.browser.version, 10) === 8) {
		jQuery('body').addClass('ie8');
		jQuery('.comment-list li:last-child, ul.styled-list li:last-child,.header .menu ul ul li:last-child, p:last-child, .post:last-child, .widget:last-child, .items-list .full-tour:last-child,.tour-itinerary tr:last-child .tour-day-text').addClass('last-child');
	}	
});
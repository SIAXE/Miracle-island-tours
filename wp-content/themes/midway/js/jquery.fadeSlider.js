/*
 * 	Fade Slider 1.0 - jQuery plugin
 *	written by Ihor Ahnianikov	
 *  http://ahnianikov.com
 *
 *	Copyright (c) 2012 Ihor Ahnianikov
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
 
(function($) {
	$.fn.fadeSlider = function (options) {
		var options = jQuery.extend ({
			speed: 400,
			pause: 0,
			controls: false,
			effect: 'fade'
		}, options);
	 
		var slider=$(this);
		var list=$(this).children('ul');
		var disabled=false;
		var easing='linear';
		var autoSlide;
		var arrows=slider.parent().parent().find('.arrow');
		
		//build slider sliderect
		function init() {
		
			//set slides dimensions
			list.children('li').hide();
			
			//show first slide
			list.find('li:first-child').addClass('current').show();
			
			//set effect class
			slider.addClass(options.effect+'-effect');
			
			//arrows
			if(slider.parent().hasClass('main-fade-slider')) {
				arrows=slider.parent().find('.arrow');
			}
			
			if(list.children('li').length==1) {
				arrows.remove();
			}
			
			arrows.click(function() {
				//next slide
				if($(this).hasClass('arrow-left')) {
					animate('left');
				} else {
					animate('right');
				}

				//stop slider
				clearInterval(autoSlide);
				easing='swing';
				
				return false;
			});
			
			//controls
			if(options.controls) {
				slider.append('<div class="controls" />');
				for(i=0; i<list.children('li').length; i++) {
					slider.find('.controls').append('<a href="#"></a>');
				}
				
				slider.find('.controls a:first-child').addClass('current');				
				slider.find('.controls a').live('click', function() {
					if($(this).index()!=list.find('li.current').index()) {				
						animate('',list.children('li:eq('+$(this).index()+')'));
					}					
					return false;
				});
			}			
			
			if(options.effect=='motion') {
				list.children('li').each(function() {
					var slide=$(this);
					slide.append(slide.find('img').clone().addClass('slide-overlay'));
				});			
				list.find('li.current .slide-overlay').css('width','125%').animate({'width':'100%'},options.pause+options.speed, easing);
			}
			
			//rotate slider
			if(options.pause!=0 && list.children('li').length>1) {
				rotate();
			}
		}
		
		//rotate slider
		function rotate() {			
			autoSlide=setInterval(function() { animate('right') },options.pause);
		}
				
		//show next slide
		function animate(direction, nextSlide) {
		
			if(disabled) {
				return;
			} else {
				//disable animation
				disabled=true;
			}			
			
			//get current slide
			var currentSlide=list.children('li.current');
			
			//get next slide for current direction
			if(direction=='left') {
				if(list.children('li.current').prev('li').length) {
					nextSlide=list.children('li.current').prev('li');
				} else {
					nextSlide=list.children('li:last-child');
				}
			} else if(direction=='right') {
				if(list.children('li.current').next('li').length) {
					nextSlide=list.children('li.current').next('li');
				} else {
					nextSlide=list.children('li:first-child');
				}				
			}
			
			//controls
			if(options.controls) {
				slider.find('.controls a').removeClass('current');
				slider.find('.controls a:eq('+nextSlide.index()+')').addClass('current');
			}
			
			//animate slider height
			list.animate({'height':nextSlide.outerHeight()},options.speed);
			
			if(options.effect=='motion') {
				randPos(nextSlide.find('.slide-overlay'));
				list.find('li:not(.current) .slide-overlay').css('width','125%').stop();
				nextSlide.find('.slide-overlay').animate({'width':'100%'},options.pause+options.speed, easing);
			}
			
			//animate slides
			nextSlide.css({'position':'absolute','z-index':'2'}).fadeIn(options.speed, function() {
			
				//set current slide class
				currentSlide.hide().removeClass('current');
				nextSlide.addClass('current').css({'position':'relative', 'z-index':'1'});	
					
				//enable animation
				disabled=false;
			});
		
		}
		
		//random position
		function randPos(slide) {
			var randNum=Math.floor(Math.random()*4);
			
			//reset slide position
			slide.css({'left':'auto','top':'auto','right':'auto','bottom':'auto'});
			
			//set slide position
			if(randNum==0) {
				slide.css({'left':'0','top':'0'});
			} else if(randNum==1) {
				slide.css({'right':'0','bottom':'0'});
			} else if(randNum==2) {
				slide.css({'right':'0','top':'0'});
			} else if(randNum==3) {
				slide.css({'left':'0','bottom':'0'});
			}	
		}
		
		//resize slider
		function resize() {			
			list.height(list.find('li.current').outerHeight());
		}
		
		//init slider
		init();	
		
		//window resize event
		$(window).resize(function() {
			resize();
		});
	}
})(jQuery);
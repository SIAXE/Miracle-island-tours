/*
 * 	Text Pattern 1.0 - jQuery plugin
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
	$.fn.textPattern = function (options) {
		var options = jQuery.extend ({
			svgVersion: '1.1',
			xmlnsLink: 'http://www.w3.org/2000/svg',
			xmlnsxLink: 'http://www.w3.org/1999/xlink',
			patternID: 'pattern',
			fullwidth: false,
			patternSRC: ''
		}, options);
		
		var block=$(this);
		var blockText=$(this).text();
		var blockHeight=block.outerHeight();
		var blockWidth=block.outerWidth();
		var pattern;

		function patternLeft() {			
			if(options.fullwidth) {
				return -((block.parent().position().left+($(window).width()-$('.row').width())/2)+(blockWidth-block.width()));
			}			
			return 0;
		}
		
		function patternTop() {
			if(options.fullwidth) {
				return -(block.offset().top+(blockHeight-block.height())/2);
			}			
			return 0;
		}
		
		function patternWidth() {
			if(options.fullwidth) {
				return $(window).width();
			}
			return pattern.width();
		}
		
		function patternHeight() {
			if(options.fullwidth) {
				return ($(window).width()/pattern.width())*pattern.height();
			}
			return pattern.height();
		}
		
		function createPattern() {
			if($('#textPattern').length==0) {
				$('body').append('<img id="textPattern" style="position:absolute;left:-100%;top:-100%;" src="'+options.patternSRC+'" alt="" />');
			}			
		}
		
		function buildSVG() {
			block.wrapInner('<span />').wrapInner('<span style="position:relative;z-index:2;" />');
			block.children('span').append('<svg version="'+options.svgVersion+'" baseProfile="full" x="0" y="0" width="'+blockWidth+'" height="'+blockHeight+'" xmlns="'+options.xmlnsLink+'" xmlns:xlink="'+options.xmlnsxLink+'" style="position:absolute; top:0; left:0; z-index:-1"><defs><pattern id="'+options.patternID+'" x="0" y="0" patternUnits="userSpaceOnUse" width="'+patternWidth()+'" height="'+patternHeight()+'"><image xlink:href="'+options.patternSRC+'" x="'+patternLeft()+'" y="'+patternTop()+'" width="'+patternWidth()+'" height="'+patternHeight()+'"></image></pattern></defs><text x="0" y="0" font-size="'+block.css('font-size')+'" dominant-baseline="text-before-edge" fill="url(#'+options.patternID+')">'+blockText+'</text></svg>');
		}
	 
		if ( $.browser.msie ||  $.browser.opera) {
			return false;
		}
	 
		createPattern();
		pattern=$('#textPattern');
		pattern.load(function() {
			buildSVG();
		});
		
		$(window).resize(function() {
			block.find('pattern, image').attr('width',patternWidth()).attr('height',patternHeight());
			block.find('image').attr('x', patternLeft()).attr('y', patternTop());
		});
	}
})(jQuery);
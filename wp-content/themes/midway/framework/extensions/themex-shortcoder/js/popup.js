jQuery(document).ready(function($) {
    var themexPopup = {
	
    	loadVals: function()
    	{
    		var shortcode = $('#themex_shortcode').text(),
    			uShortcode = shortcode;
    		
    		//get shortcode options
    		$('.themex-input, #themex_page, #themex_category, #themex_destination, #themex_type').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('themex_', ''),
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		//add shortcode
    		$('#themex_ushortcode').remove();
    		$('#themex-shortcode-form-table').prepend('<div id="themex_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
		
    	cLoadVals: function()
    	{
    		var shortcode = $('#themex_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		//get child shortcode options
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.themex-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('themex_', ''),
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		//add shortcode
    		$('#themex_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="themex_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		//insert into parent shortcode
    		this.loadVals();
    		pShortcode = $('#themex_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		//add parent shortcode
    		$('#themex_ushortcode').remove();
    		$('#themex-shortcode-form-table').prepend('<div id="themex_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
		
    	children: function()
    	{
    		
			//assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		//remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			
    			return false;
    		});
    		
    		//assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'				
			});
    	},
		
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				tzPopup = $('#themex-popup')
			
			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				height: (tbWindow.outerHeight()-47),
				overflowY: 'scroll',
				overflowX: 'hidden',
				width: 563
			});
			
			tbWindow.css({
				width: ajaxCont.outerWidth(),
				marginLeft: -(ajaxCont.outerWidth()/2)
			});
    	},
		
    	load: function()
    	{
    		var	themexPopup = this,
    			popup = $('#themex-popup'),
    			form = $('#themex-shortcode-form', popup),
    			shortcode = $('#themex_shortcode', form).text(),
    			popupType = $('#themex_popup', form).text(),
    			uShortcode = '';
    		
    		//resize TB
    		themexPopup.resizeTB();
    		$(window).resize(function() { themexPopup.resizeTB() });
    		
    		//initialise TB
    		themexPopup.loadVals();
    		themexPopup.children();
    		themexPopup.cLoadVals();
    		
    		//update on children change
    		$('.themex-cinput', form).live('change', function() {
    			themexPopup.cLoadVals();
    		});
    		
    		//update on parent change
    		$('.themex-input', form).change(function() {
    			themexPopup.loadVals();
    		});
    		
    		//update on insert click
    		$('.themex-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#themex_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    //load popup
    $('#themex-popup').livequery( function() { 
		themexPopup.load(); 
	});
});
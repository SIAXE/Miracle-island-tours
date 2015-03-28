jQuery(document).ready(function($) {
    var ThemexPopup = {
	
    	loadVals: function()
    	{
    		var shortcode = $('#Themex_shortcode').text(),
    			uShortcode = shortcode;
    		
    		//get shortcode options
    		$('.Themex-input, #Themex_page, #Themex_category, #Themex_destination, #Themex_type').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('Themex_', ''),
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		//add shortcode
    		$('#Themex_ushortcode').remove();
    		$('#Themex-shortcode-form-table').prepend('<div id="Themex_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
		
    	cLoadVals: function()
    	{
    		var shortcode = $('#Themex_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		//get child shortcode options
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.Themex-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('Themex_', ''),
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		//add shortcode
    		$('#Themex_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="Themex_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		//insert into parent shortcode
    		this.loadVals();
    		pShortcode = $('#Themex_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		//add parent shortcode
    		$('#Themex_ushortcode').remove();
    		$('#Themex-shortcode-form-table').prepend('<div id="Themex_ushortcode" class="hidden">' + pShortcode + '</div>');
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
				tzPopup = $('#Themex-popup')
			
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
    		var	ThemexPopup = this,
    			popup = $('#Themex-popup'),
    			form = $('#Themex-shortcode-form', popup),
    			shortcode = $('#Themex_shortcode', form).text(),
    			popupType = $('#Themex_popup', form).text(),
    			uShortcode = '';
    		
    		//resize TB
    		ThemexPopup.resizeTB();
    		$(window).resize(function() { ThemexPopup.resizeTB() });
    		
    		//initialise TB
    		ThemexPopup.loadVals();
    		ThemexPopup.children();
    		ThemexPopup.cLoadVals();
    		
    		//update on children change
    		$('.Themex-cinput', form).live('change', function() {
    			ThemexPopup.cLoadVals();
    		});
    		
    		//update on parent change
    		$('.Themex-input', form).change(function() {
    			ThemexPopup.loadVals();
    		});
    		
    		//update on insert click
    		$('.Themex-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#Themex_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    //load popup
    $('#Themex-popup').livequery( function() { 
		ThemexPopup.load(); 
	});
});
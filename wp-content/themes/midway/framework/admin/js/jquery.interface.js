jQuery(document).ready(function($) {	
	
	
	/* --------------------------------Themex Object----------------------------------- */	
	
	//Enable save buttons on options change
	var saveButton=$('.Themex_panel .save_options');
	
	$('.Themex_panel input,.Themex_panel textarea').each(function() {
	   $(this).data('oldVal', $(this).val());
	   $(this).bind("propertychange keyup input paste", function(event){
		  //if value has changed
		  if ($(this).data('oldVal') != $(this).val()) {
		   $(this).data('oldVal', $(this).val());
		   saveButton.removeClass('disabled');
		 }
	   });
	 });
	 
	 $('.Themex_panel select,.Themex_panel input').live('change', function() {
		saveButton.removeClass('disabled');
	 });
		
	//Save and reset options
	$('.Themex_panel .save_options:not(.disabled), .Themex_panel .reset_options').live('click', function() {	
		//get options values
		var values = $('#Themex_options').serialize();
		var button=$(this);
		var type='save';
		if(button.is('.reset_options')) {
			type='reset';
			$('.Themex_panel .reset_options').addClass('disabled');
		}
		
		var data = {
			type: type,
			action: 'Themex_action',
			data: values
		};
		
		//disable button
		saveButton.addClass('disabled');
			
		//send data to server
		$.post(ajaxurl, data, function(response) {
			$('.Themex_panel .reset_options').removeClass('disabled');
			$('.Themex_popup').text(response);
			$('.Themex_popup').fadeTo(400,0.8);
			window.setTimeout(function() {
				$('.Themex_popup').fadeOut(400);
			}, 2000);
		});		
	});
	
	/* --------------------------------Themex Interface----------------------------------- */
	
	//Tabs
	$('.Themex_menu li:first-child').addClass('active');
	$('.Themex_menu li').click(function() {
		$('.Themex_pages .Themex_page').hide();
		$('.Themex_pages #'+$(this).attr('id')+'_page').show();
		$('.Themex_menu li').removeClass('active');
		$(this).addClass('active');
	});
	
	//Options relations
	$('select').change(function() {
		$('.'+$(this).attr('id')).slideToggle(300, function() {
			$('.'+$(this).attr('id')+'.Themex_child_'+$(this).find('option:selected').index()).slideToggle(300);
		});
	});
	
	$.each($('select'), function (i, val) {
		var item=$(this);
		$('.'+$(this).attr('id')+'.Themex_child_'+item.find('option:selected').index()).show();
	});
	
	//Colorpicker
	$.each($('.Themex_color'), function(i, val) {
		var item=$(this);
		item.children('div').css('background-color',item.next('input').val());
		item.ColorPicker({
			color: item.next('input').val(),
			onShow: function (picker) {
				$(picker).fadeIn(200);
				return false;
			},
			onHide: function (picker) {
				$(picker).fadeOut(200);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				item.children('div').css('background-color','#' + hex);
				item.next('input').val('#' + hex);	
				saveButton.removeClass('disabled');
			}
		});
    });
	
	//Slider
	$.each($('.Themex_slider'), function(i, val) {
		var item=$(this);
		var unit=item.parent().find('div.unit').text();
		var currentValue=item.parent().find('input').val();		
		
		//set default value
		if(currentValue=='') {
			currentValue=parseInt(item.parent().find('div.min_value').text());
		}
		
		//set current value
		item.parent().find('div.slider_value').text(currentValue+' '+unit);
		
		//event handlers
		item.slider({
			value: currentValue,
			min: parseInt(item.parent().find('div.min_value').text()),
			max: parseInt(item.parent().find('div.max_value').text()),
			slide: function( event, ui ) {
				item.parent().find('div.slider_value').text( ui.value+' '+unit );
				item.parent().find('input').val(ui.value);
				
				//enable save button
				saveButton.removeClass('disabled');
			}
		});
	});
	
	//Datepicker
	$.each($('input.datepicker'), function() {
		$(this).datepicker({ dateFormat: 'dd/mm/yy' });
	});	
	
	//Option description
	$('.Themex_tip').live(
	{
        mouseenter:
           function() {
				$(this).parent().append('<div class="Themex_tip_cloud hidden"><div>'+$(this).text()+'</div></div>');
				$(this).parent().find('div.Themex_tip_cloud').fadeTo(200,0.8);
			},
        mouseleave:
           function() {
				$(this).parent().find('div.Themex_tip_cloud').fadeOut(200, function() {
					$(this).parent().find('div.Themex_tip_cloud').remove();
				});
			}
    });
	
	//Select image option
	$('.Themex_option.select_image img').click( function() {
		var item=$(this);
		
		//set active class
		item.parent().find('img').removeClass('active');
		item.addClass('active');
		saveButton.removeClass('disabled');
		
		//set option value
		item.parent().find('input').val(item.attr('alt'));
	});
	
	$.each($('.Themex_option.select_image img'), function (i, val) {
		var item=$(this);
		if(item.parent().find('input').val()==item.attr('alt')) {
			item.addClass('active');
		}
	});
	
	//Uploader
	var header_clicked = false,
		fileInput = '';

	jQuery('.Themex_panel .upload_button,.repeatable-upload,.Themex_meta_table .upload_button').live('click', function(e) {		
		fileInput = jQuery(this).prev('input');		
		tb_show('', 'media-upload.php?post=-629834&amp;Themex_uploader=1&amp;TB_iframe=true');
		header_clicked = true;
		e.preventDefault();
	});

	//store original function
	window.original_send_to_editor = window.send_to_editor;
	window.original_tb_remove = window.tb_remove;

	//override removing function (resets our boolean)
	window.tb_remove = function() {
		header_clicked = false;
		window.original_tb_remove();
	}

	
	//send data to editor
	window.send_to_editor = function(html) {
		if (header_clicked) {
			imgurl = jQuery(html).attr('href');
			fileInput.val(imgurl);
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
		saveButton.removeClass('disabled');
	};
	
	//Repeatable fields
	jQuery('.repeatable-add').click(function() {
		var fieldLocation = jQuery('tr.'+$(this).parent().parent().parent().next('tr').attr('class').split(' ')[1]+':last');
		var field=fieldLocation.clone(true);
		field.find('input, select').each(function() {
			var input=$(this);
			input.val('').attr('name', input.attr('name').replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				})
			);
		});
		field.insertAfter(fieldLocation, field);
		return false;
	});

	jQuery('.repeatable-remove').click(function(){
		if(jQuery('.repeatable-field').length>1) {
			jQuery(this).parent().parent().remove();
		}
		return false;
	});
	
	//Metabox
	if($('select#page_template').length && $('tr.child-option').length) {	
		$('tr.child-option').hide();
		$('tr.child-option.'+$('select#page_template').find('option:selected').val().split('.')[0]+'-child').show();
		$('select#page_template').change(function () {
			var template=$(this).find('option:selected').val().split('.')[0];
			$('tr.child-option').hide();
			$('tr.child-option.'+template+'-child').show();
		});
	}	
	
	/* --------------------------------Themex Widgetiser----------------------------------- */
	
	$('.add_sidebar,.remove_sidebar,.add_category,.remove_category,.add_page,.remove_page').live( 'click', function() {
		var values = $('#Themex_options').serialize();
		var button=$(this);
		var type='';
		
		//add sidebar
		if(button.is('.add_sidebar')) {
			if($('#Themex_widgetiser_area_name').val()=='') {
				$('#Themex_widgetiser_area_name').trigger('focus');
			} else {
				var data = {
					type: 'add_area',
					module: 'ThemexWidgetiser',
					area_name: $('#Themex_widgetiser_area_name').val(),
					action: 'Themex_action',
				};
				//send data to server
				$.post(ajaxurl, data, function(response) {
					button.parent('div').find('.Themex_button.add_sidebar').parent().after(response);
					button.parent().next('.Themex_section').slideToggle(300);
				});
			}
			
		//remove sidebar
		} else if(button.is('.remove_sidebar')) {
			var data = {
				type: 'remove_area',
				module: 'ThemexWidgetiser',
				action: 'Themex_action',
				area_id: button.parent('div').parent('div').attr('id')
			};
			//send data to server
			$.post(ajaxurl, data, function(response) {
				button.parent('div').parent('div').slideToggle(300, function() {
					button.parent('div').parent('div').remove();
				});
			});
			
		//add page or category
		} else if(button.is('.add_page') || button.is('.add_category')) {
			var child_type='';
			if(button.is('.add_page')) {					
				child_type='pages';
			} else {
				child_type='categories';
			}
			var data = {
				type: 'add_area_child',
				module: 'ThemexWidgetiser',
				action: 'Themex_action',
				child_type: child_type,
				area_id: button.parent('div').parent('div').attr('id')
			};
			//send data to server
			$.post(ajaxurl, data, function(response) {
				button.after(response);
				button.next('div.Themex_option').slideToggle(300);
			});
		
		//remove page or category
		} else if(button.is('.remove_page') || button.is('.remove_category')) {
			var child_type='';
			if(button.is('.remove_page')) {					
				child_type='pages';
			} else {
				child_type='categories';
			}
			var data = {
				type: 'remove_area_child',
				module: 'ThemexWidgetiser',
				action: 'Themex_action',
				child_type: child_type,
				child_id: button.parent('div').find('select').attr('id'),
				area_id: button.parent('div').parent('div').parent('div').attr('id')
			};
			//send data to server
			$.post(ajaxurl, data, function(response) {
				button.parent('div.Themex_option').slideToggle(300);
			});
		}			
	});
	
	/* ----------------------------------Themex Form------------------------------------- */
	
	//hide remove button if only one field created
	if($('.Themex_form .remove_field').length==1) {
		$('.Themex_form .remove_field').hide();
	}
	
	$('.Themex_form .add_field, .Themex_form .remove_field').live( 'click', function() {
		var values = $('#Themex_options').serialize();
		var button=$(this);
		var type='';
		
		//add sidebar
		if(button.is('.add_field')) {
			var data = {
				type: 'add_field',
				slug: button.data('slug'),
				module: 'ThemexForm',
				action: 'Themex_action'
			};
			//send data to server
			$.post(ajaxurl, data, function(response) {
				button.parent('div').after(response);
				button.parent('div').next('.Themex_section').slideToggle(300, function() {
					if($('.Themex_form .Themex_section').length>1) {
						$('.Themex_form .remove_field').show();
					}
				});
			});
			
		//remove sidebar
		} else if(button.is('.remove_field')) {
			var data = {
				type: 'remove_field',
				slug: button.data('slug'),
				module: 'ThemexForm',
				action: 'Themex_action',
				field_id: button.data('id')
			};
			//send data to server
			$.post(ajaxurl, data, function(response) {
				button.parent('div').slideToggle(300, function() {
					button.parent('div').remove();
					if($('.Themex_form .Themex_section').length==1) {
						$('.Themex_form .remove_field').hide();
					}
				});				
			});
			
		}
	});
	
	//options visibility
	$('.Themex_form select').live('change', function() {
		var item=$(this);
		var hiddenOption=item.parent('div').parent('div').find('div.hidden');
		if(item.find('option:selected').val()=='select') {	
			hiddenOption.slideToggle(300);
		} else if(hiddenOption.is(':visible')) {
			hiddenOption.slideToggle(300);
		}
	});
	
	$.each($('.Themex_form select'), function (i, val) {
		var item=$(this);
		var hiddenOption=item.parent('div').parent('div').find('div.hidden');
		if(item.find('option:selected').val()=='select') {
			hiddenOption.show();
		}
	});	
	
});
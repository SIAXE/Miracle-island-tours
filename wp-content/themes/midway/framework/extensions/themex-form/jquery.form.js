jQuery(document).ready(function($){
	$('.Themex-form').submit(function(){

		var form=$(this),
			message=form.parent().find('.Themex-form-message'),
			submitButton=form.find('.button'),
			loader=form.find('.formatted-form-loader'),
			paymentForm=$('.payment-form');
		
		loader.show();
		
		message.slideUp(750,function() {
			message.hide();
			
			var serializedValues=form.serialize(),
				slug=submitButton.data('slug');
				
			serializedValues+='&slug='+slug;			
			if(form.find('input#'+slug+'_tour_id').length) {
				serializedValues+='&'+slug+'_tour_id='+form.find('input#'+slug+'_tour_id').val();
			}
			
			var data = {
				action: 'Themex_form',
				data: serializedValues
			};
			
			$.post(ajaxurl, data, function(response) {		
				submitButton.removeAttr('disabled');
				var paymentProcessing=false;			
				if(paymentForm.length && response.match('success') != null && slug=='booking_form') {
					paymentProcessing=true;
				}				
				if(!paymentProcessing) {
					loader.hide();
					message.html(response);
					message.slideDown('slow');
					if(response.match('success') != null) {
						form.slideUp('slow');						
					}
				} else {
					paymentForm.submit();
				}				
			});		
		});
		
		return false; 
	
	});
});
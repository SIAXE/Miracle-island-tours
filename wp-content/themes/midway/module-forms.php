<div class="hidden">
	<div class="booking-form popup-form" id="booking-form">
		<div class="block-title"><h4></h4></div>
		<?php ThemexForm::renderData('booking_form','<input type="hidden" id="booking_form_tour_id" value="" />'); ?>
	</div><!-- booking form -->
	<div class="question-form popup-form" id="question-form">
		<div class="block-title"><h4></h4></div>
		<?php ThemexForm::renderData('question_form','<input type="hidden" id="question_form_tour_id" value="" />'); ?>
	</div><!-- question form -->
	<?php if(isset($_SESSION['payment_id'])) { ?>
	<?php if(Themex_verify_payment()) { ?>
	<div class="verification-form popup-form" id="verification-form">
		<div class="block-title"><h4><?php echo $_POST['transaction_subject']; ?></h4></div>
		<p><?php echo ThemexForm::$data['booking_form']['message']; ?></p>
	</div><!-- question form -->
	<?php } ?>
	<form action="https://www.paypal.com/cgi-bin/webscr" name="payment_form" id="payment_form" class="payment-form" method="post">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="business" value="<?php echo ThemexCore::getOption('booking_email'); ?>" />
		<input type="hidden" name="item_name" id="item_name" value="" />
		<input type="hidden" value="<?php _e('Tour Booking', 'Travel2'); ?>" id="item_name_postfix"/>
		<input type="hidden" name="item_number" id="item_number" value="1" />
		<input type="hidden" name="amount" value="<?php echo ThemexCore::getOption('booking_price'); ?>" />
		<input type="hidden" name="page_style" value="Primary" />
		<input type="hidden" name="no_shipping" value="1" />
		<input type="hidden" name="return" value="<?php the_permalink($post->ID); ?>?payment_id=<?php echo $_SESSION['payment_id']; ?>">
		<input type="hidden" name="cancel_return" value="<?php the_permalink($post->ID); ?>" />
		<input type="hidden" name="no_note" value="1" />
		<input type="hidden" name="currency_code" value="<?php echo ThemexCore::getOption('booking_currency'); ?>" />
		<input type="hidden" name="lc" value="<?php echo ThemexCore::getOption('booking_language','EN'); ?>" />
		<input type="hidden" name="bn" value="PP-BuyNowBF" />
		<input type="hidden" name="notify_url" value="<?php the_permalink($post->ID); ?>" />
	</form>	
	<?php } ?>
</div>
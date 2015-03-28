<?php
//query tours
$query=new WP_Query(array(
	'post_type' =>'tour',
	'showposts' => -1,
	'meta_key'    => '_thumbnail_id',
));

$type=intval(ThemexCore::getArrayValue($_GET,'type',''));
$destination=intval(ThemexCore::getArrayValue($_GET,'destination',''));
$date_format=ThemexCore::getOption('date_format','m/d/Y');
$date_dep=ThemexCore::getArrayValue($_GET,'date_dep',__('Departure Date','travel2'));
$date_arr=ThemexCore::getArrayValue($_GET,'date_arr',__('Arrival Date','travel2'));
$prices=themex_boundary_prices();
$price=themex_price(null,'<span>','</span>');
$price_min=intval(ThemexCore::getArrayValue($_GET,'price_min',$prices[0]));
$price_max=intval(ThemexCore::getArrayValue($_GET,'price_max',$prices[1]));

if($query->have_posts()) {
?>
<div class="tour-search-form">
	<?php if(get_option('themex_search_form_title')) { ?>
	<div class="form-title">
		<h4><?php echo get_option('themex_search_form_title'); ?></h4>
	</div>
	<?php } ?>
	<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
		<?php if(get_option('themex_search_form_destination')!='true') { ?>
		<div class="select-box">
			<span><?php _e('All Destinations','travel2'); ?></span>
			<?php 
			wp_dropdown_categories( array(
				'taxonomy' => 'tour_destination', 
				'name' => 'destination', 
				'id' => 'destination', 
				'hierarchical' => 1,
				'show_option_all' => __('All Destinations','travel2'), 
				'selected'=>$destination,
			)); 
			?>
		</div>
		<?php } ?>
		<?php if(get_option('themex_search_form_type')!='true') { ?>
		<div class="select-box">
			<span><?php _e('All Types','travel2'); ?></span>
			<?php
			wp_dropdown_categories( array(
				'taxonomy' => 'tour_type', 
				'name' => 'type', 
				'id' => 'type', 
				'hierarchical' => 1,
				'show_option_all' => __('All Types','travel2'), 
				'selected'=>$type,
			)); 
			?>
		</div>
		<?php } ?>
		<?php 
		if(get_option('themex_search_form_date')!='true') {
			wp_enqueue_script('jquery-ui-datepicker');
		?>
		<div class="field-container">
			<input type="text" name="date_dep" class="datepicker" value="<?php echo $date_dep; ?>" />
		</div>
		<div class="field-container">
			<input type="text" name="date_arr" class="datepicker reverse" value="<?php echo $date_arr; ?>" />
		</div>
		<?php } ?>
		<?php
		if(get_option('themex_search_form_price')!='true') {
			wp_enqueue_script('jquery-ui-slider');		
			wp_enqueue_script('jquery-ui-touchpunch', THEME_URI.'js/jquery.ui.touchPunch.js');
		?>
		<div class="range-slider">
			<div class="range-min"><?php echo $price; ?></div>
			<div class="range-max"><?php echo $price; ?></div>
			<div class="clear"></div>
			<div class="ui-slider"></div>							
			<input type="hidden" name="price_min" value="<?php echo $prices[0]; ?>" class="range-min" />
			<input type="hidden" name="price_max" value="<?php echo $prices[1]; ?>" class="range-max" />
			<input type="hidden" value="<?php echo $price_min; ?>" class="current-range-min" />
			<input type="hidden" value="<?php echo $price_max; ?>" class="current-range-max" />
		</div>
		<?php } ?>
		<div class="form-button">
			<div class="button-container">
				<a href="#" class="button submit"><span><?php _e('Search Tours','travel2'); ?></span></a>
			</div>
		</div>					
		<input type="hidden" name="s" value="" class="range-min" />
		<input type="hidden" value="<?php echo $date_format=='m/d/Y'?'mm/dd/yy':'dd/mm/yy'; ?>" class="date-format" />
		<input type="hidden" class="date-day-1" value="<?php _e('Su', 'travel2'); ?>" />
		<input type="hidden" class="date-day-2" value="<?php _e('Mo', 'travel2'); ?>" />
		<input type="hidden" class="date-day-3" value="<?php _e('Tu', 'travel2'); ?>" />
		<input type="hidden" class="date-day-4" value="<?php _e('We', 'travel2'); ?>" />
		<input type="hidden" class="date-day-5" value="<?php _e('Th', 'travel2'); ?>" />
		<input type="hidden" class="date-day-6" value="<?php _e('Fr', 'travel2'); ?>" />
		<input type="hidden" class="date-day-7" value="<?php _e('Sa', 'travel2'); ?>" />
		<input type="hidden" class="date-month-1" value="<?php _e('January', 'travel2'); ?>" />
		<input type="hidden" class="date-month-2" value="<?php _e('February', 'travel2'); ?>" />
		<input type="hidden" class="date-month-3" value="<?php _e('March', 'travel2'); ?>" />
		<input type="hidden" class="date-month-4" value="<?php _e('April', 'travel2'); ?>" />
		<input type="hidden" class="date-month-5" value="<?php _e('May', 'travel2'); ?>" />
		<input type="hidden" class="date-month-6" value="<?php _e('June', 'travel2'); ?>" />
		<input type="hidden" class="date-month-7" value="<?php _e('July', 'travel2'); ?>" />
		<input type="hidden" class="date-month-8" value="<?php _e('August', 'travel2'); ?>" />
		<input type="hidden" class="date-month-9" value="<?php _e('September', 'travel2'); ?>" />
		<input type="hidden" class="date-month-10" value="<?php _e('October', 'travel2'); ?>" />
		<input type="hidden" class="date-month-11" value="<?php _e('November', 'travel2'); ?>" />
		<input type="hidden" class="date-month-12" value="<?php _e('December', 'travel2'); ?>" />
	</form>
</div><!-- tour search form -->
<?php } ?>
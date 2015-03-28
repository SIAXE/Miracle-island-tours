<?php
$destinations=themex_category($post->ID, 'destination');
$price=themex_price($post->ID);
$duration=themex_duration($post->ID);	
$departure_date=themex_date(get_post_meta($post->ID, '_tour_departure_date', true), $GLOBALS['date_format']);
$arrival_date=themex_date(get_post_meta($post->ID, '_tour_arrival_date', true), $GLOBALS['date_format']);
$days=themex_days(get_post_meta($post->ID, '_tour_days', true));	
parse_str(get_post_meta($post->ID,'_tour_images',true), $gallery);
?>
<div class="full-tour">	
	<div class="<?php if(is_single()) { ?>sixcol<?php } else { ?>fivecol<?php } ?> column">		
		<div class="fade-slider-container tour-slider-container">
			<?php if(is_single()) { ?>
			<div class="fade-slider tour-slider">
				<ul>
					<?php foreach($gallery as $image) { ?>
					<li><img src="<?php echo $image; ?>" alt="" /></li>
					<?php } ?>
				</ul>
				<div class="arrow arrow-left fade-slider-arrow"></div>
				<div class="arrow arrow-right fade-slider-arrow"></div>
				<input type="hidden" class="slider-speed" value="400" />
				<input type="hidden" class="slider-pause" value="0" />
			</div>
			<div class="block-background layer-1"></div>
			<div class="block-background layer-2"></div>
			<?php } else { ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('extended'); ?></a>
			</div>
			<div class="block-background layer-2"></div>
			<?php } ?>
		</div>		
	</div>
	<div class="<?php if(is_single()) { ?>sixcol<?php } else { ?>sevencol<?php } ?> column last">
		<div class="block-title">
			<?php if(is_single()) { ?>
			<h1><?php the_title(); ?></h1>	
			<?php } else { ?>
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php } ?>						
		</div>
		<?php if($duration!='' || $price!='' || $destinations!='' || $departure_date!='') { ?>
		<ul class="tour-meta">
			<?php if($destinations!='') { ?><li><div class="colored-icon icon-2"></div><strong><?php _e('Destination','miracleisland'); ?>:</strong> <?php echo $destinations; ?></li><?php } ?>
			<?php if($duration!='') { ?><li><div class="colored-icon icon-1"><span></span></div><strong><?php _e('Duration','miracleisland'); ?>:</strong> <?php echo $duration; ?></li><?php } ?>
			<?php if($departure_date!='' && $days=='') { ?><li><div class="colored-icon icon-6"><span></span></div><strong><?php _e('Departs','miracleisland'); ?>:</strong> <?php echo $departure_date; ?></li><?php } ?>
			<?php if($arrival_date!='' && $days=='') { ?><li><div class="colored-icon icon-7"><span></span></div><strong><?php _e('Arrives','miracleisland'); ?>:</strong> <?php echo $arrival_date; ?></li><?php } ?>
			<?php if($days!='') { ?><li><div class="colored-icon icon-6"><span></span></div><strong><?php _e('Runs On','miracleisland'); ?>:</strong> <?php echo $days; ?></li><?php } ?>
			<?php if($price!='') { ?><li><div class="colored-icon icon-3"><span></span></div><strong><?php _e('Price','miracleisland'); ?>:</strong> <?php echo $price; ?></li><?php } ?>
		</ul>
		<?php } ?>
		<?php if(is_single()) { ?>
			<?php the_excerpt(); ?>
		<?php } else { ?>
			<p><?php echo themex_excerpt(get_the_excerpt()); ?></p>
		<?php } ?>		
		<?php if($GLOBALS['booking']!='true') { ?>
			<?php if($post->_tour_booking) { ?>
			<a target="_blank" href="<?php echo $post->_tour_booking; ?>" class="button small tour-button"><span><?php _e('Book Now','miracleisland'); ?></span></a>
			<?php } else { ?>
			<a href="#booking-form" data-id="<?php echo $post->ID; ?>" data-title="<?php the_title(); ?>" class="button small fancybox tour-button"><span><?php _e('Book Now','miracleisland'); ?></span></a>
			<?php } ?>
		<?php } ?>
		<?php if($GLOBALS['questions']!='true') { ?><a href="#question-form" data-id="<?php echo $post->ID; ?>" data-title="<?php the_title(); ?>" class="button grey small fancybox tour-button"><span><?php _e('Ask a Question','miracleisland'); ?></span></a><?php } ?>
	</div>		
	<div class="clear"></div>
</div>
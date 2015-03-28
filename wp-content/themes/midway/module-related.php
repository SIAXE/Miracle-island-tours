<div class="related-tours">
	<div class="block-title"><h1><?php _e('Related Tours','travel2'); ?></h1></div>
	<?php
	$order=ThemexCore::getOption('tours_related_order','rand');
	$taxonomies=array($order);
	if($order!='rand') {
		$taxonomies=wp_get_post_terms($post->ID,'tour_'.$order);
		shuffle($taxonomies);
	}

	$used_posts[]=$post->ID;	
	$post_count=0;
	
	foreach ($taxonomies as $taxonomy) {
		if($post_count<4) {
			$args=array(
			  'tour_'.$order => $order=='rand'?null:$taxonomy->slug,
			  'post__not_in' => $used_posts,
			  'post_type' => 'tour',
			  'orderby' => 'rand',
			  'meta_key'    => '_thumbnail_id',
			  'showposts'=>4,
			);
			$query = new WP_Query($args);


			while ($query->have_posts() && $post_count<4) {
				$query->the_post(); 
				$destinations=themex_category($post->ID, 'destination');	
				$types=themex_category($post->ID, 'type');
				$duration=themex_duration($post->ID);
				?>
				<div class="column threecol <?php if($post_count==3) echo 'last'; ?>">
					<div class="tour-thumb-container">
						<div class="tour-thumb">						
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('normal'); ?></a>
							<div class="tour-caption">
								<h5 class="tour-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<?php if($destinations!='' || $duration!='') { ?>
								<div class="tour-meta">
									<?php if($destinations!='') { ?>
									<div class="tour-destination"><div class="colored-icon icon-2"></div><?php echo $destinations; ?></div>
									<?php } ?>
									<?php if($duration!='') { ?>
									<div class="tour-duration"><?php echo $duration; ?></div>
									<?php } ?>
								</div>
								<?php } ?>
							</div>								
						</div>		
						<div class="block-background"></div>
					</div>
				</div>
				<?php
				$used_posts[]=$post->ID;
				$post_count++;
			}
			wp_reset_query();
		}
	}
	?>
	<div class="clear"></div>	
</div>
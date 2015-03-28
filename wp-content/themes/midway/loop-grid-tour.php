<?php
$destinations=themex_category($post->ID, 'destination');
$duration=themex_duration($post->ID);
?>
<div class="column <?php echo $GLOBALS['row_class']; ?>col <?php echo $GLOBALS['counter']==$GLOBALS['row_limit'] ? 'last' : ''; ?>">
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
<div <?php post_class('post'); ?>>
	<?php if(has_post_thumbnail()) { ?>
	<div class="column fivecol post-featured-image">
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('normal'); ?></a>
		</div>
	</div>
	<div class="column sevencol last">
	<?php } else { ?>
	<div class="fullwidth-block">
	<?php } ?>
		<div class="post-content">
			<div class="block-title"><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></div>
			<?php the_excerpt(); ?>
			<div class="post-meta">
				<a href="<?php the_permalink(); ?>" class="button small"><span><?php _e('Read More','miracleisland'); ?></span></a>
				<?php if(comments_open()) { ?>
				<div class="post-comment-count"><?php comments_number('0','1','%'); ?></div>
				<?php } ?>
				<div class="post-info"><?php the_time($GLOBALS['date_format']); ?></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
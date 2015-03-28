<?php
get_header();

$layout=ThemexCore::getOption('blog_layout','right');

if($layout=='left') {
?>
<div class="column fourcol">
<?php get_sidebar(); ?>
</div>
<div class="column eightcol last">
<?php } else if($layout=='right') { ?>
<div class="column eightcol">
<?php } else { ?>
<div class="fullwidth-block">
<?php } ?>
	<?php 
	if (have_posts()) {
		while ( have_posts() ) {
			the_post();	
			?>
			<div class="post full-post">
				<?php if(has_post_thumbnail()) { ?>
				<div class="post-featured-image">
					<div class="featured-image">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('extended'); ?></a>
					</div>
				</div>
				<?php } ?>
				<div class="post-content">
					<div class="block-title"><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></div>
					<?php the_content(); ?>
					<div class="post-meta">
						<?php if(comments_open()) { ?>
						<div class="post-comment-count"><?php comments_number('0','1','%'); ?></div>
						<?php } ?>
						<div class="post-info"><?php the_time(ThemexCore::getOption('date_format','m/d/Y')); ?> <?php _e('in','Travel2'); ?> <?php the_category(', '); ?></div>
						<div class="post-tags"><?php the_tags('','',''); ?></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php
			comments_template();
		}
	}
	?>
</div>
<?php if($layout=='right') { ?>
<div class="column fourcol last">
<?php get_sidebar(); ?>
</div>
<?php } ?>
<?php get_footer(); ?>
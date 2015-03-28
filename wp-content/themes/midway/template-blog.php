<?php
/*
Template Name: Blog
*/

get_header();

$layout=ThemexCore::getOption('blog_layout','right');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$paged = (get_query_var('page')) ? get_query_var('page') : $paged;
$GLOBALS['date_format']=ThemexCore::getOption('date_format','m/d/Y');

if(!isset($_GET['s']) && get_post_type()=='page') {
	query_posts(array(
		'post_type' => 'post',
		'paged' => $paged,
	));
}

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
	<?php echo category_description(); ?>
	<div class="blog-listing">
	<?php 
	if (have_posts()) {
		while ( have_posts() ) {
			the_post();	
			get_template_part('loop', 'post');
		}
	} else {
	?>
	<h3><?php _e('No posts found. Try a different search?','travel2'); ?></h3>
	<p><?php _e('Sorry, no posts matched your search. Try again with some different keywords.','travel2'); ?></p><br />
	<?php }	?>
	</div><!-- items list -->
	<?php 
	themex_pagination(); 
	wp_reset_query(); 
	?>
</div>
<?php if($layout=='right') { ?>
<div class="column fourcol last">
<?php get_sidebar(); ?>
</div>
<?php } ?>
<?php get_footer(); ?>
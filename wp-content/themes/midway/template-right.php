<?php
/*
Template Name: Right Sidebar
*/
?>
<?php get_header(); ?>
<div class="column eightcol">
<?php
if(have_posts()) { 
	the_post();
	the_content();
}
?>
</div>
<div class="column fourcol last">
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
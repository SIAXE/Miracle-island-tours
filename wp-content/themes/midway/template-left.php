<?php
/*
Template Name: Left Sidebar
*/
?>
<?php get_header(); ?>
<div class="column fourcol">
<?php get_sidebar(); ?>
</div>
<div class="column eightcol last">
<?php
if(have_posts()) { 
	the_post();
	the_content();
}
?>
</div>
<?php get_footer(); ?>
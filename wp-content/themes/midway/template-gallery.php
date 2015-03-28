<?php
/*
Template Name: Gallery
*/

get_header();

$GLOBALS['layout']=ThemexCore::getOption('galleries_layout','three');
$GLOBALS['row_limit']=$GLOBALS['layout']=='four'?3:4;
$GLOBALS['caption']=ThemexCore::getOption('galleries_caption','visible');
$page_limit=ThemexCore::getOption('galleries_limit','12');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$paged = (get_query_var('page')) ? get_query_var('page') : $paged;
$category=!isset($post) || is_null($term=get_term($post->_page_galleries_category, 'gallery_category' )) || is_wp_error($term)? get_query_var('gallery_category') : $term->slug;

query_posts(array(
	'post_type' => 'gallery',
	'gallery_category' => $category,
	'posts_per_page' => intval($page_limit),
	'paged' => $paged,
	'meta_key' => '_thumbnail_id',
));
?>
<div class="items-grid">
	<?php 
		$GLOBALS['counter']=0;
		if (have_posts()) {
			while ( have_posts() ) {
				$GLOBALS['counter']++;
				the_post();							
				get_template_part('loop', 'gallery');
			
				if($GLOBALS['counter']==$GLOBALS['row_limit']) {
					$GLOBALS['counter']=0;
					echo '<div class="clear"></div>';
				}
			}
		}
	?>
	<div class="clear"></div>
</div><!--/ items grid-->
<?php 
Themex_pagination(); 
wp_reset_query();
?>
<?php get_footer(); ?>
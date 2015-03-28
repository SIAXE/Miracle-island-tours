<?php
/*
Template Name: Tours
*/

get_header();

$description=category_description();
$layout=ThemexCore::getOption('tours_layout','fullwidth');
$view=ThemexCore::getOption('tours_view','grid');
$GLOBALS['row_limit']=$layout!='left' && $layout!='right' ? 4 : 3;
$GLOBALS['row_class']=$GLOBALS['row_limit']==4 ? 'three' : 'four';
$GLOBALS['booking']=get_option('Themex_tours_booking');
$GLOBALS['questions']=get_option('Themex_tours_questions');
$GLOBALS['date_format']=ThemexCore::getOption('date_format','m/d/Y');
$page_limit=ThemexCore::getOption('tours_limit','12');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$paged = (get_query_var('page')) ? get_query_var('page') : $paged;

$args=array(
	'post_type'=>'tour',
	'posts_per_page'=>intval($page_limit),
	'paged'=>$paged,
	'meta_key'=>'_thumbnail_id',
	'post__in'=>Themex_tours_query(),
);

query_posts($args);

if($layout=='left') {
?>
<div class="column threecol">
<?php get_sidebar(); ?>
</div>
<div class="column ninecol last">
<?php } else if($layout=='right') { ?>
<div class="column ninecol">
<?php } else { ?>
<div class="fullwidth-block">
<?php } ?>
	<?php echo $description; ?>
	<div class="<?php echo $view=='list' ? 'items-list' : 'items-grid'; ?>">
		<?php 
		$GLOBALS['counter']=0;
		if (have_posts()) {
			while ( have_posts() ) {
				the_post();	
				if($view=='list') {
					get_template_part('loop', 'list-tour');
				} else {
					$GLOBALS['counter']++;		
					get_template_part('loop', 'grid-tour');
					
					if($GLOBALS['counter']==$GLOBALS['row_limit']) {
						$GLOBALS['counter']=0;
						echo '<div class="clear"></div>';
					}
				}
			}
		} else {
		?>
		<h3><?php _e('No tours found. Try a different search?','Travel2'); ?></h3>
		<p><?php _e('Sorry, no tours matched your search.','Travel2'); ?> <?php _e('View','Travel2'); ?> <a href="<?php echo home_url(); ?>/?s="><?php _e('all tours','Travel2'); ?></a> <?php _e('or try adjusting the search parameters','Travel2'); ?>.</p><br />
		<?php }	?>
		<?php if($view=='grid') { ?>
		<div class="clear"></div>
		<?php }	?>
	</div><!-- items list -->	
	<?php 
	Themex_pagination(); 
	wp_reset_query();
	get_template_part('module','forms');
	?>
</div>
<?php if($layout=='right') { ?>
<div class="column threecol last">
<?php get_sidebar(); ?>
</div>
<?php } ?>
<?php get_footer(); ?>
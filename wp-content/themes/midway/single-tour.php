<?php 
get_header();

$booking=get_option('Themex_tours_booking');
$questions=get_option('Themex_tours_questions');
$date_format=ThemexCore::getOption('date_format','m/d/Y');
?>
<?php the_post(); ?>
<?php get_template_part('loop', 'list-tour'); ?>
<?php get_template_part('module','forms'); ?>
<?php the_content(); ?>	
<?php if(get_option('Themex_tours_related')!='true') { 	?>
<?php get_template_part('module', 'related'); ?>
<?php } ?>
<?php get_footer(); ?>
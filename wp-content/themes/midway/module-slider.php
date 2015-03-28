<?php
//slider pause
$pause=ThemexCore::getOption('slider_pause',0);

//slider speed
$speed=ThemexCore::getOption('slider_speed',400);

//slider effect
$effect=ThemexCore::getOption('slider_type','fade');

//query slides
$query=new WP_Query(array(
	'post_type' =>'slide',
	'showposts' => -1,
));

if($query->have_posts()) {
?>
<div class="main-slider-container fade-slider-container">
	<div class="fade-slider main-slider">
		<ul>
			<?php
			while($query->have_posts()) {
				$query->the_post(); 
				$link=get_post_meta($post->ID,'_slide_link',true);
				if(has_post_thumbnail()) {
				?>
				<li>
				<div class="featured-image">
				<?php if(!empty($link)) { ?><a href="<?php echo $link; ?>"><?php } ?>
				<?php the_post_thumbnail('large'); ?>
				<?php if(!empty($link)) { ?></a><?php } ?>
				<?php if($post->post_content!='') { ?>
				<div class="featured-image-caption visible-caption"><h4><?php the_content(); ?></h4></div>
				<?php } ?>
				<?php } else if(($video_code=get_post_meta($post->ID,'_slide_video',true))!='') { ?>
				<div class="embedded-video"><?php echo Themex_html($video_code); ?></div>
				<?php } ?>
				</li>
			<?php } ?>									
		</ul>
		<div class="arrow arrow-left fade-slider-arrow"></div>
		<div class="arrow arrow-right fade-slider-arrow"></div>
		<input type="hidden" class="slider-pause" value="<?php echo $pause; ?>" />
		<input type="hidden" class="slider-speed" value="<?php echo $speed; ?>" />
		<input type="hidden" class="slider-effect" value="<?php echo $effect; ?>" />
	</div>
	<div class="block-background layer-1"></div>
	<div class="block-background layer-2"></div>
</div><!-- main slider -->
<?php } ?>
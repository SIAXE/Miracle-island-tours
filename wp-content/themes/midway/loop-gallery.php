<?php
parse_str(get_post_meta($post->ID,'_gallery_images',true),$gallery);
$permalink=wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$description=strip_tags(get_the_content());
$video_code=get_post_meta($post->ID,'_gallery_video',true);	
if($video_code!='') {
	$permalink='#gallery-'.$post->ID;
}
?>
<div class="column gallery-item <?php echo $GLOBALS['layout']; ?>col <?php echo $GLOBALS['counter']==$GLOBALS['row_limit'] ? 'last' : ''; ?>">
	<div class="featured-image">
		<a href="<?php echo $permalink; ?>" class="fancybox" data-group="gallery-<?php echo $post->ID; ?>" title="<?php echo $description; ?>">
			<?php the_post_thumbnail('normal'); ?>
		</a>
		<a class="featured-image-caption <?php echo $GLOBALS['caption']; ?>-caption" href="#">
			<h6><?php the_title(); ?></h6>
		</a>					
	</div>
	<div class="hidden">					
		<?php if($video_code!='') { ?>
		<div class="gallery-video" id="gallery-<?php echo $post->ID; ?>"><div class="embedded-video"><?php echo Themex_html($video_code); ?></div></div>
		<?php 
		} else {
			foreach($gallery as $image) {
			?>
			<a class="fancybox" href="<?php echo $image; ?>" data-group="gallery-<?php echo $post->ID; ?>" title="<?php echo $description; ?>"></a>
			<?php
			}
		}
		?>
	</div>
	<div class="block-background"></div>
</div>
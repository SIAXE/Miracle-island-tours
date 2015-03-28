<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>	
	
	<!-- Global JS Vars -->
	<script type="text/javascript">
		var template_directory = '<?php echo THEME_URI; ?>';
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>	
	<div class="container global-container">
		<div class="container header">	
			<?php themex_background(THEME_URI.'images/patterns/pattern_1.jpg', 'top-substrate'); ?>
			<div class="row supheader">			
				<div class="logo">
					<a href="<?php echo home_url(); ?>"><?php themex_logo(); ?></a>
				</div><!-- logo -->			
				<div class="social-links">
					<?php if(get_option('themex_rss_link')) { ?><a class="rss" href="<?php echo get_option('themex_rss_link'); ?>" target="_blank" title="RSS"></a><?php } ?>	
					<?php if(get_option('themex_google_link')) { ?><a target="_blank" href="<?php echo get_option('themex_google_link'); ?>" class="google" title="Google"></a><?php } ?>								
					<?php if(get_option('themex_youtube_link')) { ?><a target="_blank" href="<?php echo get_option('themex_youtube_link'); ?>" class="youtube" title="YouTube"></a><?php } ?>					
					<?php if(get_option('themex_facebook_link')) { ?><a target="_blank" href="<?php echo get_option('themex_facebook_link'); ?>" class="facebook" title="Facebook"></a><?php } ?>
					<?php if(get_option('themex_linkedin_link')) { ?><a target="_blank" href="<?php echo get_option('themex_linkedin_link'); ?>" class="linkedin" title="LinkedIn"></a><?php } ?>											
					<?php if(get_option('themex_tumblr_link')) { ?><a target="_blank" href="<?php echo get_option('themex_tumblr_link'); ?>" class="tumblr" title="Tumblr"></a><?php } ?>	
					<?php if(get_option('themex_twitter_link')) { ?><a target="_blank" href="<?php echo get_option('themex_twitter_link'); ?>" class="twitter" title="Twitter"></a><?php } ?>
					<?php if(get_option('themex_skype_link')) { ?><a target="_blank" href="<?php echo get_option('themex_skype_link'); ?>" class="skype" title="Skype"></a><?php } ?>
					<?php if(get_option('themex_vimeo_link')) { ?><a target="_blank" href="<?php echo get_option('themex_vimeo_link'); ?>" class="vimeo" title="Vimeo"></a><?php } ?>
					<?php if(get_option('themex_blogger_link')) { ?><a target="_blank" href="<?php echo get_option('themex_blogger_link'); ?>" class="blogger" title="Blogger"></a><?php } ?>
					<?php if(get_option('themex_flickr_link')) { ?><a target="_blank" href="<?php echo get_option('themex_flickr_link'); ?>" class="flickr" title="Flickr"></a><?php } ?>	
					<?php if(get_option('themex_stumbleupon_link')) { ?><a target="_blank" href="<?php echo get_option('themex_stumbleupon_link'); ?>" class="stumbleupon" title="StumbleUpon"></a><?php } ?>
				</div><!-- social links -->
				<?php if(get_option('themex_header_text')) { ?>
				<div class="header-text">
					<h5><?php echo do_shortcode(themex_html(ThemexCore::getOption('header_text'))); ?></h5>
				</div><!-- header text -->	
				<?php } ?>
				<?php wp_nav_menu( array( 'theme_location' => 'main_menu','container_class' => 'menu' ) ); ?>
				<div class="clear"></div>
				<div class="select-menu select-box">
					<?php ThemexInterface::renderDropdownMenu('main_menu'); ?>
					<span>&nbsp;</span>
				</div><!--/ select menu-->
				<div class="clear"></div>						
			</div><!-- supheader -->
			<?php if(is_front_page() && themex_is_slider_page()) { ?>
			

			<?php } ?>
			<div class="block-background header-background"></div>
		</div><!-- header -->
		<div class="container content">
			<div class="row">
<?php
//Custom styler module
class ThemexStyler {

	public static $data;
	public static $id=__CLASS__;
	
	//Init module
	public static function init() {
	
		self::$data=ThemexCore::$components['custom_styles'];
		
		//add styles and scripts
		add_action('wp_head', array(__CLASS__,'renderStyles'), 99);
		
		add_action('wp_head', array(__CLASS__,'renderFonts'), 1);
	}
	
	//Apply custom styles
	public static function renderStyles() {
	
		global $post;
	
		//favicon
		$out='<link rel="shortcut icon" href="'.ThemexCore::getOption('favicon',THEME_URI.'framework/admin/images/favicon.ico').'" />';
		
		//styles
		$out.='<style type="text/css">';
		
		if(is_array(self::$data)) {
		
			$page_background='';
			if(isset($post) && $post->post_type=='page') {
				$page_background=get_post_meta($post->ID,'_page_background',true);
			}
			
			foreach(self::$data as $style) {
				$out.=$style['elements'].'{';
				
				if(is_array($style['attributes'])) {
					foreach($style['attributes'] as $attr_name=>$option_id) {					
						if(ThemexCore::getOption($option_id)) {
						
							if($attr_name=='background-image') {
								$background=$page_background!=''?$page_background:ThemexCore::getOption($option_id);
								$option='url('.$background.')';
							} else if($attr_name=='font-size') {
								$option=ThemexCore::getOption($option_id).'px';
							} else if($attr_name=='font-family') {
								$option=ThemexCore::getOption($option_id).', Arial, Helvetica, sans-serif';
							} else {
								$option=ThemexCore::getOption($option_id);
							}
							
							$out.=$attr_name.':'.$option.';';
						}						
					}
				}
				
				
				
				$out.='}';
			}
		}
		
		$out.=ThemexCore::getOption('css').'</style>';
			
		echo $out;
	}
	
	//Add custom fonts
	public static function renderFonts() {
		$out='<script type="text/javascript">var templateDirectory = "'.THEME_URI.'";</script>';
		$heading_font=ThemexCore::getOption('heading_font','Signika');
		$content_font=ThemexCore::getOption('content_font','Open Sans');
		$fonts=array();
		
		if(!in_array($heading_font, array('Arial', 'Helvetica'))) {
			if($heading_font=='Signika') {
				$heading_font='Signika:400,600';
			}
		
			$fonts[]='"'.$heading_font.'"';
		}
		
		if(!in_array($content_font, array('Arial', 'Helvetica'))) {
			if($content_font=='Open Sans') {
				$content_font='Open Sans:400,400italic,600';
			}
		
			$fonts[]='"'.$content_font.'"';
		}		
		
		if(!empty($fonts)) {
			$out.='<script type="text/javascript">
			WebFontConfig = {google: { families: [ '.implode($fonts,',').' ] } };
			(function() {
				var wf = document.createElement("script");
				wf.src = ("https:" == document.location.protocol ? "https" : "http") + "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
				wf.type = "text/javascript";
				wf.async = "true";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(wf, s);
			})();
			</script>';
		}
		
		echo $out;
	}

}
?>
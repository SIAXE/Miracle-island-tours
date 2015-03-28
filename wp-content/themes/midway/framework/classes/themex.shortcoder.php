<?php
//Theme shortcodes class
class ThemexShortcoder {

	public static $data;
	public static $id;
	
	//Init module
	public static function init() {
	
		//init shortcode functions
		require_once(Themex_PATH.'extensions/Themex-shortcoder/shortcodes.php');
	
		//get shortcodes config
		self::$data=ThemexCore::$components['shortcodes'];
	
		//add tinymce plugin
		add_action('admin_init', array( __CLASS__, 'addShortcoder' ));
		
		//get current shortcode
		if(isset($_GET['popup'])) {
			self::$id=trim($_GET['popup']);
		}		
		
	}
	
	//Add button and plugin
	public static function addShortcoder() {		
		add_filter( 'mce_external_plugins', array( __CLASS__, 'addPlugin' ) );
		add_filter( 'mce_buttons', array( __CLASS__, 'addButton' ) );
	}
	
	//Add plugin
	public static function addPlugin( $plugin_array ) {
		$plugin_array['ThemexShortcoder'] = Themex_URI.'extensions/Themex-shortcoder/js/plugin.js';
		return $plugin_array;
	}
	
	//Add editor button
	public static function addButton( $buttons ) {
		array_push( $buttons, '|', 'Themex_button' );
		return $buttons;
	}
	
	//Render current shortcode settings
	public static function renderSettings() {
		
		if(is_array(self::$data))
		{

			//current shortcode options
			$out.='<div id="Themex_shortcode" class="hidden">'.self::$data[self::$id]['shortcode'].'</div>';
			$out.='<div id="Themex_popup" class="hidden">'.self::$id.'</div>';
			
			//render each option
			if(isset(self::$data[self::$id]['options'])) {
				foreach( self::$data[self::$id]['options'] as $option_id=>$option ) {
				
					//add options prefix
					$option_id='Themex_'.$option_id;
					
					//shortcode option start
					$out.='<tbody>';
					$out.='<tr class="form-row">';
					$out.='<td class="label">'.$option['label'].'</td>';
					$out.='<td class="field">';				
					
					switch($option['type']) {
					
						case 'text' :
							$out.='<input type="text" class="Themex_form-text Themex-input" name="'.$option_id.'" id="'.$option_id.'" value="'.$option['std'].'" />';
						break;
						
						case 'textarea' :
							$out.='<textarea rows="10" cols="30" name="'.$option_id.'" id="'.$option_id.'" class="Themex_form-textarea Themex-input">'.$option['std'].'</textarea>';
						break;
							
						case 'select' :						

							$out.='<select name="'.$option_id.'" id="'.$option_id.'" class="Themex_form-select Themex-input">';						
							foreach( $option['options'] as $value=>$name ) {
								$out.='<option value="'.$value.'">'.$name.'</option>';
							}						
							$out.='</select>';				
							
						break;
						
						case 'select_page':
						
							$args=array(
								'selected'         => $value,
								'echo'             => 0,
								'id'             => $option_id
							);	
							ob_start();
							echo wp_dropdown_pages($args);
							$out.=ob_get_contents();
							ob_end_clean();		
							
						break;
						
						case 'sidebars':
							global $wp_registered_sidebars;
							
							$sidebars=array();
							foreach($wp_registered_sidebars as $sidebar_key=>$sidebar) {
								$sidebars[$sidebar_key]=$sidebar['name'];
							}
							
							$out.=ThemexInterface::renderOption(array(
								'id' => $option_id,
								'type' => 'select',
								'wrap' => false,
								'options' => $sidebars,
								'attributes' => array('class'=>'Themex_form-select Themex-input'),
							));
						break;
						
						case 'select_category':
						
							$taxonomy='category';
							if(isset($option['taxonomy'])) {
								$taxonomy=$option['taxonomy'];
							}
						
							$args=array(
								'show_option_all'    => __('All Categories','Travel2'),
								'id'                 => $option_id,
								'hide_empty'         => 0,
								'echo'               => 0,
								'taxonomy'           => $taxonomy,
							);	
							$out.=wp_dropdown_categories($args);
						
						break;
						
						case 'select_portfolio_category':
						
							$args=array(
								'show_option_all'    => __('All','Travel2'),
								'id'                 => $option_id,
								'hide_empty'         => 0,
								'taxonomy'           => 'portfolio_category',
							);	
							ob_start();
							wp_dropdown_categories($args);
							$out.=ob_get_contents();
							ob_end_clean();	
							
						break;
							
						case 'checkbox' :
							
							$out.='<label for="'.$option_id.'" class="Themex_form-checkbox">';
							$out.='<input type="checkbox" class="Themex-input" name="'.$option_id.'" id="'.$option_id.'" '.($option['std']?'checked':'').' />';
							$out.=' '.$option['checkbox_text'].'</label>';
							
						break;
					}
					
					//shortcode option end
					$out.='<span class="Themex_form-desc">'.$option['desc'].'</span>';
					$out.='</td>';
					$out.='</tr>';					
					$out.='</tbody>';
				}
			}
			
			//render child shortcode
			if(isset(self::$data[self::$id]['child_shortcode'])) {
				
				//child shortcode start
				$out.='<tbody>';
				$out.='<tr class="form-row has-child">';
				$out.='<td><a href="#" id="form-child-add" class="button-secondary">'.self::$data[self::$id]['child_shortcode']['clone_button'].'</a>';
				$out.='<div class="child-clone-rows">';
				
				//child shortcode option
				$out.='<div id="Themex_cshortcode" class="hidden">'.self::$data[self::$id]['child_shortcode']['shortcode'].'</div>';
				
				//row to clone
				$out.='<div class="child-clone-row">';
				$out.='<ul class="child-clone-row-form">';				
		
				//render each option
				foreach(self::$data[self::$id]['child_shortcode']['options'] as $child_option_id=>$child_option) {
				
					//add options prefix
					$child_option_id='Themex_'.$child_option_id;
					
					//shortcode option start
					$out.='<li class="child-clone-row-form-row">';
					$out.='<div class="child-clone-row-label">';
					$out.='<label>'.$child_option['label'].'</label>';
					$out.='</div>';
					$out.='<div class="child-clone-row-field">';
					
					//cloned row start
					$out	.='<span class="child-clone-row-desc">'.$child_option['desc'].'</span>';
					$out.='</div>';
					$out.='</li>';
					
					switch( $child_option['type'] ) {
					
						case 'text':
							$out.='<input type="text" class="Themex_form-text Themex-cinput" name="'.$child_option_id.'" id="'.$child_option_id.'" value="'.$child_option['std'].'" />';
						break;
							
						case 'textarea':
							$out.='<textarea rows="10" cols="30" name="'.$child_option_id.'" id="'.$child_option_id.'" class="Themex_form-textarea Themex-cinput">'.$child_option['std'].'</textarea>';
						break;
							
						case 'select':							
	
							$out.='<select name="'.$child_option_id.'" id="'.$child_option_id.'" class="Themex_form-select Themex-cinput">';
							
							foreach( $child_option['options'] as $value => $name ) {
								$out.='<option value="'.$value.'">'.$name.'</option>';
							}
							
							$out.='</select>';							
						
						break;
							
						case 'checkbox':
							
							$out.='<label for="'.$child_option_id.'" class="Themex_form-checkbox">';
							$out.='<input type="checkbox" class="Themex-cinput" name="'.$child_option_id.'" id="'.$child_option_id.'" '.($child_option['std']?'checked':'').' />';
							$out.=' '.$child_option['checkbox_text'].'</label>';				
							
						break;
						
					}
				}
				
				//shortcode option end
				$out.='</ul>';
				$out.='<a href="#" class="child-clone-row-remove">'.__('Remove','Travel2').'</a>';
				$out.='</div>';
				
				//cloned rows end
				$out.='</div>';
				$out.='</td>';
				$out.='</tr>';					
				$out.='</tbody>';
				
			}
			
			return $out;
		}
	}
}
?>
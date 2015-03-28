<?php
//Main theme class
class ThemexCore {

	//theme modules
	public static $modules;

	//theme components
	public static $components;
	
	//theme options
	public static $options;
	
	//Build theme
	public function __construct($config) {
	
		//set theme modules
		self::$modules=$config['modules'];
		
		//set theme options
		self::$options=$config['options'];

		//set theme components
		self::$components=$config['components'];
		
		//init theme modules
		self::initModules();
		
		//init theme components
		self::initComponents();
		
		//add main AJAX action
		add_action('wp_ajax_themex_action', array($this,'changeOptions'));

		//add metabox data save action
		add_action('save_post', array($this,'savePost'));
		
		//add editor styles
		add_filter('tiny_mce_before_init', array($this,'addEditorStyles'));
		
		//activation hook
		add_action('init', array(__CLASS__, 'activate'));
		
	}
	
	//Theme activation hook
	public static function activate() {
		global $pagenow;
		if ('themes.php' == $pagenow && isset($_GET['activated'])) {
		
			//check php version
			if(version_compare( PHP_VERSION, '5', '<')) {
				switch_theme( 'twentyten', 'twentyten' );
				wp_die(__('Your PHP version is too old, this theme requires PHP 5.0 and higher.','travel2').'<br /><a href="'.admin_url( 'themes.php' ).'">'.__('Return to WP Admin','travel2').' &larr;</a>');
			}
			
			//rewrite all rules
			flush_rewrite_rules();
			
			//redirect to options panel
			wp_redirect(admin_url('admin.php?page=theme-options'));
			
		}
	}
	
	
	//Init theme components
	public function initComponents() {
	
		//add theme supports
		add_action('after_setup_theme', array($this,'supports'));
		
		//add theme textdomains
		add_action('after_setup_theme', array($this,'textdomains'));
	
		//add rewrite rules
		add_action('after_setup_theme', array($this,'rewrite_rules'));
	
		//register user roles
		add_action('init', array($this,'user_roles'));
		
		//add custom menus
		add_action('init', array($this,'custom_menus'));
		
		//add image sizes
		add_action('init', array($this,'image_sizes'));
	
		//enqueue backend scripts
		add_action('admin_enqueue_scripts', array($this,'backend_scripts'));
		
		//enqueue frontend scripts
		add_action('wp_enqueue_scripts', array($this,'frontend_scripts'));
		
		//enqueue backend styles
		add_action('admin_enqueue_scripts', array($this,'backend_styles'));
		
		//enqueue frontend styles
		add_action('wp_enqueue_scripts', array($this,'frontend_styles'), 99);
		
		//register widgets
		add_action('widgets_init', array($this,'widgets'));
		
		//register widget areas
		add_action('widgets_init', array($this,'widget_areas'));				
		
		//register taxonomies
		add_action('init', array($this,'taxonomies'));
		
		//register post types
		add_action('init', array($this,'post_types'));	
		
		//register meta boxes
		add_action('admin_menu', array($this,'meta_boxes'));
	}
	
	//Default call method to init components
	public function __call($component, $params)	{
		if(is_array(self::$components[$component])) {
			foreach(self::$components[$component] as $item) {

				switch($component) {
				
					case 'supports':
						add_theme_support($item);
					break;
					
					case 'textdomains':
						load_theme_textdomain($item['slug'], $item['path']);
					break;
					
					case 'user_roles':			
						add_role($item['role'], $item['name'], $item['capabilities']);
					break;
					
					case 'custom_menus':
						register_nav_menu( $item['slug'], $item['name'] );
					break;
					
					case 'image_sizes':
						add_image_size($item['name'], $item['width'], $item['height'], $item['crop']);
					break;
				
					case 'frontend_scripts':					
						self::enqueueScript($item, $component);
					break;
					
					case 'backend_scripts':					
						self::enqueueScript($item, $component);
					break;					
					
					case 'backend_styles':
						self::enqueueStyle($item);
					break;
					
					case 'frontend_styles':
						self::enqueueStyle($item);
					break;
					
					case 'widgets':
						self::registerWidget($item);
					break;
					
					case 'widget_areas':
						register_sidebar($item);
					break;
					
					case 'post_types':
						register_post_type($item['id'], $item);
					break;
					
					case 'taxonomies':
						register_taxonomy($item['taxonomy'], $item['object_type'], $item['settings']);
					break;
					
					case 'meta_boxes':
						add_meta_box($item['id'], $item['title'], array('ThemexInterface','renderMetabox'), $item['page'], $item['context'], $item['priority']);
					break;					
				}				
			}
		}
	}
	
	
	//Init theme modules
	public static function initModules() {
	
		foreach(self::$modules as $id=>$class) {
		
			//require module class
			$module_name=substr(strtolower(implode('.',preg_split('/(?=[A-Z])/',$class))),1);
			require_once(THEMEX_PATH.'classes/'.$module_name.'.php');
			
			//init module
			if(method_exists($class,'init')) {
				call_user_func(array($class,'init'));
			}
			
		}
	
	}
	
	
	//Ajax callback to change options
	public static function changeOptions() {
	
		$action=$_POST['type'];
		parse_str($_POST['data'], $data);

		if(isset($_POST['module'])) {
		
			if(method_exists($_POST['module'], 'change')) {
				call_user_func(array($_POST['module'], 'change'));
			}
		
		} else {
		
			switch($action) {
			
				//save options
				case 'save':
				
					//save options
					foreach(self::$options as $option) {
					
						if(isset($option['id'])) {
					
							if(!isset($data[$option['id']])) {
								$data[$option['id']]='false';
							}
						
							//save changed option
							if($data[$option['id']]!=self::getOption($option['id'])) {
								self::updateOption($option['id'],stripslashes($data[$option['id']]));
							}
						
						}
					}
					
					//save modules data
					foreach(self::$modules as $id=>$class) {
						if(method_exists($class, 'saveSettings')) {
							call_user_func(array($class, 'saveSettings'),$data);
						}
					}
					
					//server response					
					_e('All changes have been saved.','travel2');
					
				break;
				
				//reset options
				case 'reset':
				
					//delete modules data
					foreach(self::$modules as $class) {
						$attributes=get_class_vars($class);	
						if(isset($attributes['id'])) {
							self::deleteOption($attributes['id']);
						}
					}
				
					//delete options data
					foreach(self::$options as $option) {
						if(isset($option['id'])) {
							self::deleteOption($option['id']);
						}
					}
					
					//server response
					_e('All options have been reset.','travel2');
						
				break;		
				
			}
			
		}

		die();
		
	}
	
	//Save custom post
	public static function savePost($post_id) {
		
		global $post;

		//check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		//verify nonce
		if (isset($_POST['themex_nonce']) && !wp_verify_nonce($_POST['themex_nonce'], $post_id)) {
			return $post_id;
		}
		
		//check permissions
		if (isset($_POST['post_type']) && $_POST['post_type']=='page') {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		//search for current post metaboxes
		foreach(self::$components['meta_boxes'] as $meta_box) {
			
			if($meta_box['page']==$post->post_type) {
				foreach ($meta_box['options'] as $option) {
				
					//add post type prefix
					$option['id']='_'.$post->post_type.'_'.$option['id'];
					
					//set option value
					if(is_array($_POST[$option['id']])) {
						$option['value']=http_build_query($_POST[$option['id']]);
					} else {
						$option['value']=$_POST[$option['id']];
					}
					
					
					//update changed option
					if ($_POST[$option['id']] != get_post_meta($post_id, $option['id'], true)) {						
						update_post_meta($post_id, $option['id'], stripslashes($option['value']));						
					}
					
				}
			}
			
		}		
		
	}
	
	//Add JS script
	public static function enqueueScript($script,$type) {
		
		if((($type=='backend_scripts' && is_admin()) || ($type=='frontend_scripts' && !is_admin())) && (!isset($script['condition']) || (function_exists($script['condition']['function']) && call_user_func($script['condition']['function'],$script['condition']['value'])))){
			if(isset($script['uri'])) {
				if(isset($script['deps'])) {
					wp_enqueue_script($script['name'], $script['uri'], $script['deps']);	
				} else {
					wp_enqueue_script($script['name'], $script['uri']);
				}
			} else {
				wp_enqueue_script($script['name']);
			}
		}
	}
	
	//Add style
	public static function enqueueStyle($style) {
		if(isset($style['uri']) &&(!isset($style['condition']) || (function_exists($style['condition']['function']) && call_user_func($style['condition']['function'],$style['condition']['value'])))) {
			wp_enqueue_style($style['name'], $style['uri']);
		} else {
			wp_enqueue_style($style['name']);
		}	
	}
	
	//Register built-in widget
	public static function registerWidget($widget) {
			
		require_once(THEMEX_PATH.'widgets/'.$widget.'.php');
		register_widget($widget);
		
	}
	
	//Add editor styles
	public static function addEditorStyles($options) {
		$styles='';
		foreach(self::$components['editor_styles'] as $class=>$name) {
			$styles.=$name.'='.$class.';';
		}
	
		$options['theme_advanced_styles']=$styles;
		$options['theme_advanced_buttons2_add_before'] = 'styleselect';
		return $options;
	}
	
	//Get array value or default
	public static function getArrayValue($array, $key, $default=null) {
		if(isset($array[$key])) {
			return $array[$key];
		}
		return $default;
	}
	
	//Get theme option
	public static function getOption($id, $default=null) {
		$option=get_option('themex_'.$id);
		if(!$option && !is_null($default)) {
			return $default;
		}
		return $option;		
	}
	
	//Delete option with framework prefix
	public static function deleteOption($id) {
		return delete_option('themex_'.$id);
	}
	
	//Update option with framework prefix
	public static function updateOption($id,$value) {
		return update_option('themex_'.$id,$value);
	}
	
}
?>
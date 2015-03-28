<?php
//Custom widget areas module
class ThemexWidgetiser {

	public static $data;
	public static $id=__CLASS__;	
	
	//Init module
	public static function init() {
	
		//register default sidebar
		register_sidebar(array(	
			'name' => 'Default Sidebar',			
			'id' => 'default_sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="block-title"><h4>',
			'after_title' => '</h4></div>',
			'description' => '',
		));
			
		self::refresh();
			
		//register each stored area
		if(is_array(self::$data)) {
			foreach(self::$data as $area) {
				$area['before_widget']='<div class="widget %2$s">';
				$area['after_widget']='</div>';
				$area['before_title'] = '<div class="block-title"><h4>';
				$area['after_title'] = '</h4></div>';
				register_sidebar($area);
			}
		}
	}
	
	//Refresh module stored data
	public static function refresh() {
		self::$data=ThemexCore::getOption(self::$id);
	}
	
	//Save module static data
	public static function save() {
		ThemexCore::updateOption(self::$id,self::$data);
	}
	
	//Change module stored data
	public static function change() {
	
		//refresh stored data
		self::refresh();
		
		//set action type
		$type=$_POST['type'];
		
		//run action method
		if($type=='add_area') {
			self::addArea();
		} else if($type=='remove_area') {
			self::removeArea();
		} else if($type=='add_area_child') {
			self::addChild();
		} else if($type=='remove_area_child') {
			self::removeChild();
		}
		
	}
	
	//Save module settings
	public static function saveSettings($data) {
	
		//refresh stored data
		self::refresh();
		
		//search for widget areas options
		foreach($data as $key=>$value) {		
			if($key==self::$id && is_array($value)) {
			
				foreach($value as $area_id=>$area) {
					$name=self::$data[$area_id]['name'];
					self::$data[$area_id]=$value[$area_id];
					self::$data[$area_id]['name']=$name;
				}
				
			}
		}	
		
		//set sidebars description
		self::setDescription();
		
		//save static data
		self::save();
	}
	
	//Render module settings
	public static function renderSettings() {
	
		//refresh stored data
		self::refresh();	
		
		//area name option
		$name_option=array(	'name' => __('Sidebar Name','miracleisland'),
							'id' => 'themex_widgetiser_area_name',
							'type' => 'text',
							'after' => '<div class="themex_button add_sidebar">'.__('Add Sidebar','miracleisland').'</div>');
			
		$out='<div class="themex_widgetiser">'.ThemexInterface::renderOption($name_option,true);
		
		if(is_array(self::$data)) {
			foreach(self::$data as $area_id=>$area) {

				$out.='<div class="themex_section" id="'.$area_id.'"><h3>'.$area['name'].'</h3>';
				
				$option=array(  'id' => self::$id.'['.$area_id.'][name]',
										'type' => 'hidden',
										'default' => $area['name']);
										
				$out.=ThemexInterface::renderOption($option);	
				
				//area pages
				$out.='<div class="themex_left_col"><div class="themex_button add_page">'.__('Add Page','miracleisland').'</div>';
				if(isset($area['pages']) && is_array($area['pages'])) {
					foreach($area['pages'] as $key=>$value) {
						$option=array(  'id' => self::$id.'['.$area_id.'][pages]['.$key.']',
										'type' => 'select_page',
										'default' => $value,
										'after' => '<div class="themex_icon remove_page"></div>');
						$out.=ThemexInterface::renderOption($option);							
					}
				}
				$out.='</div>';
				
				//area categories
				$out.='<div class="themex_right_col"><div class="themex_button add_category">'.__('Add Category','miracleisland').'</div>';
				if(isset($area['categories']) && is_array($area['categories'])) {
					foreach($area['categories'] as $key=>$value) {
						$option=array(  'id' => self::$id.'['.$area_id.'][categories]['.$key.']',
										'type' => 'select_category',
										'default' => $value,
										'after' => '<div class="themex_icon remove_category"></div>');
						
						$out.=ThemexInterface::renderOption($option);
				
					}
				}
				$out.='</div><div class="clear"><div class="themex_button remove_sidebar">'.__('Remove Sidebar','miracleisland').'</div></div></div>';

			}
		}
		$out.='</div>';		
		return $out;
		
	}
	
	//Render module content
	public static function renderData($ID='') {

		//refresh stored data
		self::refresh();
		
		//get current id
		global $post;
		
		if(get_post_type()=='post') {
			$type='categories';
			$categories=get_the_category($post->ID);
			
			if(!empty($categories)) {
				$current_id=$categories[0]->term_id;
			}
		} else if(is_category()) {
			$type='categories';
			$current_id=get_query_var('cat');	
		} else if(isset($post)) {
			$type='pages';			
			$current_id=$post->ID;
		}
		
		//show wigetised areas
		$empty=true;
		if(!empty($ID)) {
			$empty=false;
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar(sanitize_title($ID)) )
			?>
			<?php
		} else if(is_array(self::$data)) {
			foreach(self::$data as $area) {
				if(isset($type) && isset($area[$type]) && is_array($area[$type])) {
					foreach($area[$type] as $name=>$sidebar_id) {
						
						if($current_id==$sidebar_id && !empty($area['name'])) {
							$empty=false;
							if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar($area['name']) )
							?>
							<?php
						}
					}
				}
			}
		}
		
		if($empty) {
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Default Sidebar') )
			?>
			<?php			
		}
	}	
	
	//Add widget area
	public static function addArea() {
	
		//generate area id
		$area_id=uniqid();
		
		//get area name
		$area_name=$_POST['area_name'];
				
		//set sidebar attributes
		$attributes= array('id' => $area_id, 'name' => $area_name);
						
		//add sidebar settings
		self::$data[$area_id]=$attributes;

        //area name option
		$name_option=array(	'name' => __('Sidebar Name','miracleisland'),
							'id' => self::$id.'['.$area_id.'][name]',
							'default' => self::$data[$area_id]['name'],
							'type' => 'text');
		
		self::save();
		
		//server response
		echo '<div class="themex_section hidden" id="'.$area_id.'"><h3>'.$area_name.'</h3><div class="themex_left_col"><div class="themex_button add_page">'.__('Add Page','miracleisland').'</div></div><div class="themex_right_col"><div class="themex_button add_category">'.__('Add Category','miracleisland').'</div></div><div class="clear"><div class="themex_button remove_sidebar">'.__('Remove Sidebar','miracleisland').'</div></div></div>';

	}
	
	//Remove widget area
	public static function removeArea() {
	
		$area_id=$_POST['area_id'];
	
		unset(self::$data[$area_id]);
		self::save();
		
	}
	
	//Add child to area
	public static function addChild() {
	
		//child data
		$area_id=$_POST['area_id'];
		$type=$_POST['child_type'];
	
		//generate child id
		$child_id=uniqid();
	
		//server response
		if($type=='pages') {
			$option=array(  'id' => self::$id.'['.$area_id.'][pages]['.$child_id.']',
							'type' => 'select_page',
							'after' => '<div class="themex_icon themex_action remove_page"></div>',
							'hidden' => true);	
			echo ThemexInterface::renderOption($option);
		
		} else if($type=='categories') {
			$option=array(  'id' => self::$id.'['.$area_id.'][categories]['.$child_id.']',
							'type' => 'select_category' ,
							'after' => '<div class="themex_icon themex_action remove_category"></div>',
							'hidden' => true);	
			echo ThemexInterface::renderOption($option);
						
		}
		
		
	
		self::$data[$area_id][$type][$child_id]='0';
		self::save();
		
	}
	
	//Remove child from area
	public static function removeChild() {
	
		$area_id=$_POST['area_id'];
		$child_id=$_POST['child_id'];
		$type=$_POST['child_type'];
	
		$keys=explode('][',$child_id);
		$child_id=substr($keys[count($keys)-1],0,-1);		
	
		unset(self::$data[$area_id][$type][$child_id]);
		
		self::save();

	}
	
	//Set sidebars description
	public static function setDescription() {
	
		if(is_array(self::$data)) {
			foreach(self::$data as $area_id=>$area) {
			
				//clear chidlren array
				$children=array();

				//clear sidebar description
				self::$data[$area_id]['description']='';
				
				//area pages
				if(is_array(self::$data[$area_id]['pages'])) {
					foreach($area['pages'] as $id) {
						//change area description
						$page=get_post($id);
						if($page) {
							$children[]=$page->post_title;					
						}
					}
				}
				
				//area categories
				if(is_array(self::$data[$area_id]['categories'])) {
					foreach($area['categories'] as $id) {
					
						//change area description
						if(get_cat_name($id)) {
							$children[]=get_cat_name($id);
						}
						
					}					
				}
				
				//create sidebar description
				if(is_array($children)) {
					self::$data[$area_id]['description']=implode(', ',array_unique($children));
				}
				
			}
		}
		
		//save static data
		self::save();
		
	}	
	
}
?>
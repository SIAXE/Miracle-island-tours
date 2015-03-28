<?php
//Theme configuration
$config = array (

	//Modules
	'modules' => array(

		//base modules
		'interface' => 'ThemexInterface',
		
		//additional
		'themex_widgetiser' => 'ThemexWidgetiser',
		'themex_form' => 'ThemexForm',
		'themex_shortcoder' => 'ThemexShortcoder',
		'themex_styler' => 'ThemexStyler',
	),

	//Components
	'components' => array(
	
		//Theme Supports
		'supports' => array (
			'automatic-feed-links',
			'post-thumbnails',
		),
		
		//Theme Textdomains
		'textdomains' => array(
			array(
				'slug' => 'travel2',
				'path' => THEME_PATH.'languages',
			),			
		),
		
		//Editor styles
		'editor_styles' => array(
			'styled-list list-1'=>__('List Style','travel2').' 1',
			'styled-list list-2'=>__('List Style','travel2').' 2',
			'styled-list list-3'=>__('List Style','travel2').' 3',
			'styled-list list-4'=>__('List Style','travel2').' 4',
			'styled-list list-5'=>__('List Style','travel2').' 5',
		),
	
		//Menus
		'custom_menus' => array (
			array(
				'slug' => 'main_menu',
				'name' => __('Main Menu','travel2'),
			),
			
			array(
				'slug' => 'footer_menu',
				'name' => __('Footer Menu','travel2'),
			),
		),
	
		//Image Sizes
		'image_sizes' => array (
		
			array(
				'name' => 'normal',
				'width' => 440,
				'height' => 440,
				'crop' => false,
			),
			
			array(
				'name' => 'extended',
				'width' => 600,
				'height' => 600,
				'crop' => false,
			),
			
		),

		//Theme backend styles
		'backend_styles' => array (
								
			//admin panel style
			array(	'name' => 'themex_admin',
					'uri' => THEMEX_URI.'admin/css/style.css'),
		
			//color picker
			array(	'name' => 'themex_colorpicker',
					'uri' => THEMEX_URI.'admin/css/colorpicker.css'),
					
			//date picker
			array(	'name' => 'jquery-ui-datepicker',
					'uri' => THEMEX_URI.'admin/css/datepicker.css'),
					
			//thickbox
			array(	'name' => 'thickbox' ),

		),
		
		//Theme frontend styles
		'frontend_styles' => array (		

			//fancybox
			array(	'name' => 'fancybox',
					'uri' => THEME_URI.'js/fancybox/jquery.fancybox.css'),
					
			//datepicker
			array(	'name' => 'datepicker',
					'uri' => THEME_URI.'js/datepicker/datepicker.css'),
					
			//main style
			array(	'name' => 'main',
					'uri' => THEME_CSS_URI.'style.css'),
			
		),
		
		//Theme backend scripts
		'backend_scripts' => array (
		
			//thickbox
			array(	'name' => 'thickbox' ),
			
			//media upload
			array(	'name' => 'media-upload' ),
			
			//jquery datepicker
			array(	'name' => 'jquery-ui-datepicker' ),
			
			//jquery slider
			array(	'name' => 'jquery-ui-slider' ),
		
			//panel interface
			array(	'name' => 'themex_admin',
					'uri' => THEMEX_URI.'admin/js/jquery.interface.js',
					'deps' => array('jquery')),
					
			//color picker
			array(	'name' => 'themex_colorpicker',
					'uri' => THEMEX_URI.'admin/js/jquery.colorpicker.js',
					'deps' => array('jquery')),
					
			//shortcodes popup
			array(	'name' => 'themex_shortcode_popup',
					'uri' => THEMEX_URI.'extensions/themex-shortcoder/js/popup.js',
					'deps' => array('jquery')),
					
			//shortcodes preview
			array(	'name' => 'themex_livequery',
					'uri' => THEMEX_URI.'extensions/themex-shortcoder/js/jquery.livequery.js',
					'deps' => array('jquery')),
					
			//shortcodes cloner
			array(	'name' => 'themex_appendo',
				'uri' => THEMEX_URI.'extensions/themex-shortcoder/js/jquery.appendo.js',
				'deps' => array('jquery')),
							
			
		),	
		
		//Theme frontend scripts
		'frontend_scripts' => array (
		
			//jquery
			array(	'name' => 'jquery' ),
			
			//text pattern
			array(	'name' => 'textpatternScript',
					'uri' => THEME_URI.'js/jquery.textPattern.js'),
					
			//placeholders script
			array(	'name' => 'placeholderScript',
					'uri' => THEME_URI.'js/jquery.placeholder.min.js'),
					
			//comment reply
			array(	'name' => 'comment-reply',
			'condition' => array('function'=>'is_single','value'=>'')),
			
			//fancybox
			array(	'name' => 'fancyboxScript',
					'uri' => THEME_URI.'js/fancybox/jquery.fancybox.js'),
					
			//fade slider
			array(	'name' => 'fadesliderScript',
					'uri' => THEME_URI.'js/jquery.fadeSlider.js'),
					
			//hover intent
			array(	'name' => 'hoverintentScript',
					'uri' => THEME_URI.'js/jquery.hoverIntent.js'),
					
			//custom
			array(	'name' => 'customScript',
					'uri' => THEME_URI.'js/jquery.custom.js'),
					
		),	
		
		//User Roles
		'user_roles' => array (
			
		),
		
		//Default widget areas
		'widget_areas' => array (
			array(	'name' => 'Footer Sidebar',
					'before_widget' => '<div class="column threecol"><div class="widget %2$s">',
					'after_widget' => '</div></div>',
					'before_title' => '<div class="block-title"><h3>',
					'after_title' => '</h3></div>',
					'id' => 'footer_sidebar'),
		),
		
		//Widgets
		'widgets' => array ('themex_subscribe_widget', 'themex_posts_widget', 'themex_twitter_widget'),
		
		//Post types
		'post_types' => array (
			
			//Tour
			array (
				'id' => 'tour',
				'labels' => array (
					'name' => __('Tours','travel2'),
					'singular_name' => __( 'Tour','travel2' ),
					'add_new' => __('Add New','travel2'),
					'add_new_item' => __('Add New Tour','travel2'),
					'edit_item' => __('Edit Tour','travel2'),
					'new_item' => __('New Tour','travel2'),
					'view_item' => __('View Tour','travel2'),
					'search_items' => __('Search Tours','travel2'),
					'not_found' =>  __('No Tours Found','travel2'),
					'not_found_in_trash' => __('No Tours Found in Trash','travel2'), 
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail','excerpt','revisions'),
				'rewrite' => array('slug' => __('tour', 'travel2')),
			),
			
			//Gallery
			array (
				'id' => 'gallery',
				'labels' => array (
					'name' => __('Galleries','travel2'),
					'singular_name' => __( 'Gallery','travel2' ),
					'add_new' => __('Add New','travel2'),
					'add_new_item' => __('Add New Gallery','travel2'),
					'edit_item' => __('Edit Gallery','travel2'),
					'new_item' => __('New Gallery','travel2'),
					'view_item' => __('View Gallery','travel2'),
					'search_items' => __('Search Galleries','travel2'),
					'not_found' =>  __('No Galleries Found','travel2'),
					'not_found_in_trash' => __('No Galleries Found in Trash','travel2'), 
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','thumbnail', 'editor'),	
				'rewrite' => array('slug' => __('gallery', 'travel2')),
			),
			
			//Testimonial
			array (
				'id' => 'testimonial',
				'labels' => array (
					'name' => __('Testimonials','travel2'),
					'singular_name' => __( 'Testimonial','travel2' ),
					'add_new' => __('Add New','travel2'),
					'add_new_item' => __('Add New Testimonial','travel2'),
					'edit_item' => __('Edit Testimonial','travel2'),
					'new_item' => __('New Testimonial','travel2'),
					'view_item' => __('View Testimonial','travel2'),
					'search_items' => __('Search Testimonials','travel2'),
					'not_found' =>  __('No Testimonials Found','travel2'),
					'not_found_in_trash' => __('No Testimonials Found in Trash','travel2'),
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor'),				
			),
			
			//Slide
			array (
				'id' => 'slide',
				'labels' => array (
					'name' => __('Slides','travel2'),
					'singular_name' => __( 'Slide','travel2' ),
					'add_new' => __('Add New','travel2'),
					'add_new_item' => __('Add New Slide','travel2'),
					'edit_item' => __('Edit Slide','travel2'),
					'new_item' => __('New Slide','travel2'),
					'view_item' => __('View Slide','travel2'),
					'search_items' => __('Search Slides','travel2'),
					'not_found' =>  __('No Slides Found','travel2'),
					'not_found_in_trash' => __('No Slides Found in Trash','travel2'), 
					'parent_item_colon' => ''
				 ),
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','thumbnail','editor'),				
			),
		),		
		
		//Taxonomies
		'taxonomies' => array (			
			array(	'taxonomy' => 'tour_destination',		
				'object_type' => array('tour'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,					
					'show_admin_column' => true,
					'labels' => array(
	                    'name' 				=> __( 'Destinations', 'travel2'),
	                    'singular_name' 	=> __( 'Destination', 'travel2'),
						'menu_name'			=> __( 'Destinations', 'travel2' ),
	                    'search_items' 		=> __( 'Search Destinations', 'travel2'),
	                    'all_items' 		=> __( 'All Destinations', 'travel2'),
	                    'parent_item' 		=> __( 'Parent Destination', 'travel2'),
	                    'parent_item_colon' => __( 'Parent Destination', 'travel2'),
	                    'edit_item' 		=> __( 'Edit Destination', 'travel2'),
	                    'update_item' 		=> __( 'Update Destination', 'travel2'),
	                    'add_new_item' 		=> __( 'Add New Destination', 'travel2'),
	                    'new_item_name' 	=> __( 'New Destination Name', 'travel2')
	            	),
					'rewrite' => array(
						'slug' => __('destinations', 'travel2'),
						'hierarchical' => true
					)
				)
			),
			array(	'taxonomy' => 'tour_type',
				'object_type' => array('tour'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,					
					'show_admin_column' => true,
					'labels' => array(
	                    'name' 				=> __( 'Types', 'travel2'),
	                    'singular_name' 	=> __( 'Type', 'travel2'),
						'menu_name'			=> __( 'Types', 'travel2' ),
	                    'search_items' 		=> __( 'Search Types', 'travel2'),
	                    'all_items' 		=> __( 'All Types', 'travel2'),
	                    'parent_item' 		=> __( 'Parent Type', 'travel2'),
	                    'parent_item_colon' => __( 'Parent Type', 'travel2'),
	                    'edit_item' 		=> __( 'Edit Type', 'travel2'),
	                    'update_item' 		=> __( 'Update Type', 'travel2'),
	                    'add_new_item' 		=> __( 'Add New Type', 'travel2'),
	                    'new_item_name' 	=> __( 'New Type Name', 'travel2')
	            	),
					'rewrite' => array(
						'slug' => __('types', 'travel2'),
						'hierarchical' => true
					)
				)
			),
			array(	'taxonomy' => 'gallery_category',				
				'object_type' => array('gallery'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,
					'show_admin_column' => true,
					'labels' => array(
	                    'name' 				=> __( 'Gallery Categories', 'travel2'),
	                    'singular_name' 	=> __( 'Gallery Category', 'travel2'),
						'menu_name'			=> __( 'Categories', 'travel2' ),
	                    'search_items' 		=> __( 'Search Gallery Categories', 'travel2'),
	                    'all_items' 		=> __( 'All Gallery Categories', 'travel2'),
	                    'parent_item' 		=> __( 'Parent Gallery Category', 'travel2'),
	                    'parent_item_colon' => __( 'Parent Gallery Category', 'travel2'),
	                    'edit_item' 		=> __( 'Edit Gallery Category', 'travel2'),
	                    'update_item' 		=> __( 'Update Gallery Category', 'travel2'),
	                    'add_new_item' 		=> __( 'Add New Gallery Category', 'travel2'),
	                    'new_item_name' 	=> __( 'New Gallery Category Name', 'travel2')
	            	),
					'rewrite' => array(
						'slug' => __('categories', 'travel2'),
						'hierarchical' => true
					)
				)
			),
		),
		
		//Meta boxes
		'meta_boxes' => array(
		
			//Page
			array(
				'id' => 'page_metabox',
				'title' =>  __('Page Options', 'travel2'),
				'page' => 'page',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(						
					array(	'name' => __('Page Background','travel2'),
							'id' => 'background',
							'type' => 'uploader'),
					
					array(	'name' => __('Tours Destination','travel2'),
							'id' => 'tours_destination',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_destination'),
					
					array(	'name' => __('Tours Type','travel2'),
							'id' => 'tours_type',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_type'),
							
					array(	'name' => __('Galleries Category','travel2'),
							'id' => 'galleries_category',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-gallery-child child-option hidden'),
							'taxonomy' => 'gallery_category'),
				),			
			),	
						
			//Slides
			array(
				'id' => 'slide_metabox',
				'title' =>  __('Slide Options', 'travel2'),
				'page' => 'slide',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
				
					array(	'name' => __('Image Link','travel2'),
							'desc' => __('Link for the slide image.','travel2'),
							'id' => 'link',
							'type' => 'text'),

					array(	'name' => __('Video Code','travel2'),
							'desc' => __('Paste embedded video code here.','travel2'),
							'id' => 'video',
							'type' => 'textarea'),

				),			
			),			
				
			//Tours
			array(
				'id' => 'tour_metabox',
				'title' =>  __('Tour Options', 'travel2'),
				'page' => 'tour',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Price','travel2'),
							'desc' => __('Tour minimum price.','travel2'),
							'id' => 'price',
							'type' => 'number'),					
					array(	'name' => __('Duration','travel2'),
							'desc' => __('Tour duration (days).','travel2'),
							'id' => 'duration',
							'type' => 'text'),
					array(	'name' => __('Daparts','travel2'),
							'desc' => __('Tour departure date.','travel2'),
							'id' => 'departure_date',
							'type' => 'date'),
					array(	'name' => __('Arrives','travel2'),
							'desc' => __('Tour arrival date.','travel2'),
							'id' => 'arrival_date',
							'type' => 'date'),
					array(	'name' => __('Booking Link','travel2'),
							'desc' => __('Link to book the tour.','travel2'),
							'id' => 'booking',
							'type' => 'text'),
					array(	'name' => __('Runs On','travel2'),
							'desc' => __('List of the week days.','travel2'),
							'id' => 'days',
							'type' => 'days'),					
					array(	'name' => __('Gallery Images','travel2'),
							'desc' => __('Add images for this tour.','travel2'),
							'id' => 'images',
							'type' => 'gallery'),
				),
			),
			
			//Galleries
			array(
				'id' => 'gallery_metabox',
				'title' =>  __('Gallery Options', 'travel2'),
				'page' => 'gallery',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Gallery Images','travel2'),
							'desc' => __('Add images for this gallery.','travel2'),
							'id' => 'images',
							'type' => 'gallery'),
					array(	'name' => __('Video Code','travel2'),
							'desc' => __('Paste embedded video code here.','travel2'),
							'id' => 'video',
							'type' => 'textarea'),
				),
			),
		),
		
		'shortcodes' => array(	
		
			//Columns
			'column' => array(
				'options' => array(),
				'shortcode' => '{{child_shortcode}}',
				'popup_title' => __('Insert Columns Shortcode', 'travel2'),
				'child_shortcode' => array(
					'options' => array(
						'column' => array(
							'type' => 'select',
							'label' => __('Column Width', 'travel2'),
							'options' => array(
								'one_sixth' => __('One Sixth', 'travel2'),
								'one_sixth_last' => __('One Sixth Last', 'travel2'),
								'one_fourth' => __('One Fourth', 'travel2'),
								'one_fourth_last' => __('One Fourth Last', 'travel2'),
								'one_third' => __('One Third', 'travel2'),
								'one_third_last' => __('One Third Last', 'travel2'),
								'five_twelfths' => __('Five Twelfths', 'travel2'),
								'five_twelfths_last' => __('Five Twelfths Last', 'travel2'),
								'one_half' => __('One Half', 'travel2'),
								'one_half_last' => __('One Half Last', 'travel2'),
								'seven_twelfths' => __('Seven Twelfths', 'travel2'),
								'seven_twelfths_last' => __('Seven Twelfths Last', 'travel2'),
								'two_thirds' => __('Two Thirds', 'travel2'),
								'two_thirds_last' => __('Two Thirds Last', 'travel2'),
								'three_fourths' => __('Three Fourths', 'travel2'),
								'three_fourths_last' => __('Three Fourths Last', 'travel2'),
							)
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Column Content', 'travel2'),
						)
					),
					'shortcode' => '[{{column}}]{{content}}[/{{column}}] ',
					'clone_button' => __('Add Columns Shortcode', 'travel2')
				)
			),
		
			//Block
			'block' => array(
				'options' => array(
					'background' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Block Background', 'travel2'),
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Block Content', 'travel2'),
					),
				),
				'shortcode' => '[block background="{{background}}"]{{content}}[/block]',			
				'popup_title' => __('Insert Block Shortcode', 'travel2')
			),			
			
			//Title
			'title' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Title Text', 'travel2'),
					),
				),
				'shortcode' => '[title]{{content}}[/title]',			
				'popup_title' => __('Insert Title Shortcode', 'travel2')
			),
			
			//Image
			'image' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Image URL', 'travel2'),
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Link URL', 'travel2'),
					),					
				),
				'shortcode' => '[image url="{{url}}"]{{content}}[/image]',	
				'popup_title' => __('Insert Image Shortcode', 'travel2')
			),
			
			//Button
			'button' => array(
				'options' => array(
					'color' => array(
						'type' => 'select',
						'label' => __('Button Color', 'travel2'),
						'options' => array(
							'default' => __('Default', 'travel2'),
							'grey' => __('Grey', 'travel2'),						
						)
					),
					'size' => array(
						'type' => 'select',
						'label' => __('Button Size', 'travel2'),
						'options' => array(
							'small' => __('Small', 'travel2'),
							'medium' => __('Medium', 'travel2'),
							'large' => __('Large', 'travel2')
						)
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button URL', 'travel2'),
					),
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button Text', 'travel2'),
					)
				),
				'shortcode' => '[button url="{{url}}" size="{{size}}"]{{content}}[/button]',
				'popup_title' => __('Insert Button Shortcode', 'travel2')
			),
			
			//Posts
			'posts' => array(
				'options' => array(
					'number' => array(
						'std' => '1',
						'type' => 'text',
						'label' => __('Posts Number', 'travel2'),
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Posts Category', 'travel2'),
						'taxonomy' => 'category',
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Posts Order', 'travel2'),
						'options' => array(
							'date' => __('Date', 'travel2'),
							'rand' => __('Random', 'travel2'),
						),
					),					
				),
				'shortcode' => '[posts number="{{number}}" order="{{order}}" category="{{category}}"]',		
				'popup_title' => __('Insert Posts Shortcode', 'travel2')
			),	
			
			//Tours
			'tours' => array(
				'options' => array(
					'type' => array(
						'type' => 'select_category',
						'label' => __('Tours Type', 'travel2'),
						'taxonomy' => 'tour_type',
					),
					'destination' => array(
						'type' => 'select_category',
						'label' => __('Tours Destination', 'travel2'),
						'taxonomy' => 'tour_destination',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Tours Number', 'travel2'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Tours Order', 'travel2'),
						'options' => array(
							'date' => __('Date', 'travel2'),
							'title' => __('Title', 'travel2'),
							'rand' => __('Random', 'travel2'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'travel2'),
						'options' => array(
							'3' => __('Three', 'travel2'),
							'4' => __('Four', 'travel2'),
						)
					),
				),
				'shortcode' => '[tours type="{{type}}" destination="{{destination}}" number="{{number}}" columns="{{columns}}" order="{{order}}"]',		
				'popup_title' => __('Insert Tours Shortcode', 'travel2')
			),
			
			//Galleries
			'galleries' => array(
				'options' => array(
					'caption' => array(
						'type' => 'select',
						'label' => __('Gallery Caption', 'travel2'),
						'options' => array(
							'visible' => __('Visible', 'travel2'),
							'hidden' => __('Hidden', 'travel2'),
							'none' => __('None', 'travel2'),
						)
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Galleries Category', 'travel2'),
						'taxonomy' => 'gallery_category',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Galleries Number', 'travel2'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Galleries Order', 'travel2'),
						'options' => array(
							'date' => __('Date', 'travel2'),
							'rand' => __('Random', 'travel2'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'travel2'),
						'options' => array(
							'3' => __('Three', 'travel2'),
							'4' => __('Four', 'travel2'),
						)
					),
				),
				'shortcode' => '[galleries category="{{category}}" number="{{number}}" columns="{{columns}}" order="{{order}}" caption="{{caption}}"]',
				'popup_title' => __('Insert Galleries Shortcode', 'travel2')
			),
						
			//Testimonials
			'testimonials' => array(
				'options' => array(
					'number' => array(
						'std' => '3',
						'type' => 'text',
						'label' => __('Testimonials Number', 'travel2'),
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Testimonials Order', 'travel2'),
						'options' => array(
							'date' => __('Date', 'travel2'),
							'rand' => __('Random', 'travel2'),
						)
					),
					'pause' => array(
						'std' => '0',
						'type' => 'text',
						'label' => __('Slider Pause', 'travel2'),
					),
					'speed' => array(
						'std' => '400',
						'type' => 'text',
						'label' => __('Transition Speed', 'travel2'),
					),
				),
				'shortcode' => '[testimonials number="{{number}}" order="{{order}}" pause="{{pause}}" speed="{{speed}}"]',		
				'popup_title' => __('Insert Testimonials Shortcode', 'travel2')
			),	
			
			//Itinerary
			'itinerary' => array(
				'options' => array(),
				'shortcode' => '[itinerary]{{child_shortcode}}[/itinerary]',
				'popup_title' => __('Insert Itinerary Shortcode', 'travel2'),
				'child_shortcode' => array(					
					'options' => array(
						'title' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Title', 'travel2'),
						),
						'image' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Image', 'travel2'),
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Day Content', 'travel2'),
						)
					),
					'shortcode' => '[day title="{{title}}" image="{{image}}"]{{content}}[/day]',
					'clone_button' => __('Add New Day', 'travel2')
				)
			),
			
			//Google Map
			'map' => array(
				'no_preview' => true,
				'options' => array(
					'align' => array(
						'type' => 'select',
						'label' => __('Align', 'travel2'),
						'options' => array(
							'none' => __('None', 'travel2'),
							'top' => __('Top', 'travel2'),
							'bottom' => __('Bottom', 'travel2'),
						)
					),
					'latitude' => array(
						'type' => 'text',
						'label' => __('Latitude', 'travel2'),
					),
					'longitude' => array(
						'type' => 'text',
						'label' => __('Longitude', 'travel2'),
					),
					'zoom' => array(
						'type' => 'text',
						'label' => __('Zoom', 'travel2'),
					),
					'height' => array(
						'type' => 'text',
						'std' => '250',
						'label' => __('Height', 'travel2'),
					),
					'description' => array(
						'type' => 'textarea',
						'std' => '',
						'label' => __('Description', 'travel2'),
					),
				),
				'shortcode' => '[map align="{{align}}" latitude="{{latitude}}" longitude="{{longitude}}" zoom="{{zoom}}" description="{{description}}" height="{{height}}"][/map]',
				'popup_title' => __('Insert Map Shortcode', 'travel2')
			),
			
			//Search Form
			'search_form' => array(
				'shortcode' => '[search_form]',
				'popup_title' => __('Insert Search Form Shortcode', 'travel2')
			),
			
			//Contact Form
			'contact_form' => array(
				'shortcode' => '[contact_form]',
				'popup_title' => __('Insert Contact Form Shortcode', 'travel2')
			),
			
			//Sidebar
			'sidebar' => array(
				'options' => array(
					'name' => array(
						'type' => 'sidebars',
						'label' => __('Name', 'travel2'),
					),
				),
				'shortcode' => '[sidebar name="{{name}}"]',
				'popup_title' => __('Insert Sidebar Shortcode', 'travel2')
			),
			
			//Tabs
			'tabs' => array(
				'options' => array(
					'type' => array(
							'type' => 'select',
							'label' => __('Tabs Type', 'travel2'),
							'options' => array(
								'horizontal' => __('Horizontal', 'travel2'),
								'vertical' => __('Vertical', 'travel2'),
						)
					),
					'titles' => array(
						'type' => 'text',
						'label' => __('Tab Titles', 'travel2'),
						'desc' => __('Enter the comma separated tab titles.', 'travel2')
					),		
				),
				'shortcode' => '[tabs type="{{type}}" titles="{{titles}}"]{{child_shortcode}}[/tabs]',
				'popup_title' => __('Insert Tabs Shortcode', 'travel2'),
				'child_shortcode' => array(
					'options' => array(
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Tab Content', 'travel2'),
						)
					),
					'shortcode' => '[tab]{{content}}[/tab]',
					'clone_button' => __('Add Tab', 'travel2')
				)
			),
			
			//Toggle
			'toggle' => array(
				'options' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Toggle Title', 'travel2'),
						'std' => ''
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Toggle Content', 'travel2'),
					)
					
				),
				'shortcode' => '[toggle title="{{title}}"]{{content}}[/toggle]',
				'popup_title' => __('Insert Toggle Shortcode', 'travel2')
			),
		
		),		
		
		//Theme custom styles
		'custom_styles' => array (
			array(
				'elements' => '.global-container, .header',
				'attributes' => array('background-image'=>'background_pattern'),
			),
			
			array(
				'elements' => '.global-container, .header',
				'attributes' => array('background-image'=>'background_image'),
			),
			
			array(
				'elements' => 'body, input, select, textarea',
				'attributes' => array('font-family'=>'content_font'),
			),
			
			array(
				'elements' => 'h1,h2,h3,h4,h5,h6, .button, .header .menu a',
				'attributes' => array('font-family'=>'heading_font'),
			),
			
			array(
				'elements' => 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .header .menu ul ul a:hover, .header  .menu > ul > li.current-menu-item > a,.header  .menu > ul > li.current-menu-parent > a,.header  .menu > ul > li.hover > a,.header  .menu > ul > li:hover > a',
				'attributes' => array('color'=>'primary_color')
			),
			
			array(
				'elements' => 'input[type="submit"], input[type="button"], .button, .colored-icon, .ui-slider .ui-slider-range, .tour-itinerary .tour-day-number h5, .testimonials-slider .controls a.current',
				'attributes' => array('background-color'=>'primary_color')
			),
			
			array(
				'elements' => '.header .logo a, .header .header-text h5, .header .social-links span, .header .menu a, .header .menu a span, .footer .row, .footer a',
				'attributes' => array('color'=>'secondary_color')
			),
			
			array(
				'elements' => '.header .menu ul ul li, .header  .menu > ul > li.current-menu-item > a, .header  .menu > ul > li.current-menu-parent > a, .header  .menu > ul > li.hover > a, .header  .menu > ul > li:hover > a',
				'attributes' => array('background-color'=>'secondary_color')
			),
			
			array(
				'elements' => '::-moz-selection',
				'attributes' => array('background-color'=>'primary_color')
			),
			array(
				'elements' => '::selection',
				'attributes' => array('background-color'=>'primary_color')
			),
		),
	),

	
	//Options
	'options' => array (
			
		//General Settings
		array(	'name' => __('General','travel2'),
				'type' => 'page'),
				
		array(	'name' => __('Site Favicon','travel2'),
				'description' => __('Upload an image for your site favicon.','travel2'),
				'id' => 'favicon',
				'type' => 'uploader'),
				
		array(	'name' => __('Site Logo Type','travel2'),
				'id' => 'logo_type',
				'options' => array('image' => __('Image','travel2'), 'text' => __('Text','travel2')),
				'type' => 'select'),
				
		array(	'name' => __('Site Logo Image','travel2'),
				'description' => __('Upload an image for your site logo.','travel2'),
				'id' => 'logo_image',
				'type' => 'uploader',
				'parent' => array('logo_type','0')),
				
		array(	'name' => __('Site Logo Text','travel2'),
				'description' => __('Enter the text for your site logo.','travel2'),
				'id' => 'logo_text',
				'type' => 'text',
				'parent' => array('logo_type','1')),
				
		array(	'name' => __('Login Logo Image','travel2'),
				'description' => __('Upload an image to show on the login page.','travel2'),
				'id' => 'login_logo',
				'type' => 'uploader'),
				
		array(	'name' => __('Date Format','travel2'),
				'description' => __('Choose the date format for all post types and comments.','travel2'),
				'id' => 'date_format',
				'options' => array(
					'm/d/Y'=>'MM/DD/YY',
					'd/m/Y'=>'DD/MM/YY',						
				),
				'type' => 'select'),
				
		array(	'name' => __('Copyright Text','travel2'),
				'description' => __('Enter the copyright text to be displayed in the footer.','travel2'),
				'id' => 'copyright_text',
				'default' => '',
				'type' => 'textarea'),
				
		array(	'name' => __('Tracking Code','travel2'),
				'description' => __('Add tracking analytics code here.','travel2'),
				'id' => 'tracking_code',
				'default' => '',
				'type' => 'textarea'),				
				
		//Styling
		array(	'name' => __('Styling','travel2'),
				'type' => 'page'),
				
		array(	'name' => __('Custom CSS','travel2'),
				'description' => __('Write CSS rules here to overwrite the default styles.','travel2'),
				'default' => '',
				'id' => 'css',
				'type' => 'textarea'),
				
		array(	'name' => __('Primary Theme Color','travel2'),
				'default' => '#FF9000',
				'id' => 'primary_color',
				'type' => 'color'),
				
		array(	'name' => __('Secondary Theme Color','travel2'),
				'default' => '#FFFFFF',
				'id' => 'secondary_color',
				'type' => 'color'),
				
		array(	'name' => __('Background Type','travel2'),
				'id' => 'background_type',
				'options' => array('default' => __('Default','travel2'), 'custom' => __('Custom','travel2')),
				'description' => __('Choose from the default patterns or upload your own image.','travel2'),
				'type' => 'select'),
				
		array(	'name' => __('Background Pattern','travel2'),
				'id' => 'background_pattern',
				'options' => array(
									THEME_URI.'images/patterns/pattern_1.png'=>THEME_URI.'images/patterns/pattern_1_thumb.png', 
									THEME_URI.'images/patterns/pattern_2.png'=>THEME_URI.'images/patterns/pattern_2_thumb.png', 
									THEME_URI.'images/patterns/pattern_3.png'=>THEME_URI.'images/patterns/pattern_3_thumb.png', 
									THEME_URI.'images/patterns/pattern_4.png'=>THEME_URI.'images/patterns/pattern_4_thumb.png', 
									THEME_URI.'images/patterns/pattern_5.png'=>THEME_URI.'images/patterns/pattern_5_thumb.png', 
									THEME_URI.'images/patterns/pattern_6.png'=>THEME_URI.'images/patterns/pattern_6_thumb.png', 
									THEME_URI.'images/patterns/pattern_7.png'=>THEME_URI.'images/patterns/pattern_7_thumb.png', 
									THEME_URI.'images/patterns/pattern_8.png'=>THEME_URI.'images/patterns/pattern_8_thumb.png', 
									THEME_URI.'images/patterns/pattern_9.png'=>THEME_URI.'images/patterns/pattern_9_thumb.png', 
									THEME_URI.'images/patterns/pattern_10.png'=>THEME_URI.'images/patterns/pattern_10_thumb.png', 
									THEME_URI.'images/patterns/pattern_11.png'=>THEME_URI.'images/patterns/pattern_11_thumb.png', 
									THEME_URI.'images/patterns/pattern_12.png'=>THEME_URI.'images/patterns/pattern_12_thumb.png', 
									THEME_URI.'images/patterns/pattern_13.png'=>THEME_URI.'images/patterns/pattern_13_thumb.png', 
									THEME_URI.'images/patterns/pattern_14.png'=>THEME_URI.'images/patterns/pattern_14_thumb.png', 
									THEME_URI.'images/patterns/pattern_15.png'=>THEME_URI.'images/patterns/pattern_15_thumb.png', 
									THEME_URI.'images/patterns/pattern_16.png'=>THEME_URI.'images/patterns/pattern_16_thumb.png', 
									),
				'type' => 'select_image',				
				'parent' => array('background_type','0')),
				
		array(	'name' => __('Background Image','travel2'),
				'id' => 'background_image',
				'type' => 'uploader',
				'parent' => array('background_type','1')),
				
		array(	'name' => __('Tiled Background','travel2'),
					'id' => 'background_fullwidth',
					'description' => __('Check this to use tiled background instead of full width image.','travel2'),
					'type' => 'checkbox'),
					
		array(	'name' => __('Heading Font','travel2'),					
				'id' => 'heading_font',
				'default' => 'Signika',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		array(	'name' => __('Content Font','travel2'),
				'id' => 'content_font',
				'default' => 'Open Sans',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		//Header
		array(	'name' => __('Header','travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Header Layout','travel2'),
				'id' => 'header_layout',
				'options' => array(
					'separated'=>THEMEX_URI.'admin/images/layouts/7.png',
					'fullwidth'=>THEMEX_URI.'admin/images/layouts/8.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Header Text','travel2'),
				'description' => __('Enter the text to be displayed at the social links.','travel2'),
				'id' => 'header_text',
				'default' => '',
				'type' => 'textarea'),
				
			array(	'name' => __('Slider','travel2'),
				'type' => 'section'),
				
				array(	'name' => __('Slider Type','travel2'),
					'id' => 'slider_type',
					'options' => array('fade' => __('Fade Slider','travel2'), 'motion' => __('Motion Slider','travel2')),
					'type' => 'select'),
					
			array(	'name' => __('Slider Pause','travel2'),
					'default' => '0',
					'id' => 'slider_pause',
					'attributes' => array('min_value' => '0', 'max_value' => '20000', 'unit' => 'ms'),
					'type' => 'slider'),
					
			array(	'name' => __('Transition Speed','travel2'),
					'default' => '400',
					'id' => 'slider_speed',
					'attributes' => array('min_value' => '100', 'max_value' => '1000', 'unit' => 'ms'),
					'type' => 'slider'),
				
			array(	'name' => __('Social Links','travel2'),
				'type' => 'section'),
				
			array(	'name' => __('RSS Link','travel2'),
					'id' => 'rss_link',
					'type' => 'text'),
					
			array(	'name' => __('Facebook Link','travel2'),
					'id' => 'facebook_link',
					'type' => 'text'),
					
			array(	'name' => __('Twitter Link','travel2'),
					'id' => 'twitter_link',
					'type' => 'text'),
					
			array(	'name' => __('Google Link','travel2'),
					'id' => 'google_link',
					'type' => 'text'),

			array(	'name' => __('Flickr Link','travel2'),
					'id' => 'flickr_link',
					'type' => 'text'),
					
			array(	'name' => __('Tumblr Link','travel2'),
					'id' => 'tumblr_link',
					'type' => 'text'),

			array(	'name' => __('LinkedIn Link','travel2'),
					'id' => 'linkedin_link',
					'type' => 'text'),		
					
			array(	'name' => __('YouTube Link','travel2'),
					'id' => 'youtube_link',
					'type' => 'text'),
					
			array(	'name' => __('Vimeo Link','travel2'),
					'id' => 'vimeo_link',
					'type' => 'text'),
					
			array(	'name' => __('Skype Link','travel2'),
					'id' => 'skype_link',
					'type' => 'text'),
					
			array(	'name' => __('Blogger Link','travel2'),
					'id' => 'blogger_link',
					'type' => 'text'),
					
			array(	'name' => __('StumbleUpon Link','travel2'),
					'id' => 'stumbleupon_link',
					'type' => 'text'),			
					
		//Tours
		array(	'name' => __('Tours','travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Tours Layout','travel2'),
				'id' => 'tours_layout',
				'options' => array(
					'right'=>THEMEX_URI.'admin/images/layouts/3.png',
					'left'=>THEMEX_URI.'admin/images/layouts/2.png',									
					'fullwidth'=>THEMEX_URI.'admin/images/layouts/1.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Tours View','travel2'),
					'id' => 'tours_view',
					'options' => array('grid' => __('Grid','travel2'), 'list' => __('List','travel2')),
					'type' => 'select'),
					
			array(	'name' => __('Tours Per Page','travel2'),
				'id' => 'tours_limit',
				'default' => '12',
				'type' => 'number'),
				
			array(	'name' => __('Price Currency','travel2'),
					'id' => 'tours_currency',
					'default' => '$',
					'description' => __('Set price currency symbol.','travel2'),
					'type' => 'text'),
					
			array(	'name' => __('Currency Position','travel2'),
					'id' => 'tours_currency_position',
					'options' => array('left' => __('Left','travel2'), 'right' => __('Right','travel2')),
					'type' => 'select'),			
				
			array(	'name' => __('Related Tours Order','travel2'),
					'id' => 'tours_related_order',
					'options' => array(
						'rand' => __('Random','travel2'), 
						'type' => __('Type','travel2'), 'destination' => __('Destination','travel2')
					),
					'type' => 'select'),
					
			array(	'name' => __('Hide Related Tours','travel2'),
					'id' => 'tours_related',
					'type' => 'checkbox'),

			array(	'name' => __('Disable Booking','travel2'),
					'id' => 'tours_booking',
					'description' => __('Check this to disable booking form.','travel2'),
					'type' => 'checkbox'),
					
			array(	'name' => __('Disable Questions','travel2'),
					'id' => 'tours_questions',
					'description' => __('Check this to disable question form.','travel2'),
					'type' => 'checkbox'),
					
		//Gallery
		array(	'name' => __('Galleries','travel2'),
				'type' => 'page'),
				
				array(	'name' => __('Galleries Layout','travel2'),
				'id' => 'galleries_layout',
				'options' => array(
					'four'=>THEMEX_URI.'admin/images/layouts/5.png',
					'three'=>THEMEX_URI.'admin/images/layouts/6.png',
				),
				'type' => 'select_image'),
				
				array(	'name' => __('Galleries Per Page','travel2'),
				'id' => 'galleries_limit',
				'default' => '12',
				'type' => 'number'),
				
				array(	'name' => __('Galleries Caption','travel2'),
					'id' => 'galleries_caption',
					'options' => array(
						'visible' => __('Visible', 'travel2'),
						'hidden' => __('Hidden', 'travel2'),
						'none' => __('None', 'travel2'),
					),
					'type' => 'select'),
				
		//Search Form
		array(	'name' => __('Search Form','travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Form Title','travel2'),
					'id' => 'search_form_title',
					'default' => '',
					'type' => 'text'),
				
			array(	'name' => __('Hide Destination Field','travel2'),
					'id' => 'search_form_destination',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Type Field','travel2'),
					'id' => 'search_form_type',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Date Fields','travel2'),
					'id' => 'search_form_date',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Price Field','travel2'),
					'id' => 'search_form_price',
					'type' => 'checkbox'),
					
		//Booking Payments
		array(	'name' => __('Booking Payment','travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Enable Booking Payment','travel2'),
						'id' => 'booking_payment',
						'type' => 'checkbox'),				
				
			array(	'name' => __('Payment Language','travel2'),
				'id' => 'booking_language',
				'options' => array(
					'AU' => __('Australian','travel2'), 
					'CN' => __('Chinese','travel2'),
					'EN' => __('English','travel2'), 
					'FR' => __('French','travel2'),
					'DE' => __('German','travel2'), 
					'IT' => __('Italian','travel2'),
					'JP' => __('Japanese','travel2'), 
					'PL' => __('Polish','travel2'),
					'ES' => __('Spanish','travel2'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Currency','travel2'),
				'id' => 'booking_currency',
				'options' => array(
					'AUD' => __('Australian Dollar','travel2'), 
					'CAD' => __('Canadian Dollar','travel2'),
					'EUR' => __('Euro','travel2'),
					'GBP' => __('British Pound','travel2'),
					'JPY' => __('Japanese Yen','travel2'), 
					'USD' => __('United States Dollar','travel2'),
					'NZD' => __('New Zealand Dollar','travel2'),
					'CHF' => __('Swiss Franc','travel2'),
					'HKD' => __('Hong Kong Dollar','travel2'),
					'SGD' => __('Singapore Dollar','travel2'),
					'SEK' => __('Swedish Krona','travel2'),
					'DKK' => __('Danish Krone','travel2'),
					'PLN' => __('Polish Zloty','travel2'),
					'NOK' => __('Norwegian Krone','travel2'),
					'HUF' => __('Hungarian Forint','travel2'),
					'CZK' => __('Czech Koruna','travel2'),
					'ILS' => __('Israeli Shekel','travel2'),
					'MXN' => __('Mexican Peso','travel2'),
					'BRL' => __('Brazilian Real','travel2'),
					'MYR' => __('Malaysian Ringgit','travel2'),
					'PHP' => __('Philippine Peso','travel2'),
					'TWD' => __('New Taiwan Dollar','travel2'),
					'THB' => __('Thai Baht','travel2'),
					'TRY' => __('Turkish Lira','travel2'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Amount','travel2'),
				'id' => 'booking_price',
				'default' => '0',
				'description' => __('Enter in the booking fee amount.','travel2'),
				'type' => 'number'),
				
			array(	'name' => __('PayPal Account','travel2'),
				'id' => 'booking_email',
				'default' => '',
				'description' => __('Enter in your PayPal account email address.','travel2'),
				'type' => 'text'),
			
		//Booking Form
		array(	'name' => __('Booking Form','travel2'),
				'type' => 'page'),	

			array(	'type' => 'themex_form',
					'id' => 'booking_form' ),			
					
		//Question Form
		array(	'name' => __('Question Form','travel2'),
				'type' => 'page'),
				
			array(	'type' => 'themex_form',
					'id' => 'question_form' ),
		
		//Contact Form
		array(	'name' => __('Contact Form','travel2'),
				'type' => 'page'),
				
			array(	'type' => 'themex_form',
					'id' => 'contact_form' ),	

		//Custom Sidebars
		array(	'name' => __('Sidebars','travel2'),
				'type' => 'page'),
				
			array(	'type' => 'themex_widgetiser',
					'id' => 'themex_widgetiser' ),
				
		//Mailing List
		array(	'name' => __('Mailing List','travel2'),
				'type' => 'page'),
				
			array(	'name' => '',
					'id' => 'mailing_list',
					'default' => '',
					'description' => __('This is the list of subcribers from Newsletter Widget.','travel2'),
					'type' => 'textarea'),
	),

);
?>
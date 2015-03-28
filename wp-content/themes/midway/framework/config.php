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
				'slug' => 'miracleisland',
				'path' => THEME_PATH.'languages',
			),			
		),
		
		//Editor styles
		'editor_styles' => array(
			'styled-list list-1'=>__('List Style','miracleisland').' 1',
			'styled-list list-2'=>__('List Style','miracleisland').' 2',
			'styled-list list-3'=>__('List Style','miracleisland').' 3',
			'styled-list list-4'=>__('List Style','miracleisland').' 4',
			'styled-list list-5'=>__('List Style','miracleisland').' 5',
		),
	
		//Menus
		'custom_menus' => array (
			array(
				'slug' => 'main_menu',
				'name' => __('Main Menu','miracleisland'),
			),
			
			array(
				'slug' => 'footer_menu',
				'name' => __('Footer Menu','miracleisland'),
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
					'name' => __('Tours','miracleisland'),
					'singular_name' => __( 'Tour','miracleisland' ),
					'add_new' => __('Add New','miracleisland'),
					'add_new_item' => __('Add New Tour','miracleisland'),
					'edit_item' => __('Edit Tour','miracleisland'),
					'new_item' => __('New Tour','miracleisland'),
					'view_item' => __('View Tour','miracleisland'),
					'search_items' => __('Search Tours','miracleisland'),
					'not_found' =>  __('No Tours Found','miracleisland'),
					'not_found_in_trash' => __('No Tours Found in Trash','miracleisland'), 
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
				'rewrite' => array('slug' => __('tour', 'miracleisland')),
			),
			
			//Gallery
			array (
				'id' => 'gallery',
				'labels' => array (
					'name' => __('Galleries','miracleisland'),
					'singular_name' => __( 'Gallery','miracleisland' ),
					'add_new' => __('Add New','miracleisland'),
					'add_new_item' => __('Add New Gallery','miracleisland'),
					'edit_item' => __('Edit Gallery','miracleisland'),
					'new_item' => __('New Gallery','miracleisland'),
					'view_item' => __('View Gallery','miracleisland'),
					'search_items' => __('Search Galleries','miracleisland'),
					'not_found' =>  __('No Galleries Found','miracleisland'),
					'not_found_in_trash' => __('No Galleries Found in Trash','miracleisland'), 
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
				'rewrite' => array('slug' => __('gallery', 'miracleisland')),
			),
			
			//Testimonial
			array (
				'id' => 'testimonial',
				'labels' => array (
					'name' => __('Testimonials','miracleisland'),
					'singular_name' => __( 'Testimonial','miracleisland' ),
					'add_new' => __('Add New','miracleisland'),
					'add_new_item' => __('Add New Testimonial','miracleisland'),
					'edit_item' => __('Edit Testimonial','miracleisland'),
					'new_item' => __('New Testimonial','miracleisland'),
					'view_item' => __('View Testimonial','miracleisland'),
					'search_items' => __('Search Testimonials','miracleisland'),
					'not_found' =>  __('No Testimonials Found','miracleisland'),
					'not_found_in_trash' => __('No Testimonials Found in Trash','miracleisland'),
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
					'name' => __('Slides','miracleisland'),
					'singular_name' => __( 'Slide','miracleisland' ),
					'add_new' => __('Add New','miracleisland'),
					'add_new_item' => __('Add New Slide','miracleisland'),
					'edit_item' => __('Edit Slide','miracleisland'),
					'new_item' => __('New Slide','miracleisland'),
					'view_item' => __('View Slide','miracleisland'),
					'search_items' => __('Search Slides','miracleisland'),
					'not_found' =>  __('No Slides Found','miracleisland'),
					'not_found_in_trash' => __('No Slides Found in Trash','miracleisland'), 
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
	                    'name' 				=> __( 'Destinations', 'miracleisland'),
	                    'singular_name' 	=> __( 'Destination', 'miracleisland'),
						'menu_name'			=> __( 'Destinations', 'miracleisland' ),
	                    'search_items' 		=> __( 'Search Destinations', 'miracleisland'),
	                    'all_items' 		=> __( 'All Destinations', 'miracleisland'),
	                    'parent_item' 		=> __( 'Parent Destination', 'miracleisland'),
	                    'parent_item_colon' => __( 'Parent Destination', 'miracleisland'),
	                    'edit_item' 		=> __( 'Edit Destination', 'miracleisland'),
	                    'update_item' 		=> __( 'Update Destination', 'miracleisland'),
	                    'add_new_item' 		=> __( 'Add New Destination', 'miracleisland'),
	                    'new_item_name' 	=> __( 'New Destination Name', 'miracleisland')
	            	),
					'rewrite' => array(
						'slug' => __('destinations', 'miracleisland'),
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
	                    'name' 				=> __( 'Types', 'miracleisland'),
	                    'singular_name' 	=> __( 'Type', 'miracleisland'),
						'menu_name'			=> __( 'Types', 'miracleisland' ),
	                    'search_items' 		=> __( 'Search Types', 'miracleisland'),
	                    'all_items' 		=> __( 'All Types', 'miracleisland'),
	                    'parent_item' 		=> __( 'Parent Type', 'miracleisland'),
	                    'parent_item_colon' => __( 'Parent Type', 'miracleisland'),
	                    'edit_item' 		=> __( 'Edit Type', 'miracleisland'),
	                    'update_item' 		=> __( 'Update Type', 'miracleisland'),
	                    'add_new_item' 		=> __( 'Add New Type', 'miracleisland'),
	                    'new_item_name' 	=> __( 'New Type Name', 'miracleisland')
	            	),
					'rewrite' => array(
						'slug' => __('types', 'miracleisland'),
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
	                    'name' 				=> __( 'Gallery Categories', 'miracleisland'),
	                    'singular_name' 	=> __( 'Gallery Category', 'miracleisland'),
						'menu_name'			=> __( 'Categories', 'miracleisland' ),
	                    'search_items' 		=> __( 'Search Gallery Categories', 'miracleisland'),
	                    'all_items' 		=> __( 'All Gallery Categories', 'miracleisland'),
	                    'parent_item' 		=> __( 'Parent Gallery Category', 'miracleisland'),
	                    'parent_item_colon' => __( 'Parent Gallery Category', 'miracleisland'),
	                    'edit_item' 		=> __( 'Edit Gallery Category', 'miracleisland'),
	                    'update_item' 		=> __( 'Update Gallery Category', 'miracleisland'),
	                    'add_new_item' 		=> __( 'Add New Gallery Category', 'miracleisland'),
	                    'new_item_name' 	=> __( 'New Gallery Category Name', 'miracleisland')
	            	),
					'rewrite' => array(
						'slug' => __('categories', 'miracleisland'),
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
				'title' =>  __('Page Options', 'miracleisland'),
				'page' => 'page',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(						
					array(	'name' => __('Page Background','miracleisland'),
							'id' => 'background',
							'type' => 'uploader'),
					
					array(	'name' => __('Tours Destination','miracleisland'),
							'id' => 'tours_destination',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_destination'),
					
					array(	'name' => __('Tours Type','miracleisland'),
							'id' => 'tours_type',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_type'),
							
					array(	'name' => __('Galleries Category','miracleisland'),
							'id' => 'galleries_category',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-gallery-child child-option hidden'),
							'taxonomy' => 'gallery_category'),
				),			
			),	
						
			//Slides
			array(
				'id' => 'slide_metabox',
				'title' =>  __('Slide Options', 'miracleisland'),
				'page' => 'slide',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
				
					array(	'name' => __('Image Link','miracleisland'),
							'desc' => __('Link for the slide image.','miracleisland'),
							'id' => 'link',
							'type' => 'text'),

					array(	'name' => __('Video Code','miracleisland'),
							'desc' => __('Paste embedded video code here.','miracleisland'),
							'id' => 'video',
							'type' => 'textarea'),

				),			
			),			
				
			//Tours
			array(
				'id' => 'tour_metabox',
				'title' =>  __('Tour Options', 'miracleisland'),
				'page' => 'tour',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Price','miracleisland'),
							'desc' => __('Tour minimum price.','miracleisland'),
							'id' => 'price',
							'type' => 'number'),					
					array(	'name' => __('Duration','miracleisland'),
							'desc' => __('Tour duration (days).','miracleisland'),
							'id' => 'duration',
							'type' => 'text'),
					array(	'name' => __('Daparts','miracleisland'),
							'desc' => __('Tour departure date.','miracleisland'),
							'id' => 'departure_date',
							'type' => 'date'),
					array(	'name' => __('Arrives','miracleisland'),
							'desc' => __('Tour arrival date.','miracleisland'),
							'id' => 'arrival_date',
							'type' => 'date'),
					array(	'name' => __('Booking Link','miracleisland'),
							'desc' => __('Link to book the tour.','miracleisland'),
							'id' => 'booking',
							'type' => 'text'),
					array(	'name' => __('Runs On','miracleisland'),
							'desc' => __('List of the week days.','miracleisland'),
							'id' => 'days',
							'type' => 'days'),					
					array(	'name' => __('Gallery Images','miracleisland'),
							'desc' => __('Add images for this tour.','miracleisland'),
							'id' => 'images',
							'type' => 'gallery'),
				),
			),
			
			//Galleries
			array(
				'id' => 'gallery_metabox',
				'title' =>  __('Gallery Options', 'miracleisland'),
				'page' => 'gallery',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Gallery Images','miracleisland'),
							'desc' => __('Add images for this gallery.','miracleisland'),
							'id' => 'images',
							'type' => 'gallery'),
					array(	'name' => __('Video Code','miracleisland'),
							'desc' => __('Paste embedded video code here.','miracleisland'),
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
				'popup_title' => __('Insert Columns Shortcode', 'miracleisland'),
				'child_shortcode' => array(
					'options' => array(
						'column' => array(
							'type' => 'select',
							'label' => __('Column Width', 'miracleisland'),
							'options' => array(
								'one_sixth' => __('One Sixth', 'miracleisland'),
								'one_sixth_last' => __('One Sixth Last', 'miracleisland'),
								'one_fourth' => __('One Fourth', 'miracleisland'),
								'one_fourth_last' => __('One Fourth Last', 'miracleisland'),
								'one_third' => __('One Third', 'miracleisland'),
								'one_third_last' => __('One Third Last', 'miracleisland'),
								'five_twelfths' => __('Five Twelfths', 'miracleisland'),
								'five_twelfths_last' => __('Five Twelfths Last', 'miracleisland'),
								'one_half' => __('One Half', 'miracleisland'),
								'one_half_last' => __('One Half Last', 'miracleisland'),
								'seven_twelfths' => __('Seven Twelfths', 'miracleisland'),
								'seven_twelfths_last' => __('Seven Twelfths Last', 'miracleisland'),
								'two_thirds' => __('Two Thirds', 'miracleisland'),
								'two_thirds_last' => __('Two Thirds Last', 'miracleisland'),
								'three_fourths' => __('Three Fourths', 'miracleisland'),
								'three_fourths_last' => __('Three Fourths Last', 'miracleisland'),
							)
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Column Content', 'miracleisland'),
						)
					),
					'shortcode' => '[{{column}}]{{content}}[/{{column}}] ',
					'clone_button' => __('Add Columns Shortcode', 'miracleisland')
				)
			),
		
			//Block
			'block' => array(
				'options' => array(
					'background' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Block Background', 'miracleisland'),
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Block Content', 'miracleisland'),
					),
				),
				'shortcode' => '[block background="{{background}}"]{{content}}[/block]',			
				'popup_title' => __('Insert Block Shortcode', 'miracleisland')
			),			
			
			//Title
			'title' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Title Text', 'miracleisland'),
					),
				),
				'shortcode' => '[title]{{content}}[/title]',			
				'popup_title' => __('Insert Title Shortcode', 'miracleisland')
			),
			
			//Image
			'image' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Image URL', 'miracleisland'),
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Link URL', 'miracleisland'),
					),					
				),
				'shortcode' => '[image url="{{url}}"]{{content}}[/image]',	
				'popup_title' => __('Insert Image Shortcode', 'miracleisland')
			),
			
			//Button
			'button' => array(
				'options' => array(
					'color' => array(
						'type' => 'select',
						'label' => __('Button Color', 'miracleisland'),
						'options' => array(
							'default' => __('Default', 'miracleisland'),
							'grey' => __('Grey', 'miracleisland'),						
						)
					),
					'size' => array(
						'type' => 'select',
						'label' => __('Button Size', 'miracleisland'),
						'options' => array(
							'small' => __('Small', 'miracleisland'),
							'medium' => __('Medium', 'miracleisland'),
							'large' => __('Large', 'miracleisland')
						)
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button URL', 'miracleisland'),
					),
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button Text', 'miracleisland'),
					)
				),
				'shortcode' => '[button url="{{url}}" size="{{size}}"]{{content}}[/button]',
				'popup_title' => __('Insert Button Shortcode', 'miracleisland')
			),
			
			//Posts
			'posts' => array(
				'options' => array(
					'number' => array(
						'std' => '1',
						'type' => 'text',
						'label' => __('Posts Number', 'miracleisland'),
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Posts Category', 'miracleisland'),
						'taxonomy' => 'category',
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Posts Order', 'miracleisland'),
						'options' => array(
							'date' => __('Date', 'miracleisland'),
							'rand' => __('Random', 'miracleisland'),
						),
					),					
				),
				'shortcode' => '[posts number="{{number}}" order="{{order}}" category="{{category}}"]',		
				'popup_title' => __('Insert Posts Shortcode', 'miracleisland')
			),	
			
			//Tours
			'tours' => array(
				'options' => array(
					'type' => array(
						'type' => 'select_category',
						'label' => __('Tours Type', 'miracleisland'),
						'taxonomy' => 'tour_type',
					),
					'destination' => array(
						'type' => 'select_category',
						'label' => __('Tours Destination', 'miracleisland'),
						'taxonomy' => 'tour_destination',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Tours Number', 'miracleisland'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Tours Order', 'miracleisland'),
						'options' => array(
							'date' => __('Date', 'miracleisland'),
							'title' => __('Title', 'miracleisland'),
							'rand' => __('Random', 'miracleisland'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'miracleisland'),
						'options' => array(
							'3' => __('Three', 'miracleisland'),
							'4' => __('Four', 'miracleisland'),
						)
					),
				),
				'shortcode' => '[tours type="{{type}}" destination="{{destination}}" number="{{number}}" columns="{{columns}}" order="{{order}}"]',		
				'popup_title' => __('Insert Tours Shortcode', 'miracleisland')
			),
			
			//Galleries
			'galleries' => array(
				'options' => array(
					'caption' => array(
						'type' => 'select',
						'label' => __('Gallery Caption', 'miracleisland'),
						'options' => array(
							'visible' => __('Visible', 'miracleisland'),
							'hidden' => __('Hidden', 'miracleisland'),
							'none' => __('None', 'miracleisland'),
						)
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Galleries Category', 'miracleisland'),
						'taxonomy' => 'gallery_category',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Galleries Number', 'miracleisland'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Galleries Order', 'miracleisland'),
						'options' => array(
							'date' => __('Date', 'miracleisland'),
							'rand' => __('Random', 'miracleisland'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'miracleisland'),
						'options' => array(
							'3' => __('Three', 'miracleisland'),
							'4' => __('Four', 'miracleisland'),
						)
					),
				),
				'shortcode' => '[galleries category="{{category}}" number="{{number}}" columns="{{columns}}" order="{{order}}" caption="{{caption}}"]',
				'popup_title' => __('Insert Galleries Shortcode', 'miracleisland')
			),
						
			//Testimonials
			'testimonials' => array(
				'options' => array(
					'number' => array(
						'std' => '3',
						'type' => 'text',
						'label' => __('Testimonials Number', 'miracleisland'),
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Testimonials Order', 'miracleisland'),
						'options' => array(
							'date' => __('Date', 'miracleisland'),
							'rand' => __('Random', 'miracleisland'),
						)
					),
					'pause' => array(
						'std' => '0',
						'type' => 'text',
						'label' => __('Slider Pause', 'miracleisland'),
					),
					'speed' => array(
						'std' => '400',
						'type' => 'text',
						'label' => __('Transition Speed', 'miracleisland'),
					),
				),
				'shortcode' => '[testimonials number="{{number}}" order="{{order}}" pause="{{pause}}" speed="{{speed}}"]',		
				'popup_title' => __('Insert Testimonials Shortcode', 'miracleisland')
			),	
			
			//Itinerary
			'itinerary' => array(
				'options' => array(),
				'shortcode' => '[itinerary]{{child_shortcode}}[/itinerary]',
				'popup_title' => __('Insert Itinerary Shortcode', 'miracleisland'),
				'child_shortcode' => array(					
					'options' => array(
						'title' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Title', 'miracleisland'),
						),
						'image' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Image', 'miracleisland'),
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Day Content', 'miracleisland'),
						)
					),
					'shortcode' => '[day title="{{title}}" image="{{image}}"]{{content}}[/day]',
					'clone_button' => __('Add New Day', 'miracleisland')
				)
			),
			
			//Google Map
			'map' => array(
				'no_preview' => true,
				'options' => array(
					'align' => array(
						'type' => 'select',
						'label' => __('Align', 'miracleisland'),
						'options' => array(
							'none' => __('None', 'miracleisland'),
							'top' => __('Top', 'miracleisland'),
							'bottom' => __('Bottom', 'miracleisland'),
						)
					),
					'latitude' => array(
						'type' => 'text',
						'label' => __('Latitude', 'miracleisland'),
					),
					'longitude' => array(
						'type' => 'text',
						'label' => __('Longitude', 'miracleisland'),
					),
					'zoom' => array(
						'type' => 'text',
						'label' => __('Zoom', 'miracleisland'),
					),
					'height' => array(
						'type' => 'text',
						'std' => '250',
						'label' => __('Height', 'miracleisland'),
					),
					'description' => array(
						'type' => 'textarea',
						'std' => '',
						'label' => __('Description', 'miracleisland'),
					),
				),
				'shortcode' => '[map align="{{align}}" latitude="{{latitude}}" longitude="{{longitude}}" zoom="{{zoom}}" description="{{description}}" height="{{height}}"][/map]',
				'popup_title' => __('Insert Map Shortcode', 'miracleisland')
			),
			
			//Search Form
			'search_form' => array(
				'shortcode' => '[search_form]',
				'popup_title' => __('Insert Search Form Shortcode', 'miracleisland')
			),
			
			//Contact Form
			'contact_form' => array(
				'shortcode' => '[contact_form]',
				'popup_title' => __('Insert Contact Form Shortcode', 'miracleisland')
			),
			
			//Sidebar
			'sidebar' => array(
				'options' => array(
					'name' => array(
						'type' => 'sidebars',
						'label' => __('Name', 'miracleisland'),
					),
				),
				'shortcode' => '[sidebar name="{{name}}"]',
				'popup_title' => __('Insert Sidebar Shortcode', 'miracleisland')
			),
			
			//Tabs
			'tabs' => array(
				'options' => array(
					'type' => array(
							'type' => 'select',
							'label' => __('Tabs Type', 'miracleisland'),
							'options' => array(
								'horizontal' => __('Horizontal', 'miracleisland'),
								'vertical' => __('Vertical', 'miracleisland'),
						)
					),
					'titles' => array(
						'type' => 'text',
						'label' => __('Tab Titles', 'miracleisland'),
						'desc' => __('Enter the comma separated tab titles.', 'miracleisland')
					),		
				),
				'shortcode' => '[tabs type="{{type}}" titles="{{titles}}"]{{child_shortcode}}[/tabs]',
				'popup_title' => __('Insert Tabs Shortcode', 'miracleisland'),
				'child_shortcode' => array(
					'options' => array(
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Tab Content', 'miracleisland'),
						)
					),
					'shortcode' => '[tab]{{content}}[/tab]',
					'clone_button' => __('Add Tab', 'miracleisland')
				)
			),
			
			//Toggle
			'toggle' => array(
				'options' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Toggle Title', 'miracleisland'),
						'std' => ''
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Toggle Content', 'miracleisland'),
					)
					
				),
				'shortcode' => '[toggle title="{{title}}"]{{content}}[/toggle]',
				'popup_title' => __('Insert Toggle Shortcode', 'miracleisland')
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
		array(	'name' => __('General','miracleisland'),
				'type' => 'page'),
				
		array(	'name' => __('Site Favicon','miracleisland'),
				'description' => __('Upload an image for your site favicon.','miracleisland'),
				'id' => 'favicon',
				'type' => 'uploader'),
				
		array(	'name' => __('Site Logo Type','miracleisland'),
				'id' => 'logo_type',
				'options' => array('image' => __('Image','miracleisland'), 'text' => __('Text','miracleisland')),
				'type' => 'select'),
				
		array(	'name' => __('Site Logo Image','miracleisland'),
				'description' => __('Upload an image for your site logo.','miracleisland'),
				'id' => 'logo_image',
				'type' => 'uploader',
				'parent' => array('logo_type','0')),
				
		array(	'name' => __('Site Logo Text','miracleisland'),
				'description' => __('Enter the text for your site logo.','miracleisland'),
				'id' => 'logo_text',
				'type' => 'text',
				'parent' => array('logo_type','1')),
				
		array(	'name' => __('Login Logo Image','miracleisland'),
				'description' => __('Upload an image to show on the login page.','miracleisland'),
				'id' => 'login_logo',
				'type' => 'uploader'),
				
		array(	'name' => __('Date Format','miracleisland'),
				'description' => __('Choose the date format for all post types and comments.','miracleisland'),
				'id' => 'date_format',
				'options' => array(
					'm/d/Y'=>'MM/DD/YY',
					'd/m/Y'=>'DD/MM/YY',						
				),
				'type' => 'select'),
				
		array(	'name' => __('Copyright Text','miracleisland'),
				'description' => __('Enter the copyright text to be displayed in the footer.','miracleisland'),
				'id' => 'copyright_text',
				'default' => '',
				'type' => 'textarea'),
				
		array(	'name' => __('Tracking Code','miracleisland'),
				'description' => __('Add tracking analytics code here.','miracleisland'),
				'id' => 'tracking_code',
				'default' => '',
				'type' => 'textarea'),				
				
		//Styling
		array(	'name' => __('Styling','miracleisland'),
				'type' => 'page'),
				
		array(	'name' => __('Custom CSS','miracleisland'),
				'description' => __('Write CSS rules here to overwrite the default styles.','miracleisland'),
				'default' => '',
				'id' => 'css',
				'type' => 'textarea'),
				
		array(	'name' => __('Primary Theme Color','miracleisland'),
				'default' => '#FF9000',
				'id' => 'primary_color',
				'type' => 'color'),
				
		array(	'name' => __('Secondary Theme Color','miracleisland'),
				'default' => '#FFFFFF',
				'id' => 'secondary_color',
				'type' => 'color'),
				
		array(	'name' => __('Background Type','miracleisland'),
				'id' => 'background_type',
				'options' => array('default' => __('Default','miracleisland'), 'custom' => __('Custom','miracleisland')),
				'description' => __('Choose from the default patterns or upload your own image.','miracleisland'),
				'type' => 'select'),
				
		array(	'name' => __('Background Pattern','miracleisland'),
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
				
		array(	'name' => __('Background Image','miracleisland'),
				'id' => 'background_image',
				'type' => 'uploader',
				'parent' => array('background_type','1')),
				
		array(	'name' => __('Tiled Background','miracleisland'),
					'id' => 'background_fullwidth',
					'description' => __('Check this to use tiled background instead of full width image.','miracleisland'),
					'type' => 'checkbox'),
					
		array(	'name' => __('Heading Font','miracleisland'),					
				'id' => 'heading_font',
				'default' => 'Signika',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		array(	'name' => __('Content Font','miracleisland'),
				'id' => 'content_font',
				'default' => 'Open Sans',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		//Header
		array(	'name' => __('Header','miracleisland'),
				'type' => 'page'),
				
			array(	'name' => __('Header Layout','miracleisland'),
				'id' => 'header_layout',
				'options' => array(
					'separated'=>THEMEX_URI.'admin/images/layouts/7.png',
					'fullwidth'=>THEMEX_URI.'admin/images/layouts/8.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Header Text','miracleisland'),
				'description' => __('Enter the text to be displayed at the social links.','miracleisland'),
				'id' => 'header_text',
				'default' => '',
				'type' => 'textarea'),
				
			array(	'name' => __('Slider','miracleisland'),
				'type' => 'section'),
				
				array(	'name' => __('Slider Type','miracleisland'),
					'id' => 'slider_type',
					'options' => array('fade' => __('Fade Slider','miracleisland'), 'motion' => __('Motion Slider','miracleisland')),
					'type' => 'select'),
					
			array(	'name' => __('Slider Pause','miracleisland'),
					'default' => '0',
					'id' => 'slider_pause',
					'attributes' => array('min_value' => '0', 'max_value' => '20000', 'unit' => 'ms'),
					'type' => 'slider'),
					
			array(	'name' => __('Transition Speed','miracleisland'),
					'default' => '400',
					'id' => 'slider_speed',
					'attributes' => array('min_value' => '100', 'max_value' => '1000', 'unit' => 'ms'),
					'type' => 'slider'),
				
			array(	'name' => __('Social Links','miracleisland'),
				'type' => 'section'),
				
			array(	'name' => __('RSS Link','miracleisland'),
					'id' => 'rss_link',
					'type' => 'text'),
					
			array(	'name' => __('Facebook Link','miracleisland'),
					'id' => 'facebook_link',
					'type' => 'text'),
					
			array(	'name' => __('Twitter Link','miracleisland'),
					'id' => 'twitter_link',
					'type' => 'text'),
					
			array(	'name' => __('Google Link','miracleisland'),
					'id' => 'google_link',
					'type' => 'text'),

			array(	'name' => __('Flickr Link','miracleisland'),
					'id' => 'flickr_link',
					'type' => 'text'),
					
			array(	'name' => __('Tumblr Link','miracleisland'),
					'id' => 'tumblr_link',
					'type' => 'text'),

			array(	'name' => __('LinkedIn Link','miracleisland'),
					'id' => 'linkedin_link',
					'type' => 'text'),		
					
			array(	'name' => __('YouTube Link','miracleisland'),
					'id' => 'youtube_link',
					'type' => 'text'),
					
			array(	'name' => __('Vimeo Link','miracleisland'),
					'id' => 'vimeo_link',
					'type' => 'text'),
					
			array(	'name' => __('Skype Link','miracleisland'),
					'id' => 'skype_link',
					'type' => 'text'),
					
			array(	'name' => __('Blogger Link','miracleisland'),
					'id' => 'blogger_link',
					'type' => 'text'),
					
			array(	'name' => __('StumbleUpon Link','miracleisland'),
					'id' => 'stumbleupon_link',
					'type' => 'text'),			
					
		//Tours
		array(	'name' => __('Tours','miracleisland'),
				'type' => 'page'),
				
			array(	'name' => __('Tours Layout','miracleisland'),
				'id' => 'tours_layout',
				'options' => array(
					'right'=>THEMEX_URI.'admin/images/layouts/3.png',
					'left'=>THEMEX_URI.'admin/images/layouts/2.png',									
					'fullwidth'=>THEMEX_URI.'admin/images/layouts/1.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Tours View','miracleisland'),
					'id' => 'tours_view',
					'options' => array('grid' => __('Grid','miracleisland'), 'list' => __('List','miracleisland')),
					'type' => 'select'),
					
			array(	'name' => __('Tours Per Page','miracleisland'),
				'id' => 'tours_limit',
				'default' => '12',
				'type' => 'number'),
				
			array(	'name' => __('Price Currency','miracleisland'),
					'id' => 'tours_currency',
					'default' => '$',
					'description' => __('Set price currency symbol.','miracleisland'),
					'type' => 'text'),
					
			array(	'name' => __('Currency Position','miracleisland'),
					'id' => 'tours_currency_position',
					'options' => array('left' => __('Left','miracleisland'), 'right' => __('Right','miracleisland')),
					'type' => 'select'),			
				
			array(	'name' => __('Related Tours Order','miracleisland'),
					'id' => 'tours_related_order',
					'options' => array(
						'rand' => __('Random','miracleisland'), 
						'type' => __('Type','miracleisland'), 'destination' => __('Destination','miracleisland')
					),
					'type' => 'select'),
					
			array(	'name' => __('Hide Related Tours','miracleisland'),
					'id' => 'tours_related',
					'type' => 'checkbox'),

			array(	'name' => __('Disable Booking','miracleisland'),
					'id' => 'tours_booking',
					'description' => __('Check this to disable booking form.','miracleisland'),
					'type' => 'checkbox'),
					
			array(	'name' => __('Disable Questions','miracleisland'),
					'id' => 'tours_questions',
					'description' => __('Check this to disable question form.','miracleisland'),
					'type' => 'checkbox'),
					
		//Gallery
		array(	'name' => __('Galleries','miracleisland'),
				'type' => 'page'),
				
				array(	'name' => __('Galleries Layout','miracleisland'),
				'id' => 'galleries_layout',
				'options' => array(
					'four'=>THEMEX_URI.'admin/images/layouts/5.png',
					'three'=>THEMEX_URI.'admin/images/layouts/6.png',
				),
				'type' => 'select_image'),
				
				array(	'name' => __('Galleries Per Page','miracleisland'),
				'id' => 'galleries_limit',
				'default' => '12',
				'type' => 'number'),
				
				array(	'name' => __('Galleries Caption','miracleisland'),
					'id' => 'galleries_caption',
					'options' => array(
						'visible' => __('Visible', 'miracleisland'),
						'hidden' => __('Hidden', 'miracleisland'),
						'none' => __('None', 'miracleisland'),
					),
					'type' => 'select'),
				
		//Search Form
		array(	'name' => __('Search Form','miracleisland'),
				'type' => 'page'),
				
			array(	'name' => __('Form Title','miracleisland'),
					'id' => 'search_form_title',
					'default' => '',
					'type' => 'text'),
				
			array(	'name' => __('Hide Destination Field','miracleisland'),
					'id' => 'search_form_destination',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Type Field','miracleisland'),
					'id' => 'search_form_type',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Date Fields','miracleisland'),
					'id' => 'search_form_date',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Price Field','miracleisland'),
					'id' => 'search_form_price',
					'type' => 'checkbox'),
					
		//Booking Payments
		array(	'name' => __('Booking Payment','miracleisland'),
				'type' => 'page'),
				
			array(	'name' => __('Enable Booking Payment','miracleisland'),
						'id' => 'booking_payment',
						'type' => 'checkbox'),				
				
			array(	'name' => __('Payment Language','miracleisland'),
				'id' => 'booking_language',
				'options' => array(
					'AU' => __('Australian','miracleisland'), 
					'CN' => __('Chinese','miracleisland'),
					'EN' => __('English','miracleisland'), 
					'FR' => __('French','miracleisland'),
					'DE' => __('German','miracleisland'), 
					'IT' => __('Italian','miracleisland'),
					'JP' => __('Japanese','miracleisland'), 
					'PL' => __('Polish','miracleisland'),
					'ES' => __('Spanish','miracleisland'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Currency','miracleisland'),
				'id' => 'booking_currency',
				'options' => array(
					'AUD' => __('Australian Dollar','miracleisland'), 
					'CAD' => __('Canadian Dollar','miracleisland'),
					'EUR' => __('Euro','miracleisland'),
					'GBP' => __('British Pound','miracleisland'),
					'JPY' => __('Japanese Yen','miracleisland'), 
					'USD' => __('United States Dollar','miracleisland'),
					'NZD' => __('New Zealand Dollar','miracleisland'),
					'CHF' => __('Swiss Franc','miracleisland'),
					'HKD' => __('Hong Kong Dollar','miracleisland'),
					'SGD' => __('Singapore Dollar','miracleisland'),
					'SEK' => __('Swedish Krona','miracleisland'),
					'DKK' => __('Danish Krone','miracleisland'),
					'PLN' => __('Polish Zloty','miracleisland'),
					'NOK' => __('Norwegian Krone','miracleisland'),
					'HUF' => __('Hungarian Forint','miracleisland'),
					'CZK' => __('Czech Koruna','miracleisland'),
					'ILS' => __('Israeli Shekel','miracleisland'),
					'MXN' => __('Mexican Peso','miracleisland'),
					'BRL' => __('Brazilian Real','miracleisland'),
					'MYR' => __('Malaysian Ringgit','miracleisland'),
					'PHP' => __('Philippine Peso','miracleisland'),
					'TWD' => __('New Taiwan Dollar','miracleisland'),
					'THB' => __('Thai Baht','miracleisland'),
					'TRY' => __('Turkish Lira','miracleisland'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Amount','miracleisland'),
				'id' => 'booking_price',
				'default' => '0',
				'description' => __('Enter in the booking fee amount.','miracleisland'),
				'type' => 'number'),
				
			array(	'name' => __('PayPal Account','miracleisland'),
				'id' => 'booking_email',
				'default' => '',
				'description' => __('Enter in your PayPal account email address.','miracleisland'),
				'type' => 'text'),
			
		//Booking Form
		array(	'name' => __('Booking Form','miracleisland'),
				'type' => 'page'),	

			array(	'type' => 'themex_form',
					'id' => 'booking_form' ),			
					
		//Question Form
		array(	'name' => __('Question Form','miracleisland'),
				'type' => 'page'),
				
			array(	'type' => 'themex_form',
					'id' => 'question_form' ),
		
		//Contact Form
		array(	'name' => __('Contact Form','miracleisland'),
				'type' => 'page'),
				
			array(	'type' => 'themex_form',
					'id' => 'contact_form' ),	

		//Custom Sidebars
		array(	'name' => __('Sidebars','miracleisland'),
				'type' => 'page'),
				
			array(	'type' => 'themex_widgetiser',
					'id' => 'themex_widgetiser' ),
				
		//Mailing List
		array(	'name' => __('Mailing List','miracleisland'),
				'type' => 'page'),
				
			array(	'name' => '',
					'id' => 'mailing_list',
					'default' => '',
					'description' => __('This is the list of subcribers from Newsletter Widget.','miracleisland'),
					'type' => 'textarea'),
	),

);
?>
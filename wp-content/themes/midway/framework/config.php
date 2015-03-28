<?php
//Theme configuration
$config = array (

	//Modules
	'modules' => array(

		//base modules
		'interface' => 'ThemexInterface',
		
		//additional
		'Themex_widgetiser' => 'ThemexWidgetiser',
		'Themex_form' => 'ThemexForm',
		'Themex_shortcoder' => 'ThemexShortcoder',
		'Themex_styler' => 'ThemexStyler',
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
				'slug' => 'Travel2',
				'path' => THEME_PATH.'languages',
			),			
		),
		
		//Editor styles
		'editor_styles' => array(
			'styled-list list-1'=>__('List Style','Travel2').' 1',
			'styled-list list-2'=>__('List Style','Travel2').' 2',
			'styled-list list-3'=>__('List Style','Travel2').' 3',
			'styled-list list-4'=>__('List Style','Travel2').' 4',
			'styled-list list-5'=>__('List Style','Travel2').' 5',
		),
	
		//Menus
		'custom_menus' => array (
			array(
				'slug' => 'main_menu',
				'name' => __('Main Menu','Travel2'),
			),
			
			array(
				'slug' => 'footer_menu',
				'name' => __('Footer Menu','Travel2'),
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
			array(	'name' => 'Themex_admin',
					'uri' => Themex_URI.'admin/css/style.css'),
		
			//color picker
			array(	'name' => 'Themex_colorpicker',
					'uri' => Themex_URI.'admin/css/colorpicker.css'),
					
			//date picker
			array(	'name' => 'jquery-ui-datepicker',
					'uri' => Themex_URI.'admin/css/datepicker.css'),
					
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
			array(	'name' => 'Themex_admin',
					'uri' => Themex_URI.'admin/js/jquery.interface.js',
					'deps' => array('jquery')),
					
			//color picker
			array(	'name' => 'Themex_colorpicker',
					'uri' => Themex_URI.'admin/js/jquery.colorpicker.js',
					'deps' => array('jquery')),
					
			//shortcodes popup
			array(	'name' => 'Themex_shortcode_popup',
					'uri' => Themex_URI.'extensions/Themex-shortcoder/js/popup.js',
					'deps' => array('jquery')),
					
			//shortcodes preview
			array(	'name' => 'Themex_livequery',
					'uri' => Themex_URI.'extensions/Themex-shortcoder/js/jquery.livequery.js',
					'deps' => array('jquery')),
					
			//shortcodes cloner
			array(	'name' => 'Themex_appendo',
				'uri' => Themex_URI.'extensions/Themex-shortcoder/js/jquery.appendo.js',
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
		'widgets' => array ('Themex_subscribe_widget', 'Themex_posts_widget', 'Themex_twitter_widget'),
		
		//Post types
		'post_types' => array (
			
			//Tour
			array (
				'id' => 'tour',
				'labels' => array (
					'name' => __('Tours','Travel2'),
					'singular_name' => __( 'Tour','Travel2' ),
					'add_new' => __('Add New','Travel2'),
					'add_new_item' => __('Add New Tour','Travel2'),
					'edit_item' => __('Edit Tour','Travel2'),
					'new_item' => __('New Tour','Travel2'),
					'view_item' => __('View Tour','Travel2'),
					'search_items' => __('Search Tours','Travel2'),
					'not_found' =>  __('No Tours Found','Travel2'),
					'not_found_in_trash' => __('No Tours Found in Trash','Travel2'), 
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
				'rewrite' => array('slug' => __('tour', 'Travel2')),
			),
			
			//Gallery
			array (
				'id' => 'gallery',
				'labels' => array (
					'name' => __('Galleries','Travel2'),
					'singular_name' => __( 'Gallery','Travel2' ),
					'add_new' => __('Add New','Travel2'),
					'add_new_item' => __('Add New Gallery','Travel2'),
					'edit_item' => __('Edit Gallery','Travel2'),
					'new_item' => __('New Gallery','Travel2'),
					'view_item' => __('View Gallery','Travel2'),
					'search_items' => __('Search Galleries','Travel2'),
					'not_found' =>  __('No Galleries Found','Travel2'),
					'not_found_in_trash' => __('No Galleries Found in Trash','Travel2'), 
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
				'rewrite' => array('slug' => __('gallery', 'Travel2')),
			),
			
			//Testimonial
			array (
				'id' => 'testimonial',
				'labels' => array (
					'name' => __('Testimonials','Travel2'),
					'singular_name' => __( 'Testimonial','Travel2' ),
					'add_new' => __('Add New','Travel2'),
					'add_new_item' => __('Add New Testimonial','Travel2'),
					'edit_item' => __('Edit Testimonial','Travel2'),
					'new_item' => __('New Testimonial','Travel2'),
					'view_item' => __('View Testimonial','Travel2'),
					'search_items' => __('Search Testimonials','Travel2'),
					'not_found' =>  __('No Testimonials Found','Travel2'),
					'not_found_in_trash' => __('No Testimonials Found in Trash','Travel2'),
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
					'name' => __('Slides','Travel2'),
					'singular_name' => __( 'Slide','Travel2' ),
					'add_new' => __('Add New','Travel2'),
					'add_new_item' => __('Add New Slide','Travel2'),
					'edit_item' => __('Edit Slide','Travel2'),
					'new_item' => __('New Slide','Travel2'),
					'view_item' => __('View Slide','Travel2'),
					'search_items' => __('Search Slides','Travel2'),
					'not_found' =>  __('No Slides Found','Travel2'),
					'not_found_in_trash' => __('No Slides Found in Trash','Travel2'), 
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
	                    'name' 				=> __( 'Destinations', 'Travel2'),
	                    'singular_name' 	=> __( 'Destination', 'Travel2'),
						'menu_name'			=> __( 'Destinations', 'Travel2' ),
	                    'search_items' 		=> __( 'Search Destinations', 'Travel2'),
	                    'all_items' 		=> __( 'All Destinations', 'Travel2'),
	                    'parent_item' 		=> __( 'Parent Destination', 'Travel2'),
	                    'parent_item_colon' => __( 'Parent Destination', 'Travel2'),
	                    'edit_item' 		=> __( 'Edit Destination', 'Travel2'),
	                    'update_item' 		=> __( 'Update Destination', 'Travel2'),
	                    'add_new_item' 		=> __( 'Add New Destination', 'Travel2'),
	                    'new_item_name' 	=> __( 'New Destination Name', 'Travel2')
	            	),
					'rewrite' => array(
						'slug' => __('destinations', 'Travel2'),
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
	                    'name' 				=> __( 'Types', 'Travel2'),
	                    'singular_name' 	=> __( 'Type', 'Travel2'),
						'menu_name'			=> __( 'Types', 'Travel2' ),
	                    'search_items' 		=> __( 'Search Types', 'Travel2'),
	                    'all_items' 		=> __( 'All Types', 'Travel2'),
	                    'parent_item' 		=> __( 'Parent Type', 'Travel2'),
	                    'parent_item_colon' => __( 'Parent Type', 'Travel2'),
	                    'edit_item' 		=> __( 'Edit Type', 'Travel2'),
	                    'update_item' 		=> __( 'Update Type', 'Travel2'),
	                    'add_new_item' 		=> __( 'Add New Type', 'Travel2'),
	                    'new_item_name' 	=> __( 'New Type Name', 'Travel2')
	            	),
					'rewrite' => array(
						'slug' => __('types', 'Travel2'),
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
	                    'name' 				=> __( 'Gallery Categories', 'Travel2'),
	                    'singular_name' 	=> __( 'Gallery Category', 'Travel2'),
						'menu_name'			=> __( 'Categories', 'Travel2' ),
	                    'search_items' 		=> __( 'Search Gallery Categories', 'Travel2'),
	                    'all_items' 		=> __( 'All Gallery Categories', 'Travel2'),
	                    'parent_item' 		=> __( 'Parent Gallery Category', 'Travel2'),
	                    'parent_item_colon' => __( 'Parent Gallery Category', 'Travel2'),
	                    'edit_item' 		=> __( 'Edit Gallery Category', 'Travel2'),
	                    'update_item' 		=> __( 'Update Gallery Category', 'Travel2'),
	                    'add_new_item' 		=> __( 'Add New Gallery Category', 'Travel2'),
	                    'new_item_name' 	=> __( 'New Gallery Category Name', 'Travel2')
	            	),
					'rewrite' => array(
						'slug' => __('categories', 'Travel2'),
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
				'title' =>  __('Page Options', 'Travel2'),
				'page' => 'page',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(						
					array(	'name' => __('Page Background','Travel2'),
							'id' => 'background',
							'type' => 'uploader'),
					
					array(	'name' => __('Tours Destination','Travel2'),
							'id' => 'tours_destination',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_destination'),
					
					array(	'name' => __('Tours Type','Travel2'),
							'id' => 'tours_type',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-tours-child child-option hidden'),
							'taxonomy' => 'tour_type'),
							
					array(	'name' => __('Galleries Category','Travel2'),
							'id' => 'galleries_category',
							'type' => 'select_category',
							'attributes' => array('class'=>'template-gallery-child child-option hidden'),
							'taxonomy' => 'gallery_category'),
				),			
			),	
						
			//Slides
			array(
				'id' => 'slide_metabox',
				'title' =>  __('Slide Options', 'Travel2'),
				'page' => 'slide',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
				
					array(	'name' => __('Image Link','Travel2'),
							'desc' => __('Link for the slide image.','Travel2'),
							'id' => 'link',
							'type' => 'text'),

					array(	'name' => __('Video Code','Travel2'),
							'desc' => __('Paste embedded video code here.','Travel2'),
							'id' => 'video',
							'type' => 'textarea'),

				),			
			),			
				
			//Tours
			array(
				'id' => 'tour_metabox',
				'title' =>  __('Tour Options', 'Travel2'),
				'page' => 'tour',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Price','Travel2'),
							'desc' => __('Tour minimum price.','Travel2'),
							'id' => 'price',
							'type' => 'number'),					
					array(	'name' => __('Duration','Travel2'),
							'desc' => __('Tour duration (days).','Travel2'),
							'id' => 'duration',
							'type' => 'text'),
					array(	'name' => __('Daparts','Travel2'),
							'desc' => __('Tour departure date.','Travel2'),
							'id' => 'departure_date',
							'type' => 'date'),
					array(	'name' => __('Arrives','Travel2'),
							'desc' => __('Tour arrival date.','Travel2'),
							'id' => 'arrival_date',
							'type' => 'date'),
					array(	'name' => __('Booking Link','Travel2'),
							'desc' => __('Link to book the tour.','Travel2'),
							'id' => 'booking',
							'type' => 'text'),
					array(	'name' => __('Runs On','Travel2'),
							'desc' => __('List of the week days.','Travel2'),
							'id' => 'days',
							'type' => 'days'),					
					array(	'name' => __('Gallery Images','Travel2'),
							'desc' => __('Add images for this tour.','Travel2'),
							'id' => 'images',
							'type' => 'gallery'),
				),
			),
			
			//Galleries
			array(
				'id' => 'gallery_metabox',
				'title' =>  __('Gallery Options', 'Travel2'),
				'page' => 'gallery',
				'context' => 'normal',
				'priority' => 'high',				
				'options' => array(
					array(	'name' => __('Gallery Images','Travel2'),
							'desc' => __('Add images for this gallery.','Travel2'),
							'id' => 'images',
							'type' => 'gallery'),
					array(	'name' => __('Video Code','Travel2'),
							'desc' => __('Paste embedded video code here.','Travel2'),
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
				'popup_title' => __('Insert Columns Shortcode', 'Travel2'),
				'child_shortcode' => array(
					'options' => array(
						'column' => array(
							'type' => 'select',
							'label' => __('Column Width', 'Travel2'),
							'options' => array(
								'one_sixth' => __('One Sixth', 'Travel2'),
								'one_sixth_last' => __('One Sixth Last', 'Travel2'),
								'one_fourth' => __('One Fourth', 'Travel2'),
								'one_fourth_last' => __('One Fourth Last', 'Travel2'),
								'one_third' => __('One Third', 'Travel2'),
								'one_third_last' => __('One Third Last', 'Travel2'),
								'five_twelfths' => __('Five Twelfths', 'Travel2'),
								'five_twelfths_last' => __('Five Twelfths Last', 'Travel2'),
								'one_half' => __('One Half', 'Travel2'),
								'one_half_last' => __('One Half Last', 'Travel2'),
								'seven_twelfths' => __('Seven Twelfths', 'Travel2'),
								'seven_twelfths_last' => __('Seven Twelfths Last', 'Travel2'),
								'two_thirds' => __('Two Thirds', 'Travel2'),
								'two_thirds_last' => __('Two Thirds Last', 'Travel2'),
								'three_fourths' => __('Three Fourths', 'Travel2'),
								'three_fourths_last' => __('Three Fourths Last', 'Travel2'),
							)
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Column Content', 'Travel2'),
						)
					),
					'shortcode' => '[{{column}}]{{content}}[/{{column}}] ',
					'clone_button' => __('Add Columns Shortcode', 'Travel2')
				)
			),
		
			//Block
			'block' => array(
				'options' => array(
					'background' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Block Background', 'Travel2'),
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Block Content', 'Travel2'),
					),
				),
				'shortcode' => '[block background="{{background}}"]{{content}}[/block]',			
				'popup_title' => __('Insert Block Shortcode', 'Travel2')
			),			
			
			//Title
			'title' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Title Text', 'Travel2'),
					),
				),
				'shortcode' => '[title]{{content}}[/title]',			
				'popup_title' => __('Insert Title Shortcode', 'Travel2')
			),
			
			//Image
			'image' => array(
				'options' => array(
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Image URL', 'Travel2'),
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Link URL', 'Travel2'),
					),					
				),
				'shortcode' => '[image url="{{url}}"]{{content}}[/image]',	
				'popup_title' => __('Insert Image Shortcode', 'Travel2')
			),
			
			//Button
			'button' => array(
				'options' => array(
					'color' => array(
						'type' => 'select',
						'label' => __('Button Color', 'Travel2'),
						'options' => array(
							'default' => __('Default', 'Travel2'),
							'grey' => __('Grey', 'Travel2'),						
						)
					),
					'size' => array(
						'type' => 'select',
						'label' => __('Button Size', 'Travel2'),
						'options' => array(
							'small' => __('Small', 'Travel2'),
							'medium' => __('Medium', 'Travel2'),
							'large' => __('Large', 'Travel2')
						)
					),
					'url' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button URL', 'Travel2'),
					),
					'content' => array(
						'std' => '',
						'type' => 'text',
						'label' => __('Button Text', 'Travel2'),
					)
				),
				'shortcode' => '[button url="{{url}}" size="{{size}}"]{{content}}[/button]',
				'popup_title' => __('Insert Button Shortcode', 'Travel2')
			),
			
			//Posts
			'posts' => array(
				'options' => array(
					'number' => array(
						'std' => '1',
						'type' => 'text',
						'label' => __('Posts Number', 'Travel2'),
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Posts Category', 'Travel2'),
						'taxonomy' => 'category',
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Posts Order', 'Travel2'),
						'options' => array(
							'date' => __('Date', 'Travel2'),
							'rand' => __('Random', 'Travel2'),
						),
					),					
				),
				'shortcode' => '[posts number="{{number}}" order="{{order}}" category="{{category}}"]',		
				'popup_title' => __('Insert Posts Shortcode', 'Travel2')
			),	
			
			//Tours
			'tours' => array(
				'options' => array(
					'type' => array(
						'type' => 'select_category',
						'label' => __('Tours Type', 'Travel2'),
						'taxonomy' => 'tour_type',
					),
					'destination' => array(
						'type' => 'select_category',
						'label' => __('Tours Destination', 'Travel2'),
						'taxonomy' => 'tour_destination',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Tours Number', 'Travel2'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Tours Order', 'Travel2'),
						'options' => array(
							'date' => __('Date', 'Travel2'),
							'title' => __('Title', 'Travel2'),
							'rand' => __('Random', 'Travel2'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'Travel2'),
						'options' => array(
							'3' => __('Three', 'Travel2'),
							'4' => __('Four', 'Travel2'),
						)
					),
				),
				'shortcode' => '[tours type="{{type}}" destination="{{destination}}" number="{{number}}" columns="{{columns}}" order="{{order}}"]',		
				'popup_title' => __('Insert Tours Shortcode', 'Travel2')
			),
			
			//Galleries
			'galleries' => array(
				'options' => array(
					'caption' => array(
						'type' => 'select',
						'label' => __('Gallery Caption', 'Travel2'),
						'options' => array(
							'visible' => __('Visible', 'Travel2'),
							'hidden' => __('Hidden', 'Travel2'),
							'none' => __('None', 'Travel2'),
						)
					),
					'category' => array(
						'type' => 'select_category',
						'label' => __('Galleries Category', 'Travel2'),
						'taxonomy' => 'gallery_category',
					),
					'number' => array(
						'std' => '4',
						'type' => 'text',
						'label' => __('Galleries Number', 'Travel2'),
					),					
					'order' => array(
						'type' => 'select',
						'label' => __('Galleries Order', 'Travel2'),
						'options' => array(
							'date' => __('Date', 'Travel2'),
							'rand' => __('Random', 'Travel2'),
						)
					),
					'columns' => array(
						'type' => 'select',
						'label' => __('Columns Number', 'Travel2'),
						'options' => array(
							'3' => __('Three', 'Travel2'),
							'4' => __('Four', 'Travel2'),
						)
					),
				),
				'shortcode' => '[galleries category="{{category}}" number="{{number}}" columns="{{columns}}" order="{{order}}" caption="{{caption}}"]',
				'popup_title' => __('Insert Galleries Shortcode', 'Travel2')
			),
						
			//Testimonials
			'testimonials' => array(
				'options' => array(
					'number' => array(
						'std' => '3',
						'type' => 'text',
						'label' => __('Testimonials Number', 'Travel2'),
					),
					'order' => array(
						'type' => 'select',
						'label' => __('Testimonials Order', 'Travel2'),
						'options' => array(
							'date' => __('Date', 'Travel2'),
							'rand' => __('Random', 'Travel2'),
						)
					),
					'pause' => array(
						'std' => '0',
						'type' => 'text',
						'label' => __('Slider Pause', 'Travel2'),
					),
					'speed' => array(
						'std' => '400',
						'type' => 'text',
						'label' => __('Transition Speed', 'Travel2'),
					),
				),
				'shortcode' => '[testimonials number="{{number}}" order="{{order}}" pause="{{pause}}" speed="{{speed}}"]',		
				'popup_title' => __('Insert Testimonials Shortcode', 'Travel2')
			),	
			
			//Itinerary
			'itinerary' => array(
				'options' => array(),
				'shortcode' => '[itinerary]{{child_shortcode}}[/itinerary]',
				'popup_title' => __('Insert Itinerary Shortcode', 'Travel2'),
				'child_shortcode' => array(					
					'options' => array(
						'title' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Title', 'Travel2'),
						),
						'image' => array(
							'std' => '',
							'type' => 'text',
							'label' => __('Day Image', 'Travel2'),
						),
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Day Content', 'Travel2'),
						)
					),
					'shortcode' => '[day title="{{title}}" image="{{image}}"]{{content}}[/day]',
					'clone_button' => __('Add New Day', 'Travel2')
				)
			),
			
			//Google Map
			'map' => array(
				'no_preview' => true,
				'options' => array(
					'align' => array(
						'type' => 'select',
						'label' => __('Align', 'Travel2'),
						'options' => array(
							'none' => __('None', 'Travel2'),
							'top' => __('Top', 'Travel2'),
							'bottom' => __('Bottom', 'Travel2'),
						)
					),
					'latitude' => array(
						'type' => 'text',
						'label' => __('Latitude', 'Travel2'),
					),
					'longitude' => array(
						'type' => 'text',
						'label' => __('Longitude', 'Travel2'),
					),
					'zoom' => array(
						'type' => 'text',
						'label' => __('Zoom', 'Travel2'),
					),
					'height' => array(
						'type' => 'text',
						'std' => '250',
						'label' => __('Height', 'Travel2'),
					),
					'description' => array(
						'type' => 'textarea',
						'std' => '',
						'label' => __('Description', 'Travel2'),
					),
				),
				'shortcode' => '[map align="{{align}}" latitude="{{latitude}}" longitude="{{longitude}}" zoom="{{zoom}}" description="{{description}}" height="{{height}}"][/map]',
				'popup_title' => __('Insert Map Shortcode', 'Travel2')
			),
			
			//Search Form
			'search_form' => array(
				'shortcode' => '[search_form]',
				'popup_title' => __('Insert Search Form Shortcode', 'Travel2')
			),
			
			//Contact Form
			'contact_form' => array(
				'shortcode' => '[contact_form]',
				'popup_title' => __('Insert Contact Form Shortcode', 'Travel2')
			),
			
			//Sidebar
			'sidebar' => array(
				'options' => array(
					'name' => array(
						'type' => 'sidebars',
						'label' => __('Name', 'Travel2'),
					),
				),
				'shortcode' => '[sidebar name="{{name}}"]',
				'popup_title' => __('Insert Sidebar Shortcode', 'Travel2')
			),
			
			//Tabs
			'tabs' => array(
				'options' => array(
					'type' => array(
							'type' => 'select',
							'label' => __('Tabs Type', 'Travel2'),
							'options' => array(
								'horizontal' => __('Horizontal', 'Travel2'),
								'vertical' => __('Vertical', 'Travel2'),
						)
					),
					'titles' => array(
						'type' => 'text',
						'label' => __('Tab Titles', 'Travel2'),
						'desc' => __('Enter the comma separated tab titles.', 'Travel2')
					),		
				),
				'shortcode' => '[tabs type="{{type}}" titles="{{titles}}"]{{child_shortcode}}[/tabs]',
				'popup_title' => __('Insert Tabs Shortcode', 'Travel2'),
				'child_shortcode' => array(
					'options' => array(
						'content' => array(
							'std' => '',
							'type' => 'textarea',
							'label' => __('Tab Content', 'Travel2'),
						)
					),
					'shortcode' => '[tab]{{content}}[/tab]',
					'clone_button' => __('Add Tab', 'Travel2')
				)
			),
			
			//Toggle
			'toggle' => array(
				'options' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Toggle Title', 'Travel2'),
						'std' => ''
					),
					'content' => array(
						'std' => '',
						'type' => 'textarea',
						'label' => __('Toggle Content', 'Travel2'),
					)
					
				),
				'shortcode' => '[toggle title="{{title}}"]{{content}}[/toggle]',
				'popup_title' => __('Insert Toggle Shortcode', 'Travel2')
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
		array(	'name' => __('General','Travel2'),
				'type' => 'page'),
				
		array(	'name' => __('Site Favicon','Travel2'),
				'description' => __('Upload an image for your site favicon.','Travel2'),
				'id' => 'favicon',
				'type' => 'uploader'),
				
		array(	'name' => __('Site Logo Type','Travel2'),
				'id' => 'logo_type',
				'options' => array('image' => __('Image','Travel2'), 'text' => __('Text','Travel2')),
				'type' => 'select'),
				
		array(	'name' => __('Site Logo Image','Travel2'),
				'description' => __('Upload an image for your site logo.','Travel2'),
				'id' => 'logo_image',
				'type' => 'uploader',
				'parent' => array('logo_type','0')),
				
		array(	'name' => __('Site Logo Text','Travel2'),
				'description' => __('Enter the text for your site logo.','Travel2'),
				'id' => 'logo_text',
				'type' => 'text',
				'parent' => array('logo_type','1')),
				
		array(	'name' => __('Login Logo Image','Travel2'),
				'description' => __('Upload an image to show on the login page.','Travel2'),
				'id' => 'login_logo',
				'type' => 'uploader'),
				
		array(	'name' => __('Date Format','Travel2'),
				'description' => __('Choose the date format for all post types and comments.','Travel2'),
				'id' => 'date_format',
				'options' => array(
					'm/d/Y'=>'MM/DD/YY',
					'd/m/Y'=>'DD/MM/YY',						
				),
				'type' => 'select'),
				
		array(	'name' => __('Copyright Text','Travel2'),
				'description' => __('Enter the copyright text to be displayed in the footer.','Travel2'),
				'id' => 'copyright_text',
				'default' => '',
				'type' => 'textarea'),
				
		array(	'name' => __('Tracking Code','Travel2'),
				'description' => __('Add tracking analytics code here.','Travel2'),
				'id' => 'tracking_code',
				'default' => '',
				'type' => 'textarea'),				
				
		//Styling
		array(	'name' => __('Styling','Travel2'),
				'type' => 'page'),
				
		array(	'name' => __('Custom CSS','Travel2'),
				'description' => __('Write CSS rules here to overwrite the default styles.','Travel2'),
				'default' => '',
				'id' => 'css',
				'type' => 'textarea'),
				
		array(	'name' => __('Primary Theme Color','Travel2'),
				'default' => '#FF9000',
				'id' => 'primary_color',
				'type' => 'color'),
				
		array(	'name' => __('Secondary Theme Color','Travel2'),
				'default' => '#FFFFFF',
				'id' => 'secondary_color',
				'type' => 'color'),
				
		array(	'name' => __('Background Type','Travel2'),
				'id' => 'background_type',
				'options' => array('default' => __('Default','Travel2'), 'custom' => __('Custom','Travel2')),
				'description' => __('Choose from the default patterns or upload your own image.','Travel2'),
				'type' => 'select'),
				
		array(	'name' => __('Background Pattern','Travel2'),
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
				
		array(	'name' => __('Background Image','Travel2'),
				'id' => 'background_image',
				'type' => 'uploader',
				'parent' => array('background_type','1')),
				
		array(	'name' => __('Tiled Background','Travel2'),
					'id' => 'background_fullwidth',
					'description' => __('Check this to use tiled background instead of full width image.','Travel2'),
					'type' => 'checkbox'),
					
		array(	'name' => __('Heading Font','Travel2'),					
				'id' => 'heading_font',
				'default' => 'Signika',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		array(	'name' => __('Content Font','Travel2'),
				'id' => 'content_font',
				'default' => 'Open Sans',
				'options' => array(
					'Arial' => 'Arial',					
					'Helvetica' => 'Helvetica',
				),
				'type' => 'select_font'),
				
		//Header
		array(	'name' => __('Header','Travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Header Layout','Travel2'),
				'id' => 'header_layout',
				'options' => array(
					'separated'=>Themex_URI.'admin/images/layouts/7.png',
					'fullwidth'=>Themex_URI.'admin/images/layouts/8.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Header Text','Travel2'),
				'description' => __('Enter the text to be displayed at the social links.','Travel2'),
				'id' => 'header_text',
				'default' => '',
				'type' => 'textarea'),
				
			array(	'name' => __('Slider','Travel2'),
				'type' => 'section'),
				
				array(	'name' => __('Slider Type','Travel2'),
					'id' => 'slider_type',
					'options' => array('fade' => __('Fade Slider','Travel2'), 'motion' => __('Motion Slider','Travel2')),
					'type' => 'select'),
					
			array(	'name' => __('Slider Pause','Travel2'),
					'default' => '0',
					'id' => 'slider_pause',
					'attributes' => array('min_value' => '0', 'max_value' => '20000', 'unit' => 'ms'),
					'type' => 'slider'),
					
			array(	'name' => __('Transition Speed','Travel2'),
					'default' => '400',
					'id' => 'slider_speed',
					'attributes' => array('min_value' => '100', 'max_value' => '1000', 'unit' => 'ms'),
					'type' => 'slider'),
				
			array(	'name' => __('Social Links','Travel2'),
				'type' => 'section'),
				
			array(	'name' => __('RSS Link','Travel2'),
					'id' => 'rss_link',
					'type' => 'text'),
					
			array(	'name' => __('Facebook Link','Travel2'),
					'id' => 'facebook_link',
					'type' => 'text'),
					
			array(	'name' => __('Twitter Link','Travel2'),
					'id' => 'twitter_link',
					'type' => 'text'),
					
			array(	'name' => __('Google Link','Travel2'),
					'id' => 'google_link',
					'type' => 'text'),

			array(	'name' => __('Flickr Link','Travel2'),
					'id' => 'flickr_link',
					'type' => 'text'),
					
			array(	'name' => __('Tumblr Link','Travel2'),
					'id' => 'tumblr_link',
					'type' => 'text'),

			array(	'name' => __('LinkedIn Link','Travel2'),
					'id' => 'linkedin_link',
					'type' => 'text'),		
					
			array(	'name' => __('YouTube Link','Travel2'),
					'id' => 'youtube_link',
					'type' => 'text'),
					
			array(	'name' => __('Vimeo Link','Travel2'),
					'id' => 'vimeo_link',
					'type' => 'text'),
					
			array(	'name' => __('Skype Link','Travel2'),
					'id' => 'skype_link',
					'type' => 'text'),
					
			array(	'name' => __('Blogger Link','Travel2'),
					'id' => 'blogger_link',
					'type' => 'text'),
					
			array(	'name' => __('StumbleUpon Link','Travel2'),
					'id' => 'stumbleupon_link',
					'type' => 'text'),			
					
		//Tours
		array(	'name' => __('Tours','Travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Tours Layout','Travel2'),
				'id' => 'tours_layout',
				'options' => array(
					'right'=>Themex_URI.'admin/images/layouts/3.png',
					'left'=>Themex_URI.'admin/images/layouts/2.png',									
					'fullwidth'=>Themex_URI.'admin/images/layouts/1.png',
				),
				'type' => 'select_image'),
				
			array(	'name' => __('Tours View','Travel2'),
					'id' => 'tours_view',
					'options' => array('grid' => __('Grid','Travel2'), 'list' => __('List','Travel2')),
					'type' => 'select'),
					
			array(	'name' => __('Tours Per Page','Travel2'),
				'id' => 'tours_limit',
				'default' => '12',
				'type' => 'number'),
				
			array(	'name' => __('Price Currency','Travel2'),
					'id' => 'tours_currency',
					'default' => '$',
					'description' => __('Set price currency symbol.','Travel2'),
					'type' => 'text'),
					
			array(	'name' => __('Currency Position','Travel2'),
					'id' => 'tours_currency_position',
					'options' => array('left' => __('Left','Travel2'), 'right' => __('Right','Travel2')),
					'type' => 'select'),			
				
			array(	'name' => __('Related Tours Order','Travel2'),
					'id' => 'tours_related_order',
					'options' => array(
						'rand' => __('Random','Travel2'), 
						'type' => __('Type','Travel2'), 'destination' => __('Destination','Travel2')
					),
					'type' => 'select'),
					
			array(	'name' => __('Hide Related Tours','Travel2'),
					'id' => 'tours_related',
					'type' => 'checkbox'),

			array(	'name' => __('Disable Booking','Travel2'),
					'id' => 'tours_booking',
					'description' => __('Check this to disable booking form.','Travel2'),
					'type' => 'checkbox'),
					
			array(	'name' => __('Disable Questions','Travel2'),
					'id' => 'tours_questions',
					'description' => __('Check this to disable question form.','Travel2'),
					'type' => 'checkbox'),
					
		//Gallery
		array(	'name' => __('Galleries','Travel2'),
				'type' => 'page'),
				
				array(	'name' => __('Galleries Layout','Travel2'),
				'id' => 'galleries_layout',
				'options' => array(
					'four'=>Themex_URI.'admin/images/layouts/5.png',
					'three'=>Themex_URI.'admin/images/layouts/6.png',
				),
				'type' => 'select_image'),
				
				array(	'name' => __('Galleries Per Page','Travel2'),
				'id' => 'galleries_limit',
				'default' => '12',
				'type' => 'number'),
				
				array(	'name' => __('Galleries Caption','Travel2'),
					'id' => 'galleries_caption',
					'options' => array(
						'visible' => __('Visible', 'Travel2'),
						'hidden' => __('Hidden', 'Travel2'),
						'none' => __('None', 'Travel2'),
					),
					'type' => 'select'),
				
		//Search Form
		array(	'name' => __('Search Form','Travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Form Title','Travel2'),
					'id' => 'search_form_title',
					'default' => '',
					'type' => 'text'),
				
			array(	'name' => __('Hide Destination Field','Travel2'),
					'id' => 'search_form_destination',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Type Field','Travel2'),
					'id' => 'search_form_type',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Date Fields','Travel2'),
					'id' => 'search_form_date',
					'type' => 'checkbox'),
					
			array(	'name' => __('Hide Price Field','Travel2'),
					'id' => 'search_form_price',
					'type' => 'checkbox'),
					
		//Booking Payments
		array(	'name' => __('Booking Payment','Travel2'),
				'type' => 'page'),
				
			array(	'name' => __('Enable Booking Payment','Travel2'),
						'id' => 'booking_payment',
						'type' => 'checkbox'),				
				
			array(	'name' => __('Payment Language','Travel2'),
				'id' => 'booking_language',
				'options' => array(
					'AU' => __('Australian','Travel2'), 
					'CN' => __('Chinese','Travel2'),
					'EN' => __('English','Travel2'), 
					'FR' => __('French','Travel2'),
					'DE' => __('German','Travel2'), 
					'IT' => __('Italian','Travel2'),
					'JP' => __('Japanese','Travel2'), 
					'PL' => __('Polish','Travel2'),
					'ES' => __('Spanish','Travel2'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Currency','Travel2'),
				'id' => 'booking_currency',
				'options' => array(
					'AUD' => __('Australian Dollar','Travel2'), 
					'CAD' => __('Canadian Dollar','Travel2'),
					'EUR' => __('Euro','Travel2'),
					'GBP' => __('British Pound','Travel2'),
					'JPY' => __('Japanese Yen','Travel2'), 
					'USD' => __('United States Dollar','Travel2'),
					'NZD' => __('New Zealand Dollar','Travel2'),
					'CHF' => __('Swiss Franc','Travel2'),
					'HKD' => __('Hong Kong Dollar','Travel2'),
					'SGD' => __('Singapore Dollar','Travel2'),
					'SEK' => __('Swedish Krona','Travel2'),
					'DKK' => __('Danish Krone','Travel2'),
					'PLN' => __('Polish Zloty','Travel2'),
					'NOK' => __('Norwegian Krone','Travel2'),
					'HUF' => __('Hungarian Forint','Travel2'),
					'CZK' => __('Czech Koruna','Travel2'),
					'ILS' => __('Israeli Shekel','Travel2'),
					'MXN' => __('Mexican Peso','Travel2'),
					'BRL' => __('Brazilian Real','Travel2'),
					'MYR' => __('Malaysian Ringgit','Travel2'),
					'PHP' => __('Philippine Peso','Travel2'),
					'TWD' => __('New Taiwan Dollar','Travel2'),
					'THB' => __('Thai Baht','Travel2'),
					'TRY' => __('Turkish Lira','Travel2'),
				),
				'type' => 'select'),
				
			array(	'name' => __('Payment Amount','Travel2'),
				'id' => 'booking_price',
				'default' => '0',
				'description' => __('Enter in the booking fee amount.','Travel2'),
				'type' => 'number'),
				
			array(	'name' => __('PayPal Account','Travel2'),
				'id' => 'booking_email',
				'default' => '',
				'description' => __('Enter in your PayPal account email address.','Travel2'),
				'type' => 'text'),
			
		//Booking Form
		array(	'name' => __('Booking Form','Travel2'),
				'type' => 'page'),	

			array(	'type' => 'Themex_form',
					'id' => 'booking_form' ),			
					
		//Question Form
		array(	'name' => __('Question Form','Travel2'),
				'type' => 'page'),
				
			array(	'type' => 'Themex_form',
					'id' => 'question_form' ),
		
		//Contact Form
		array(	'name' => __('Contact Form','Travel2'),
				'type' => 'page'),
				
			array(	'type' => 'Themex_form',
					'id' => 'contact_form' ),	

		//Custom Sidebars
		array(	'name' => __('Sidebars','Travel2'),
				'type' => 'page'),
				
			array(	'type' => 'Themex_widgetiser',
					'id' => 'Themex_widgetiser' ),
				
		//Mailing List
		array(	'name' => __('Mailing List','Travel2'),
				'type' => 'page'),
				
			array(	'name' => '',
					'id' => 'mailing_list',
					'default' => '',
					'description' => __('This is the list of subcribers from Newsletter Widget.','Travel2'),
					'type' => 'textarea'),
	),

);
?>
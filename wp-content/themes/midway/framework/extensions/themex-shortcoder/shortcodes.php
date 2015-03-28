<?php
//Columns

add_shortcode('one_sixth', 'themex_one_sixth');
function themex_one_sixth( $atts, $content = null ) {
   return '<div class="twocol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_sixth_last', 'themex_one_sixth_last');
function themex_one_sixth_last( $atts, $content = null ) {
   return '<div class="twocol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('one_fourth', 'themex_one_fourth');
function themex_one_fourth( $atts, $content = null ) {
   return '<div class="threecol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_fourth_last', 'themex_one_fourth_last');
function themex_one_fourth_last( $atts, $content = null ) {
   return '<div class="threecol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('one_third', 'themex_one_third');
function themex_one_third( $atts, $content = null ) {
   return '<div class="fourcol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_third_last', 'themex_one_third_last');
function themex_one_third_last( $atts, $content = null ) {
   return '<div class="fourcol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('five_twelfths', 'themex_five_twelfths');
function themex_five_twelfths( $atts, $content = null ) {
   return '<div class="fivecol column">'.do_shortcode($content).'</div>';
}

add_shortcode('five_twelfths_last', 'themex_five_twelfths_last');
function themex_five_twelfths_last( $atts, $content = null ) {
   return '<div class="fivecol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('one_half', 'themex_one_half');
function themex_one_half( $atts, $content = null ) {
   return '<div class="sixcol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_half_last', 'themex_one_half_last');
function themex_one_half_last( $atts, $content = null ) {
   return '<div class="sixcol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('seven_twelfths', 'themex_seven_twelfths');
function themex_seven_twelfths( $atts, $content = null ) {
   return '<div class="sevencol column">'.do_shortcode($content).'</div>';
}

add_shortcode('seven_twelfths_last', 'themex_seven_twelfths_last');
function themex_seven_twelfths_last( $atts, $content = null ) {
   return '<div class="sevencol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('two_thirds', 'themex_two_thirds');
function themex_two_thirds( $atts, $content = null ) {
   return '<div class="eightcol column">'.do_shortcode($content).'</div>';
}

add_shortcode('two_thirds_last', 'themex_two_thirds_last');
function themex_two_thirds_last( $atts, $content = null ) {
   return '<div class="eightcol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('three_fourths', 'themex_three_fourths');
function themex_three_fourths( $atts, $content = null ) {
   return '<div class="ninecol column">'.do_shortcode($content).'</div>';
}

add_shortcode('three_fourths_last', 'themex_three_fourths_last');
function themex_three_fourths_last( $atts, $content = null ) {
   return '<div class="ninecol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

//Title
add_shortcode('title', 'themex_title');
function themex_title( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size' => 'large',
    ), $atts));
	$title='1';
	if($size=='small') {
		$title='4';
	}
   return '<div class="block-title"><h'.$title.'>'.do_shortcode($content).'</h'.$title.'></div>';
}

//Block
add_shortcode('block', 'themex_block');
function themex_block( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'background' => '',
    ), $atts));
	if($background!='') {
		$background='<div class="substrate block-substrate"><img src="'.$background.'" class="fullwidth" alt="" /></div>';
	}
	$out='</div></div><div class="container content-block">'.$background;
	$out.='<div class="row">'.do_shortcode($content).'<div class="clear"></div></div></div><div class="container content"><div class="row">';
   return $out;
}

//Sidebar
add_shortcode('sidebar', 'themex_sidebar');
function themex_sidebar( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'name' => '',
    ), $atts));

	ob_start();
	ThemexWidgetiser::renderData($name);
	$out=ob_get_contents();
	ob_end_clean();
	return $out;
}

//Testimonials
add_shortcode('testimonials','themex_testimonials');
function themex_testimonials( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'pause' => '0',
		'speed' => '400',
		'number' => '-1',
		'order' => 'date'
    ), $atts));
	$query = new WP_Query(array(
		'post_type' => 'testimonial',
		'orderby' => $order,
		'showposts' => intval($number),
	));
	$out='<div class="fade-slider testimonials-slider"><ul>';
	if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();
		$out.='<li><div class="quote"><div class="block-background">'.get_the_content().'</div></div><h6 class="quote-author">'.get_the_title().'</h6></li>';
	endwhile;
	endif;
	wp_reset_query();
	$out.='</ul><input type="hidden" class="slider-pause" value="'.$pause.'" />';
	$out.='<input type="hidden" class="slider-speed" value="'.$speed.'" />';
	$out.='<input type="hidden" class="slider-effect" value="fade" /></div>';
	return $out;
}

//Tours
add_shortcode('tours','themex_tours');
function themex_tours( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'number' => '4',
		'columns' => '4',
		'order' => 'date',
		'type' => '0',
		'destination' => '0',
    ), $atts));
	
	global $post;
	
	$destination=is_null($term=get_term( intval($destination), 'tour_destination' )) || is_wp_error($term)? null : $term->slug;
	$type=is_null($term=get_term( intval($type), 'tour_type' )) || is_wp_error($term)? null : $term->slug;
	$desc=$order=='title'?'ASC':'DESC';
	
	$query = new WP_Query(array(
		'post_type' => 'tour',
		'showposts' => intval($number),
		'orderby' => $order,
		'order' => $desc,
		'meta_key'    => '_thumbnail_id',
		'tour_type' => $type,
		'tour_destination' => $destination,
	));	
	
	$layout='three';
	switch($columns) {
		case '3': $layout='four'; break;
		case '4': $layout='three'; break;
	}	
	
	$GLOBALS['row_class']=$layout;
	$GLOBALS['row_limit']=$columns;
	
	$out='<div class="items-grid">';
	$GLOBALS['counter']=0;
	if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();
		$GLOBALS['counter']++;
		
		ob_start();
		get_template_part('loop', 'grid-tour');
		$out.=ob_get_contents();
		ob_end_clean();
		
		if($GLOBALS['counter']==intval($columns)) {
			$out.='<div class="clear"></div>';
			$GLOBALS['counter']=0;			
		}
	endwhile;
	endif;
	wp_reset_query();
	$out.='<div class="clear"></div></div><div class="clear"></div>';
	
	return $out;
}

//Posts
add_shortcode('posts','themex_posts');
function themex_posts( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'number' => '1',
		'order' => 'date',
		'category' => '0',
    ), $atts));
	
	global $post;
	$date_format=ThemexCore::getOption('date_format','m/d/Y');
	
	$query = new WP_Query(array(
		'post_type' => 'post',
		'showposts' => intval($number),
		'orderby' => $order,
		'cat' => intval($category),
	));
	
	$out='<div class="featured-blog">';
	if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();
		$out.='<div class="post">';
		if(has_post_thumbnail()) {
			$out.='<div class="featured-image"><a href="'.get_permalink().'">';
			ob_start();
			the_post_thumbnail('normal');
			$out.=ob_get_contents();
			ob_end_clean();
			$out.='</a></div>';
		}
		$out.='<div class="post-content"><h5 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h5></div>';
		$out.='<p>'.themex_excerpt(get_the_excerpt()).'</p>';
		$out.='<div class="post-meta"><a href="'.get_permalink().'" class="button small"><span>'.__('Read More','miracleisland').'</span></a>';
		if(comments_open()) {
			$out.='<div class="post-comment-count">'.get_comments_number('0','1','%').'</div>';
		}
		$out.='<div class="post-info">'.get_the_time($date_format).'</div></div>';
		$out.='</div>';
	endwhile;
	endif;
	wp_reset_query();
	$out.='</div>';
	
	return $out;
}

//Gallery
add_shortcode('galleries','themex_galleries');
function themex_galleries( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'number' => '3',
		'columns' => '3',
		'caption' => 'hidden',
		'order' => 'date',
		'category' => '0'
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	} else {
		$order='date';
	}
	
	$category=get_term(intval($category), 'gallery_category');
	if(isset($category->slug)) {
		$category=$category->slug;
	} else {
		$category=0;
	}
	
	$query = new WP_Query(array(
		'post_type' => 'gallery',
		'showposts' => intval($number),
		'orderby' => $order,
		'gallery_category' => $category,
		'meta_key'    => '_thumbnail_id',
	));	
	
	$layout='four';
	switch($columns) {
		case '2': $layout='six'; break;
		case '3': $layout='four'; break;
		case '4': $layout='three'; break;
	}	
	
	$GLOBALS['layout']=$layout;
	$GLOBALS['row_limit']=$columns;
	$GLOBALS['caption']=$caption;
	
	$out='<div class="items-grid">';
	$GLOBALS['counter']=0;
	if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();
		$GLOBALS['counter']++;

		ob_start();
		get_template_part('loop', 'gallery');
		$out.=ob_get_contents();
		ob_end_clean();
		
		if($GLOBALS['counter']==intval($columns)) {
			$out.='<div class="clear"></div>';
			$GLOBALS['counter']=0;
		}
	endwhile;
	endif;
	wp_reset_query();	
	
	$out.='<div class="clear"></div></div><div class="clear"></div>';	
	
	return $out;
}

//Image
add_shortcode('image','themex_image');
function themex_image( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'url' => '',
    ), $atts));
	
	$out='';
	if($content!='') {
		$out.='<img src="'.$content.'" alt="" />';
		if($url!='') {
			$out='<a href="'.$url.'">'.$out.'</a>';
		}
		$out='<div class="featured-image">'.$out.'</div>';
	}	
	return $out;
}

//Itinerary
add_shortcode('itinerary','themex_itinerary');
function themex_itinerary( $atts, $content = null ) {
	$out='<div class="tour-itinerary"><table>'.do_shortcode($content).'</table></div>';
	return $out;
}

add_shortcode('day','themex_itinerary_day');
function themex_itinerary_day( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title' => '&nbsp;',
		'image' => '',
    ), $atts));
	$out='<tr><td class="tour-day-number"><h5>'.$title.'</h5></td>';
	$out.='<td class="tour-day-text"><div class="bubble-corner"></div><div class="bubble-text">';
	if($image!='') {
		$out.='<div class="column fivecol"><div class="featured-image">';
		$out.='<img src="'.$image.'" alt="" class="fullwidth" />';
		$out.='</div></div><div class="column sevencol last">';
	} else {
		$out.='<div class="fullwidth-block">';
	}
	$out.=do_shortcode($content);
	$out.='</div><div class="clear"></div></td></tr>';
	return $out;
}

//Google Map
function themex_google_map( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'latitude' => '37.49',
		'longitude' => '-77.48',
		'zoom' => '12',
		'height' => '300',
		'layout' => 'fullwidth',
		'align' => 'center',
		'description' => '',
    ), $atts));
	
	//enqueue shortcode script
	wp_enqueue_script( 'google_map','http://maps.google.com/maps/api/js?sensor=false' );
	
	//output map
	$out='<div class="google-map-container align-'.$align.'"><div class="google-map" id="google-map" style="height:'.$height.'px"></div><input type="hidden" class="map-latitude" value="'.$latitude.'" />';
	$out.='<input type="hidden" class="map-longitude" value="'.$longitude.'" /><input type="hidden" class="map-zoom" value="'.$zoom.'" /><input type="hidden" class="map-description" value="'.$description.'" /></div>';
	
	if($layout=='fullwidth') {
		$out='<div class="clear"></div></div></div>'.$out.'<div class="container content"><div class="row">';
	}
   
    return $out;
}

add_shortcode('map', 'themex_google_map');

//Contact Form
add_shortcode('contact_form','themex_contact_form');
function themex_contact_form( $atts, $content = null ) {
	ob_start();
	ThemexForm::renderData('contact_form');
	$out=ob_get_contents();
	ob_end_clean();
	return $out;
}

//Search Form
add_shortcode('search_form','themex_search_form');
function themex_search_form( $atts, $content = null ) {
	ob_start();
	get_template_part('module','search');
	$out=ob_get_contents();
	ob_end_clean();
	return $out;
}

//Buttons
add_shortcode('button','themex_button');
function themex_button( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'color'   => 'default',
		'size'	=> 'small'
    ), $atts));	
   return '<a href="'.$url.'" class="button '.$size.' '.$color.'"><span>'.do_shortcode($content).'</span></a>';
}

//Tabs
add_shortcode('tabs', 'themex_tabs');
function themex_tabs( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'titles' => '',
		'type' => 'horizontal'
    ), $atts));
	
	$out = '<div class="tabs-container '.$type.'-tabs">';

	if($type=='vertical') {
		$out.='<div class="column threecol tabs"><ul>';
	} else {
		$out.='<ul class="tabs">';
	}
	
    $titles = explode(',', $titles);
	if(is_array($titles)) {
		foreach($titles as $title) {
			$out.='<li><a href="#'.sanitize_title($title).'">'.trim($title).'</a></li>';
		}
	}
    $out.='</ul>';

	if($type=='vertical') {
		$out.='</div><div class="panes column ninecol last">';
	} else {
		$out.='<div class="panes">';
	}
	
	$GLOBALS['counter']=0;
	$GLOBALS['titles']=$titles;
	
	$out.=do_shortcode($content);
    $out.='</div></div>';
	
    return $out;
}

//Tabs Panes
add_shortcode('tab', 'themex_tabs_panes');
function themex_tabs_panes( $atts, $content = null ) {	
	$ID='';
	if(isset($GLOBALS['titles'][$GLOBALS['counter']])) {
		$ID=sanitize_title($GLOBALS['titles'][$GLOBALS['counter']]);
	}
	
	$out = '<div class="pane" id="'.$ID.'">'.do_shortcode($content).'</div>';
	$GLOBALS['counter']++;
	
    return $out;
}

//Toggle
add_shortcode('toggle', 'themex_toggle');
function themex_toggle( $atts, $content = null ) {	
    extract(shortcode_atts(array(
		'title'    	 => '',
    ), $atts));

	$out='<div class="toggle"><div class="expand-icon"></div><div class="toggle-title">'.$title.'</div><div class="toggle-content">'.do_shortcode($content).'</div></div>';	
    return $out;	
}
?>
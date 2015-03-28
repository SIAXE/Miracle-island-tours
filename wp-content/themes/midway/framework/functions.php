<?php
//Site Logo
function themex_logo() {
	$logo_type=get_option('themex_logo_type');
	if($logo_type=='image' && get_option('themex_logo_image')) {
		$out='<img src="'.get_option('themex_logo_image').'" alt="">';
	} else if($logo_type=='text' && get_option('themex_logo_text')) {
		$out=get_option('themex_logo_text');
	} else {
		$out='<img src="'.THEME_URI.'images/logo.png" alt="" />';
	}
	echo $out;
}

//Login Logo
add_action('login_head', 'themex_login_logo');
function themex_login_logo() {
	$logo_url=get_option('themex_login_logo');
	if($logo_url) {
		echo '<style type="text/css">h1 a { background-image:url('.$logo_url.') !important; }</style>';
	}
}

//Tracking Code
function themex_footer() {
	if(get_option('themex_tracking_code')) {
		echo themex_html(ThemexCore::getOption('tracking_code'));
	}
}
add_action('wp_footer','themex_footer');

//Custom Comments
function themex_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $date_format;
	if(!isset($date_format)) {
		$date_format=ThemexCore::getOption('date_format','m/d/Y');
	}	
    ?>
	<li id="comment-<?php comment_ID(); ?>">
		<div class="comment">
			<div class="avatar-container featured-image">
				<?php echo get_avatar( $comment, $size='75', $default=THEME_URI.'images/avatar.png' ); ?>										
			</div>
			<div class="comment-text">
				<div class="comment-meta">					
					<h6 class="comment-author"><?php echo get_comment_author_link(); ?></h6>
					<div class="comment-date"><?php echo get_comment_time($date_format.' G:i'); ?></div>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					<div class="clear"></div>
				</div>
				<?php comment_text(); ?>
			</div>
			<div class="clear"></div>
		</div>
<?php
}

//Custom Comments Form
function themex_comment_form_fields($fields) {
	unset($fields['url']);
	$fields['author']='<div class="column sixcol"><div class="field-wrapper"><input id="author" name="author" type="text" value="" placeholder="'.__('Name','travel2').'" size="30" aria-required="true" /></div></div>';
	$fields['email']='<div class="column sixcol last"><div class="field-wrapper"><input id="email" name="email" type="text" value="" placeholder="'.__('Email','travel2').'" size="30" aria-required="true" /></div></div><div class="clear"></div>';
	return $fields;
}
add_filter('comment_form_default_fields','themex_comment_form_fields');

//Custom Pagination
function themex_pagination() {
	global $wp_query, $wp_rewrite;
	$query=$wp_query;
	$max = $query->max_num_pages;
	if (!$current = get_query_var('paged')) $current = 1;
	$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$a['total'] = $max;
	$a['current'] = $current;

	$a['mid_size'] = 5;
	$a['end_size'] = 1;
	$a['prev_text'] = '';
	$a['next_text'] = '';
	
	$out=paginate_links($a);
	if($out!='') {
		$out='<div class="pagination">'.$out.'</div>';
	}
	echo $out;
}

//Custom Excerpt
function themex_excerpt($excerpt='') {
	global $post;
	
	$paragraphs=explode('</p>',$excerpt);
	$out=$post->post_excerpt;
	
	if(isset($paragraphs[0])) {
		$out=$paragraphs[0];
	}
	
	return $out;
}

//Detect Post Type
function themex_is_post_type($types) {
	global $post;
	foreach($types as $type) {
		if($type==$post->post_type) {
			return true;
		}
	}
	return false;
}

//Detect Slider Page
function themex_is_slider_page() {
	$posts=get_posts(array(
		'post_type'=>'slide',
		'numberposts'=>1
	));
	
	if(count($posts)==1) {
		return true;
	}
	
	return false;
}

//Show Tour Duration
function themex_duration($id) {
	$duration=intval(get_post_meta($id,'_tour_duration',true));
	$out='';
	if($duration!='' && $duration!='0') {
		if($duration==1) {
			$out=$duration.' '.__('day','travel2');
		} else {
			$out=$duration.' '.__('days','travel2');
		}
	}
	return $out;
}

//Show Tour Categories
function themex_category($id, $slug='') {
	$categories_array=wp_get_post_terms($id,'tour_'.$slug);
	$categories_list='';
	foreach($categories_array as $item) {
		$categories_list.=$item->name.', ';
	}
	
	if($categories_list!='') {
		$categories_list=substr($categories_list, 0, -2);
	}
	
	return $categories_list;
}

//Show Formatted Date
function themex_date($date, $format) {	
	if(isset($date) && $date!='') {
		$timestamp=strtotime(str_replace('/','.',$date));
		$date=date($format, $timestamp);
		return $date;
	}
	
	return '';	
}

//Show Tour Days
function themex_days($days) {
	parse_str($days, $days_arr);
	$out='';
	
	if(is_array($days_arr) && !empty($days_arr)) {
		$days_arr=array_unique($days_arr);
		
		foreach($days_arr as $day_name) {	
			switch ($day_name) {				
				case '1' : $out.=__('Monday','travel2').', '; break;
				case '2' : $out.=__('Tuesday','travel2').', '; break;
				case '3' : $out.=__('Wednesday','travel2').', '; break;
				case '4' : $out.=__('Thursday','travel2').', '; break;
				case '5' : $out.=__('Friday','travel2').', '; break;
				case '6' : $out.=__('Saturday','travel2').', '; break;
				case '7' : $out.=__('Sunday','travel2').', '; break;
			}
		}
		
		if($out!='') {
			$out=substr($out,0,-2);
		}
	}
	
	return $out;
}

//Tours Query
function themex_tours_query() {
	global $post;
	global $wp_query;
	
	$destination=isset($post)?intval(get_post_meta($post->ID,'_page_tours_destination',true)):0;
	if(get_query_var('tour_destination')) {
		$destination=is_null($term=get_term_by( 'slug', get_query_var('tour_destination'), 'tour_destination' )) || is_wp_error($term)? null : $term->term_id;
	}
	
	$type=isset($post)?intval(get_post_meta($post->ID,'_page_tours_type',true)):0;
	if(get_query_var('tour_type')) {
		$type=is_null($term=get_term_by( 'slug', get_query_var('tour_type'), 'tour_type' )) || is_wp_error($term)? null : $term->term_id;
	}
	
	if((isset($_GET['s']) && empty($_GET['s'])) || $type!=0 || $destination!=0) {
	
		//query args
		$item_ids=array();
		$args=array(
			'post_type'=>'tour',
			'numberposts'=>-1,
			'fields'=>'ids',
		);
		
		$filtered=false;
		if($type!=0 || $destination!=0) {
			$filtered=true;
		}
		
		//search args
		$destination=isset($_GET['destination'])?intval($_GET['destination']):$destination;
		$type=isset($_GET['type'])?intval($_GET['type']):$type;
		$args['tour_destination']=is_null($term=get_term( $destination, 'tour_destination' )) || is_wp_error($term)? null : $term->slug;
		$args['tour_type']=is_null($term=get_term( $type, 'tour_type' )) || is_wp_error($term)? null : $term->slug;
		
		$date_dep=isset($_GET['date_dep'])?themex_timestamp($_GET['date_dep']):0;
		$date_arr=isset($_GET['date_arr'])?themex_timestamp($_GET['date_arr']):0;
		$date_range=floor(($date_arr-$date_dep)/86400)+1;
		
		$price_min=isset($_GET['price_min'])?intval($_GET['price_min']):0;
		$price_max=isset($_GET['price_max'])?intval($_GET['price_max']):0;
		
		//query posts
		$items=get_posts($args);

		//filter posts
		foreach($items as $item_id) {		
			if($filtered) {
				$item_ids[]=$item_id;
			} else {
				$meta=themex_get_post_meta($item_id, array(
					'_tour_price'=>'',
					'_tour_duration'=>'',
					'_tour_days'=>'',
					'_tour_departure_date'=>'',			
				));
				parse_str($meta['_tour_days'],$days);			
				
				//date filters
				$date_filter=true;
				if(isset($days[0]) && $days[0]!='date' && $date_dep!=0) {
					if(!in_array(date('N',$date_dep),$days)) {
						$date_filter=false;
					}
				}
				
				if($meta['_tour_departure_date']!='' && $date_dep!=0) {
					if($meta['_tour_departure_date']!=date('d/m/Y',$date_dep)) {
						$date_filter=false;
					}
				} 
				
				if($meta['_tour_duration']!='' && $date_dep!=0 && $date_arr!=0) {
					if(intval($meta['_tour_duration'])>$date_range || $date_dep > $date_arr) {
						$date_filter=false;
					}
				}

				//price filter
				if($date_filter) {
					if($meta['_tour_price']!='' && $price_min!=0 && $price_max!=0){
						if(intval($meta['_tour_price'])>=$price_min && intval($meta['_tour_price'])<=$price_max) {
							$item_ids[]=$item_id;
						}
					} else {
						$item_ids[]=$item_id;
					}
				}
			}
		}
		
		if(!empty($item_ids)) {
			return $item_ids;
		}		
		return array(-1);
		
	} else {
		return null;
	}
	
}

//Filter search query
add_action('template_redirect', 'themex_search_query');
function themex_search_query() {
    if (isset($_GET['s']) && empty($_GET['s'])) {
        global $wp_query;		
        $wp_query->is_404=false;
    }
}

//Get all post meta
function themex_get_post_meta($post_id, $defaults=array()){
    global $wpdb;
    $data   =   array();
    $wpdb->query("
        SELECT `meta_key`, `meta_value`
        FROM $wpdb->postmeta
        WHERE `post_id` = $post_id
    ");
	
    foreach($wpdb->last_result as $k => $v){
        $data[$v->meta_key] =   $v->meta_value;
    };
	
	foreach($defaults as $key=>$value) {
		if(!isset($data[$key])) {
			$data[$key]=$value;
		}
	}
	
    return $data;
}

//Date Timestamp
function themex_timestamp($date) {
	$date=str_replace('/','.',$date);
	if(ThemexCore::getOption('date_format','m/d/Y')=='m/d/Y') {
		$date_arr=explode('.',$date);
		if(is_array($date_arr) && isset($date_arr[1])) {
			list($date_arr[0],$date_arr[1])=array($date_arr[1],$date_arr[0]);
			$date=implode('.',$date_arr);
		}
	}
	return strtotime($date);
}

//Get Boundary Prices
function themex_boundary_prices() {
	global $wpdb;
    $prices = $wpdb->get_col( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", '_tour_price', 'publish', 'tour' ) );
	sort($prices);
	
	if(isset($prices[0])) {
		$result[0]=$prices[0];
	} else {
		$result[0]=0;
	}
	
	if(isset($prices[count($prices)-1])) {
		$result[1]=$prices[count($prices)-1];
	} else {
		$result[1]=0;
	}
    return $result;
}

//Get Formatted Price
function themex_price($id=null, $before='', $after='') {
	$price_format=ThemexCore::getOption('tours_currency_position','left');
	$price_currency=ThemexCore::getOption('tours_currency','$');
	$price=get_post_meta($id,'_tour_price',true);
	
	$out='';
	if(($price!='' && $price!='0') || is_null($id)) {
		$out=$before.$price.$after;
		if(is_null($id)) {
			$out=$before.$after;
		}	
		
		if($price_format=='right') {
			$out=$out.$price_currency;
		} else {		
			$out=$price_currency.$out;
		}
	}
	
	return $out;
}

//Background Image
function themex_background($default='', $class='') {
	global $post;
	
	$background='';
	if(isset($post) && ($page_background=get_post_meta($post->ID,'_page_background',true))!='') {
		$background=$page_background;
	} else if($site_background=get_option('themex_background_image')) {
		$background=$site_background;
	} else if($site_pattern=get_option('themex_background_pattern')) {
		$background=$site_pattern;
	} else {
		$background=THEME_URI.'images/patterns/pattern_1.jpg';
	}
	
	if($background!='' && get_option('themex_background_fullwidth')!='true') {
		echo '<div class="substrate '.$class.'"><img src="'.$background.'" class="fullwidth" alt="" /></div>';
	}
}

//Payment Security
add_action('init','themex_payment_security');
function themex_payment_security() {
	if(get_option('themex_booking_payment')=='true') {
		if(!session_id()) {
			session_start();
		}
		if(!isset($_SESSION['payment_id'])) {
			$_SESSION['payment_id']=uniqid();		
		}
	}	
}

//Verify Payment
function themex_verify_payment() {
	if(isset($_GET['payment_id']) && $_GET['payment_id']==$_SESSION['payment_id'] && isset($_POST['verify_sign'])) {	
		$message=$_SESSION['payment_message'].__('Payer Email', 'travel2').': '.$_POST['payer_email'];
		ThemexForm::refresh();
		ThemexForm::sendEmail($message, 'booking_form');	
		session_destroy();
		return true;
	}
	return false;
}

//Output HTML
function themex_html($string) {
	return do_shortcode(html_entity_decode(themex_stripslashes($string)));
}

//Strip Slashes
function themex_stripslashes($string) {
	return stripslashes(stripslashes($string));
}

//Admin JS Variables
add_action( 'admin_head', 'themex_js_admin_vars' );
function themex_js_admin_vars() {
	echo '<script type="text/javascript">var themexUri="'.THEMEX_URI.'";</script>';
}

//Process Shortcodes
add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
?>
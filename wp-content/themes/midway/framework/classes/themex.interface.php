<?php
//Theme interface class
class ThemexInterface {

	public static $pages;
	
	//Init module
	public static function init() {
	
		//add theme options page to menu
		add_action('admin_menu',array(__CLASS__,'addAdminPage'));
		
		
		if(isset($_GET['themex_uploader'])) {		
			//render thickbox uploader
			add_action('admin_init',array(__CLASS__,'renderTB'));
		}
		
	}
	
	public static function renderTB() {
		add_filter('media_upload_tabs', array(__CLASS__,'filterTBTabs'));
		add_filter('attachment_fields_to_edit', array(__CLASS__,'renderTBUploader'), 10, 2);	
	}
	
	
	//Filter uploader tabs
	public static function filterTBTabs($tabs) {
		unset($tabs['type_url'], $tabs['gallery']);
    	return $tabs;
	}
	
	
	//Render additional uploader options
	public static function renderTBUploader($form_fields, $post) {
		
		//save fields
		$filename=basename($post->guid);
		$attachment_id=$post->ID;
		$attachment['post_title']='';
		$attachment['url']=$form_fields['image_url']['value'];
		$attachment['post_excerpt']='';
		
		//unset default fields
		unset($form_fields);
		
		//delete button
		if (current_user_can('delete_post', $attachment_id)) {
			if ( !EMPTY_TRASH_DAYS ) {
				$delete_button="<a href='".wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_'.$attachment_id )."' id='del[$attachment_id]' class='delete'>".__( 'Delete Permanently' , 'travel2' ).'</a>';
			} elseif ( !MEDIA_TRASH ) {
				$delete_button="<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">".__( 'Delete' , 'travel2' )."</a>
				 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>".sprintf( __( 'You are about to delete <strong>%s</strong>.' , 'travel2' ), $filename )."
				 <a href='".wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_'.$attachment_id )."' id='del[$attachment_id]' class='button'>".__( 'Continue' , 'travel2' )."</a>
				 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">".__( 'Cancel' , 'travel2' )."</a>
				 </div>";
			} else {
				$delete_button="<a href='".wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_'.$attachment_id )."' id='del[$attachment_id]' class='delete'>".__( 'Move to Trash' , 'travel2' )."</a>
				<a href='".wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_'.$attachment_id )."' id='undo[$attachment_id]' class='undo hidden'>".__( 'Undo' , 'travel2' )."</a>";
			}
		} else {
			$delete='';
		}
		
		//send to editor button
		$send_button="<input type='submit' class='button' name='send[$attachment_id]' value='".esc_attr__( 'Insert This Item' , 'travel2' )."' />";
		$send_button.="<input type='radio' checked='checked' value='full' id='image-size-full-$attachment_id' name='attachments[$attachment_id][image-size]' style='display:none;' />";
		$send_button.="<input type='hidden' value='' name='attachments[$attachment_id][post_title]' id='attachments[$attachment_id][post_title]' />";
		$send_button.="<input type='hidden' value='$attachment[url]' class='themex_image_url' name='attachments[$attachment_id][url]' id='attachments[$attachment_id][url]' />";
		$send_button.="<input type='hidden' value='' name='attachments[$attachment_id][post_excerpt]' id='attachments[$attachment_id][post_excerpt]' />";
		$form_fields['buttons']=array( 'tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send_button $delete_button</td></tr>\n" );
		
		return $form_fields;
	}
	
	
	//Add theme admin page
	public static function addAdminPage() {
		
		//add page to menu
		add_submenu_page( 'themes.php', __('Theme Options','travel2'), __('Theme Options','travel2'), 'administrator', 'theme-options', array(__CLASS__,'renderPage') );
		
	}

	//Render theme options page
	public static function renderPage() {
	
		//include page layout
		include(THEMEX_PATH.'admin/layout.php');
		
	}
	
	//Render menu from page headings
	public static function renderMenu() {
		
		$out='<ul>';
		if(is_array(self::$pages)) {
		
			//menu item index
			$index=1;
		
			foreach(self::$pages as $page) {
				$out.='<li class="item_'.$index.'" id="'.preg_replace('/\s+/','',$page['name']).'">'.$page['name'].'</li>';
				$index++;
			}
		}
		$out.='</ul>';
		echo $out;
		
	}
	
	//Render admin pages
	public static function renderPages() {
	
		//layout flag for pages
		$first=true;
		
		//define output
		$out='';
	
		foreach(ThemexCore::$options as $option) {
			
			if($option['type']=='page') {
			
				//enclose previous page
				if($first) {
					$first=false;
				} else {
					$out.='</div>';
				}
				
				//add menu item to pages
				self::$pages[]=$option;
			}
			
			//render current option
			$out.=self::renderOption($option);		
			
		}
		
		//close last page
		$out.='</div>';
		
		echo $out;
		
	}
	
	//Render metaboxes
	public static function renderMetabox() {
	
		global $post;
		
		//generate nonce
		$out='<input type="hidden" name="themex_nonce" value="'.wp_create_nonce($post->ID).'" />'; 
		$out.='<table class="form-table themex_meta_table">';
		
		//search for current post metaboxes
		foreach(ThemexCore::$components['meta_boxes'] as $meta_box) {
			if($meta_box['page']==$post->post_type) {
				foreach($meta_box['options'] as $option) {	
					//option description
					if(!isset($option['desc'])) {
						$option['desc']='';
					}
					
					//add post type prefix to option
					$option['id']='_'.$post->post_type.'_'.$option['id'];
					
					//get default option value
					$option['default']=get_post_meta($post->ID,$option['id'],true);
					
					//option class
					$class=isset($option['attributes']['class'])?$option['attributes']['class']:'';
					
					//render option					
					$out.='<tr class="'.$class.'"><th style="width:25%"><label for="'.$option['id'].'"><strong>'.$option['name'].'</strong><span>'.$option['desc'].'</span></label></th><td>';
					
					//hide default option name
					unset($option['name']);
					
					//render option
					$out.=self::renderOption($option);
					
				}
			}
		}
		
		$out.='</table>';
		
		echo $out;
	}	
	
	//Render option control
	public static function renderOption($option) {
	
		//get posts instance
		global $post;
		
		//define output
		$out='';
	
		//option wrappers
		if($option['type']!='page') {

			//parent options
			$parent='';
			if(isset($option['parent']) && is_array($option['parent'])) {
				$parent=$option['parent']['0'].' hidden themex_child_'.$option['parent']['1'];
			}
			
			//visibility
			$hidden='';
			if(isset($option['hidden'])) {
				$hidden='hidden';
			}
			
			//set wrapper type
			if(isset(ThemexCore::$modules[$option['type']])) {
				$wrapper='themex_module';
			} else {
				$wrapper='themex_option';
			}
			
			//option wrap
			if(!isset($option['wrap']) || $option['wrap']) {
				$out.='<div class="'.$wrapper.' '.$option['type'].' '.$parent.' '.$hidden.'">';
			}
			
			//option name
			if(isset($option['name']) && $option['type']!='checkbox') {
				$out.='<h3>'.$option['name'].'</h3>';
			}
		}
		
		//get option description
		if(isset($option['description'])) {
			$out.='<div class="themex_tip">'.$option['description'].'</div>';
		}
		
		//get option attributes
		$attributes='';
		if(isset($option['attributes']) && is_array($option['attributes'])) {
			foreach($option['attributes'] as $attr_name=>$attr_value) {
				$attributes.=$attr_name.'="'.$attr_value.'" ';
			}
		}
		
		//get option class
		if(!isset($option['class'])) {
			$option['class']='';
		}
		
		//get option value		
		if(isset($option['id']) && ThemexCore::getOption($option['id'])) {
			$value=stripslashes(ThemexCore::getOption($option['id']));
		} else if(isset($post) && get_post_meta($post->ID,$post->post_type.'_'.$option['id'],true)!='') {
			$value=get_post_meta($post->ID,$post->post_type.'_'.$option['id'],true);
		} else if(isset($option['default'])) {
			$value=$option['default'];
		} else {
			$value='';
		}
		
		//add elements before
		if(isset($option['before'])) {
			$out=$option['before'].$out;
		}
	
		switch($option['type']) {
			//page wrapper
			case 'page':
				$out.='<div class="themex_page" id="'.preg_replace('/\s+/','',$option['name']).'_page"><h2>'.$option['name'].'</h2>';
			break;
			
			//default text field
			case 'text':
				$out.='<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$value.'" '.$attributes.' />';
			break;
			
			//text field with number validation
			case 'number':
				$out.='<input type="number" id="'.$option['id'].'" name="'.$option['id'].'" value="'.(int)$value.'" '.$attributes.' />';
			break;
			
			//text field with date validation
			case 'date':			
				wp_enqueue_script('jquery-ui-datepicker');
				$out.='<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" class="datepicker" value="'.$value.'" '.$attributes.' />';
				$out.='<input type="hidden" class="date-day-1" value="'.__('Su', 'travel2').'" />';
				$out.='<input type="hidden" class="date-day-2" value="'.__('Mo', 'travel2').'" />';
				$out.='<input type="hidden" class="date-day-3" value="'.__('Tu', 'travel2').'" />';
				$out.='<input type="hidden" class="date-day-4" value="'.__('We', 'travel2').'" />';
				$out.='<input type="hidden" class="date-day-5" value="'.__('Th', 'travel2').'" />';
				$out.='<input type="hidden" class="date-day-6" value="'.__('Fr', 'travel2').'" />';
				$out.='<input type="hidden" class="date-day-7" value="'.__('Sa', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-1" value="'.__('January', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-2" value="'.__('February', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-3" value="'.__('March', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-4" value="'.__('April', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-5" value="'.__('May', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-6" value="'.__('June', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-7" value="'.__('July', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-8" value="'.__('August', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-9" value="'.__('September', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-10" value="'.__('October', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-11" value="'.__('November', 'travel2').'" />';
				$out.='<input type="hidden" class="date-month-12" value="'.__('December', 'travel2').'" />';				
			break;
			
			case 'hidden':
				$out.='<input type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$value.'" '.$attributes.' />';
			break;
			
			//textarea
			case 'textarea':
				$out.='<textarea id="'.$option['id'].'" name="'.$option['id'].'" '.$attributes.'>'.$value.'</textarea>';
			break;
			
			//custom dropdown
			case 'select':
				$out.='<select id="'.$option['id'].'" name="'.$option['id'].'" '.$attributes.'>';
				if(is_array($option['options'])) {
					foreach($option['options'] as $key=>$val) {
						$selected='';
						if($key==$value) {
							$selected='selected="selected"';
						}
						$out.='<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
					}
				}
				$out.='</select>';
			break;
			
			//categories dropdown
			case 'select_category':
				$taxonomy='category';
				if(isset($option['taxonomy'])) {
					$taxonomy=$option['taxonomy'];
				}	
				$args=array(
					'hide_empty'         => 0,
					'show_option_all'    => __('All Categories','travel2'),
					'echo'               => 0,
					'selected'           => $value,
					'hierarchical'       => 0, 
					'name'               => $option['id'],
					'id'				 => $option['id'],
					'class'              => 'postform',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => $taxonomy,
					'hide_if_empty'      => false
				);	
				$out.= wp_dropdown_categories($args);
			break;

			//pages dropdown
			case 'select_page':
				$args=array(
					'selected'         => $value,
					'echo'             => 0,
					'name'             => $option['id']
				);	
				$out.=wp_dropdown_pages($args);
			break;
			
			//sidebars dropdown
			case 'sidebars':
				global $wp_registered_sidebars;
				
				$sidebars=array();	
				foreach($wp_registered_sidebars as $sidebar_key=>$sidebar_name) {
					$sidebars[$sidebar_name]=$sidebar_name;
				}
				
				$out.=self::renderOption(array(
					'id' => $option['id'],
					'type' => 'select',
					'wrap' => false,
					'options' => $sidebars,
				));
			break;
			
			//fonts dropdown
			case 'select_font':
				$fonts=array(		
					'ABeeZee' => 'ABeeZee',
					'Abel' => 'Abel',
					'Abril Fatface' => 'Abril Fatface',
					'Aclonica' => 'Aclonica',
					'Acme' => 'Acme',
					'Actor' => 'Actor',
					'Adamina' => 'Adamina',
					'Advent Pro' => 'Advent Pro',
					'Aguafina Script' => 'Aguafina Script',
					'Aladin' => 'Aladin',
					'Aldrich' => 'Aldrich',
					'Alegreya' => 'Alegreya',
					'Alegreya SC' => 'Alegreya SC',
					'Alex Brush' => 'Alex Brush',
					'Alfa Slab One' => 'Alfa Slab One',
					'Alice' => 'Alice',
					'Alike' => 'Alike',
					'Alike Angular' => 'Alike Angular',
					'Allan' => 'Allan',
					'Allerta' => 'Allerta',
					'Allerta Stencil' => 'Allerta Stencil',
					'Allura' => 'Allura',
					'Almendra' => 'Almendra',
					'Almendra SC' => 'Almendra SC',
					'Amaranth' => 'Amaranth',
					'Amatic SC' => 'Amatic SC',
					'Amethysta' => 'Amethysta',
					'Andada' => 'Andada',
					'Andika' => 'Andika',
					'Angkor' => 'Angkor',
					'Annie Use Your Telescope' => 'Annie Use Your Telescope',
					'Anonymous Pro' => 'Anonymous Pro',
					'Antic' => 'Antic',
					'Antic Didone' => 'Antic Didone',
					'Antic Slab' => 'Antic Slab',
					'Anton' => 'Anton',
					'Arapey' => 'Arapey',
					'Arbutus' => 'Arbutus',
					'Architects Daughter' => 'Architects Daughter',
					'Arimo' => 'Arimo',
					'Arizonia' => 'Arizonia',
					'Armata' => 'Armata',
					'Artifika' => 'Artifika',
					'Arvo' => 'Arvo',
					'Asap' => 'Asap',
					'Asset' => 'Asset',
					'Astloch' => 'Astloch',
					'Asul' => 'Asul',
					'Atomic Age' => 'Atomic Age',
					'Aubrey' => 'Aubrey',
					'Audiowide' => 'Audiowide',
					'Average' => 'Average',
					'Averia Gruesa Libre' => 'Averia Gruesa Libre',
					'Averia Libre' => 'Averia Libre',
					'Averia Sans Libre' => 'Averia Sans Libre',
					'Averia Serif Libre' => 'Averia Serif Libre',
					'Bad Script' => 'Bad Script',
					'Balthazar' => 'Balthazar',
					'Bangers' => 'Bangers',
					'Basic' => 'Basic',
					'Battambang' => 'Battambang',
					'Baumans' => 'Baumans',
					'Bayon' => 'Bayon',
					'Belgrano' => 'Belgrano',
					'Belleza' => 'Belleza',
					'Bentham' => 'Bentham',
					'Berkshire Swash' => 'Berkshire Swash',
					'Bevan' => 'Bevan',
					'Bigshot One' => 'Bigshot One',
					'Bilbo' => 'Bilbo',
					'Bilbo Swash Caps' => 'Bilbo Swash Caps',
					'Bitter' => 'Bitter',
					'Black Ops One' => 'Black Ops One',
					'Bokor' => 'Bokor',
					'Bonbon' => 'Bonbon',
					'Boogaloo' => 'Boogaloo',
					'Bowlby One' => 'Bowlby One',
					'Bowlby One SC' => 'Bowlby One SC',
					'Brawler' => 'Brawler',
					'Bree Serif' => 'Bree Serif',
					'Bubblegum Sans' => 'Bubblegum Sans',
					'Buda' => 'Buda',
					'Buenard' => 'Buenard',
					'Butcherman' => 'Butcherman',
					'Butterfly Kids' => 'Butterfly Kids',
					'Cabin' => 'Cabin',
					'Cabin Condensed' => 'Cabin Condensed',
					'Cabin Sketch' => 'Cabin Sketch',
					'Caesar Dressing' => 'Caesar Dressing',
					'Cagliostro' => 'Cagliostro',
					'Calligraffitti' => 'Calligraffitti',
					'Cambo' => 'Cambo',
					'Candal' => 'Candal',
					'Cantarell' => 'Cantarell',
					'Cantata One' => 'Cantata One',
					'Cardo' => 'Cardo',
					'Carme' => 'Carme',
					'Carter One' => 'Carter One',
					'Caudex' => 'Caudex',
					'Cedarville Cursive' => 'Cedarville Cursive',
					'Ceviche One' => 'Ceviche One',
					'Changa One' => 'Changa One',
					'Chango' => 'Chango',
					'Chau Philomene One' => 'Chau Philomene One',
					'Chelsea Market' => 'Chelsea Market',
					'Chenla' => 'Chenla',
					'Cherry Cream Soda' => 'Cherry Cream Soda',
					'Chewy' => 'Chewy',
					'Chicle' => 'Chicle',
					'Chivo' => 'Chivo',
					'Coda' => 'Coda',
					'Coda Caption' => 'Coda Caption',
					'Codystar' => 'Codystar',
					'Comfortaa' => 'Comfortaa',
					'Coming Soon' => 'Coming Soon',
					'Concert One' => 'Concert One',
					'Condiment' => 'Condiment',
					'Content' => 'Content',
					'Contrail One' => 'Contrail One',
					'Convergence' => 'Convergence',
					'Cookie' => 'Cookie',
					'Copse' => 'Copse',
					'Corben' => 'Corben',
					'Cousine' => 'Cousine',
					'Coustard' => 'Coustard',
					'Covered By Your Grace' => 'Covered By Your Grace',
					'Crafty Girls' => 'Crafty Girls',
					'Creepster' => 'Creepster',
					'Crete Round' => 'Crete Round',
					'Crimson Text' => 'Crimson Text',
					'Crushed' => 'Crushed',
					'Cuprum' => 'Cuprum',
					'Cutive' => 'Cutive',
					'Damion' => 'Damion',
					'Dancing Script' => 'Dancing Script',
					'Dangrek' => 'Dangrek',
					'Dawning of a New Day' => 'Dawning of a New Day',
					'Days One' => 'Days One',
					'Delius' => 'Delius',
					'Delius Swash Caps' => 'Delius Swash Caps',
					'Delius Unicase' => 'Delius Unicase',
					'Della Respira' => 'Della Respira',
					'Devonshire' => 'Devonshire',
					'Didact Gothic' => 'Didact Gothic',
					'Diplomata' => 'Diplomata',
					'Diplomata SC' => 'Diplomata SC',
					'Doppio One' => 'Doppio One',
					'Dorsa' => 'Dorsa',
					'Dosis' => 'Dosis',
					'Dr Sugiyama' => 'Dr Sugiyama',
					'Droid Sans' => 'Droid Sans',
					'Droid Sans Mono' => 'Droid Sans Mono',
					'Droid Serif' => 'Droid Serif',
					'Duru Sans' => 'Duru Sans',
					'Dynalight' => 'Dynalight',
					'EB Garamond' => 'EB Garamond',
					'Eater' => 'Eater',
					'Economica' => 'Economica',
					'Electrolize' => 'Electrolize',
					'Emblema One' => 'Emblema One',
					'Emilys Candy' => 'Emilys Candy',
					'Engagement' => 'Engagement',
					'Enriqueta' => 'Enriqueta',
					'Erica One' => 'Erica One',
					'Esteban' => 'Esteban',
					'Euphoria Script' => 'Euphoria Script',
					'Ewert' => 'Ewert',
					'Exo' => 'Exo',
					'Expletus Sans' => 'Expletus Sans',
					'Fanwood Text' => 'Fanwood Text',
					'Fascinate' => 'Fascinate',
					'Fascinate Inline' => 'Fascinate Inline',
					'Federant' => 'Federant',
					'Federo' => 'Federo',
					'Felipa' => 'Felipa',
					'Fjord One' => 'Fjord One',
					'Flamenco' => 'Flamenco',
					'Flavors' => 'Flavors',
					'Fondamento' => 'Fondamento',
					'Fontdiner Swanky' => 'Fontdiner Swanky',
					'Forum' => 'Forum',
					'Francois One' => 'Francois One',
					'Fredericka the Great' => 'Fredericka the Great',
					'Fredoka One' => 'Fredoka One',
					'Freehand' => 'Freehand',
					'Fresca' => 'Fresca',
					'Frijole' => 'Frijole',
					'Fugaz One' => 'Fugaz One',
					'GFS Didot' => 'GFS Didot',
					'GFS Neohellenic' => 'GFS Neohellenic',
					'Galdeano' => 'Galdeano',
					'Gentium Basic' => 'Gentium Basic',
					'Gentium Book Basic' => 'Gentium Book Basic',
					'Geo' => 'Geo',
					'Geostar' => 'Geostar',
					'Geostar Fill' => 'Geostar Fill',
					'Germania One' => 'Germania One',
					'Give You Glory' => 'Give You Glory',
					'Glass Antiqua' => 'Glass Antiqua',
					'Glegoo' => 'Glegoo',
					'Gloria Hallelujah' => 'Gloria Hallelujah',
					'Goblin One' => 'Goblin One',
					'Gochi Hand' => 'Gochi Hand',
					'Gorditas' => 'Gorditas',
					'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
					'Graduate' => 'Graduate',
					'Gravitas One' => 'Gravitas One',
					'Great Vibes' => 'Great Vibes',
					'Gruppo' => 'Gruppo',
					'Gudea' => 'Gudea',
					'Habibi' => 'Habibi',
					'Hammersmith One' => 'Hammersmith One',
					'Handlee' => 'Handlee',
					'Hanuman' => 'Hanuman',
					'Happy Monkey' => 'Happy Monkey',
					'Henny Penny' => 'Henny Penny',
					'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
					'Holtwood One SC' => 'Holtwood One SC',
					'Homemade Apple' => 'Homemade Apple',
					'Homenaje' => 'Homenaje',
					'IM Fell DW Pica' => 'IM Fell DW Pica',
					'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
					'IM Fell Double Pica' => 'IM Fell Double Pica',
					'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
					'IM Fell English' => 'IM Fell English',
					'IM Fell English SC' => 'IM Fell English SC',
					'IM Fell French Canon' => 'IM Fell French Canon',
					'IM Fell French Canon SC' => 'IM Fell French Canon SC',
					'IM Fell Great Primer' => 'IM Fell Great Primer',
					'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
					'Iceberg' => 'Iceberg',
					'Iceland' => 'Iceland',
					'Imprima' => 'Imprima',
					'Inconsolata' => 'Inconsolata',
					'Inder' => 'Inder',
					'Indie Flower' => 'Indie Flower',
					'Inika' => 'Inika',
					'Irish Grover' => 'Irish Grover',
					'Istok Web' => 'Istok Web',
					'Italiana' => 'Italiana',
					'Italianno' => 'Italianno',
					'Jim Nightshade' => 'Jim Nightshade',
					'Jockey One' => 'Jockey One',
					'Jolly Lodger' => 'Jolly Lodger',
					'Josefin Sans' => 'Josefin Sans',
					'Josefin Slab' => 'Josefin Slab',
					'Judson' => 'Judson',
					'Julee' => 'Julee',
					'Junge' => 'Junge',
					'Jura' => 'Jura',
					'Just Another Hand' => 'Just Another Hand',
					'Just Me Again Down Here' => 'Just Me Again Down Here',
					'Kameron' => 'Kameron',
					'Karla' => 'Karla',
					'Kaushan Script' => 'Kaushan Script',
					'Kelly Slab' => 'Kelly Slab',
					'Kenia' => 'Kenia',
					'Khmer' => 'Khmer',
					'Knewave' => 'Knewave',
					'Kotta One' => 'Kotta One',
					'Koulen' => 'Koulen',
					'Kranky' => 'Kranky',
					'Kreon' => 'Kreon',
					'Kristi' => 'Kristi',
					'Krona One' => 'Krona One',
					'La Belle Aurore' => 'La Belle Aurore',
					'Lancelot' => 'Lancelot',
					'Lato' => 'Lato',
					'League Script' => 'League Script',
					'Leckerli One' => 'Leckerli One',
					'Ledger' => 'Ledger',
					'Lekton' => 'Lekton',
					'Lemon' => 'Lemon',
					'Lilita One' => 'Lilita One',
					'Limelight' => 'Limelight',
					'Linden Hill' => 'Linden Hill',
					'Lobster' => 'Lobster',
					'Lobster Two' => 'Lobster Two',
					'Londrina Outline' => 'Londrina Outline',
					'Londrina Shadow' => 'Londrina Shadow',
					'Londrina Sketch' => 'Londrina Sketch',
					'Londrina Solid' => 'Londrina Solid',
					'Lora' => 'Lora',
					'Love Ya Like A Sister' => 'Love Ya Like A Sister',
					'Loved by the King' => 'Loved by the King',
					'Lovers Quarrel' => 'Lovers Quarrel',
					'Luckiest Guy' => 'Luckiest Guy',
					'Lusitana' => 'Lusitana',
					'Lustria' => 'Lustria',
					'Macondo' => 'Macondo',
					'Macondo Swash Caps' => 'Macondo Swash Caps',
					'Magra' => 'Magra',
					'Maiden Orange' => 'Maiden Orange',
					'Mako' => 'Mako',
					'Marck Script' => 'Marck Script',
					'Marko One' => 'Marko One',
					'Marmelad' => 'Marmelad',
					'Marvel' => 'Marvel',
					'Mate' => 'Mate',
					'Mate SC' => 'Mate SC',
					'Maven Pro' => 'Maven Pro',
					'Meddon' => 'Meddon',
					'MedievalSharp' => 'MedievalSharp',
					'Medula One' => 'Medula One',
					'Megrim' => 'Megrim',
					'Merienda One' => 'Merienda One',
					'Merriweather' => 'Merriweather',
					'Metal' => 'Metal',
					'Metamorphous' => 'Metamorphous',
					'Metrophobic' => 'Metrophobic',
					'Michroma' => 'Michroma',
					'Miltonian' => 'Miltonian',
					'Miltonian Tattoo' => 'Miltonian Tattoo',
					'Miniver' => 'Miniver',
					'Miss Fajardose' => 'Miss Fajardose',
					'Modern Antiqua' => 'Modern Antiqua',
					'Molengo' => 'Molengo',
					'Monofett' => 'Monofett',
					'Monoton' => 'Monoton',
					'Monsieur La Doulaise' => 'Monsieur La Doulaise',
					'Montaga' => 'Montaga',
					'Montez' => 'Montez',
					'Montserrat' => 'Montserrat',
					'Moul' => 'Moul',
					'Moulpali' => 'Moulpali',
					'Mountains of Christmas' => 'Mountains of Christmas',
					'Mr Bedfort' => 'Mr Bedfort',
					'Mr Dafoe' => 'Mr Dafoe',
					'Mr De Haviland' => 'Mr De Haviland',
					'Mrs Saint Delafield' => 'Mrs Saint Delafield',
					'Mrs Sheppards' => 'Mrs Sheppards',
					'Muli' => 'Muli',
					'Mystery Quest' => 'Mystery Quest',
					'Neucha' => 'Neucha',
					'Neuton' => 'Neuton',
					'News Cycle' => 'News Cycle',
					'Niconne' => 'Niconne',
					'Nixie One' => 'Nixie One',
					'Nobile' => 'Nobile',
					'Nokora' => 'Nokora',
					'Norican' => 'Norican',
					'Nosifer' => 'Nosifer',
					'Nothing You Could Do' => 'Nothing You Could Do',
					'Noticia Text' => 'Noticia Text',
					'Nova Cut' => 'Nova Cut',
					'Nova Flat' => 'Nova Flat',
					'Nova Mono' => 'Nova Mono',
					'Nova Oval' => 'Nova Oval',
					'Nova Round' => 'Nova Round',
					'Nova Script' => 'Nova Script',
					'Nova Slim' => 'Nova Slim',
					'Nova Square' => 'Nova Square',
					'Numans' => 'Numans',
					'Nunito' => 'Nunito',
					'Odor Mean Chey' => 'Odor Mean Chey',
					'Old Standard TT' => 'Old Standard TT',
					'Oldenburg' => 'Oldenburg',
					'Oleo Script' => 'Oleo Script',
					'Open Sans' => 'Open Sans',
					'Open Sans Condensed' => 'Open Sans Condensed',
					'Orbitron' => 'Orbitron',
					'Original Surfer' => 'Original Surfer',
					'Oswald' => 'Oswald',
					'Over the Rainbow' => 'Over the Rainbow',
					'Overlock' => 'Overlock',
					'Overlock SC' => 'Overlock SC',
					'Ovo' => 'Ovo',
					'Oxygen' => 'Oxygen',
					'PT Mono' => 'PT Mono',
					'PT Sans' => 'PT Sans',
					'PT Sans Caption' => 'PT Sans Caption',
					'PT Sans Narrow' => 'PT Sans Narrow',
					'PT Serif' => 'PT Serif',
					'PT Serif Caption' => 'PT Serif Caption',
					'Pacifico' => 'Pacifico',
					'Parisienne' => 'Parisienne',
					'Passero One' => 'Passero One',
					'Passion One' => 'Passion One',
					'Patrick Hand' => 'Patrick Hand',
					'Patua One' => 'Patua One',
					'Paytone One' => 'Paytone One',
					'Permanent Marker' => 'Permanent Marker',
					'Petrona' => 'Petrona',
					'Philosopher' => 'Philosopher',
					'Piedra' => 'Piedra',
					'Pinyon Script' => 'Pinyon Script',
					'Plaster' => 'Plaster',
					'Play' => 'Play',
					'Playball' => 'Playball',
					'Playfair Display' => 'Playfair Display',
					'Podkova' => 'Podkova',
					'Poiret One' => 'Poiret One',
					'Poller One' => 'Poller One',
					'Poly' => 'Poly',
					'Pompiere' => 'Pompiere',
					'Pontano Sans' => 'Pontano Sans',
					'Port Lligat Sans' => 'Port Lligat Sans',
					'Port Lligat Slab' => 'Port Lligat Slab',
					'Prata' => 'Prata',
					'Preahvihear' => 'Preahvihear',
					'Press Start 2P' => 'Press Start 2P',
					'Princess Sofia' => 'Princess Sofia',
					'Prociono' => 'Prociono',
					'Prosto One' => 'Prosto One',
					'Puritan' => 'Puritan',
					'Quantico' => 'Quantico',
					'Quattrocento' => 'Quattrocento',
					'Quattrocento Sans' => 'Quattrocento Sans',
					'Questrial' => 'Questrial',
					'Quicksand' => 'Quicksand',
					'Qwigley' => 'Qwigley',
					'Radley' => 'Radley',
					'Raleway' => 'Raleway',
					'Rammetto One' => 'Rammetto One',
					'Rancho' => 'Rancho',
					'Rationale' => 'Rationale',
					'Redressed' => 'Redressed',
					'Reenie Beanie' => 'Reenie Beanie',
					'Revalia' => 'Revalia',
					'Ribeye' => 'Ribeye',
					'Ribeye Marrow' => 'Ribeye Marrow',
					'Righteous' => 'Righteous',
					'Roboto' => 'Roboto',
					'Roboto Condensed' => 'Roboto Condensed',
					'Rochester' => 'Rochester',
					'Rock Salt' => 'Rock Salt',
					'Rokkitt' => 'Rokkitt',
					'Ropa Sans' => 'Ropa Sans',
					'Rosario' => 'Rosario',
					'Rosarivo' => 'Rosarivo',
					'Rouge Script' => 'Rouge Script',
					'Ruda' => 'Ruda',
					'Ruge Boogie' => 'Ruge Boogie',
					'Ruluko' => 'Ruluko',
					'Ruslan Display' => 'Ruslan Display',
					'Russo One' => 'Russo One',
					'Ruthie' => 'Ruthie',
					'Sail' => 'Sail',
					'Salsa' => 'Salsa',
					'Sanchez' => 'Sanchez',
					'Sancreek' => 'Sancreek',
					'Sansita One' => 'Sansita One',
					'Sarina' => 'Sarina',
					'Satisfy' => 'Satisfy',
					'Schoolbell' => 'Schoolbell',
					'Seaweed Script' => 'Seaweed Script',
					'Sevillana' => 'Sevillana',
					'Shadows Into Light' => 'Shadows Into Light',
					'Shadows Into Light Two' => 'Shadows Into Light Two',
					'Shanti' => 'Shanti',
					'Share' => 'Share',
					'Shojumaru' => 'Shojumaru',
					'Short Stack' => 'Short Stack',
					'Siemreap' => 'Siemreap',
					'Sigmar One' => 'Sigmar One',
					'Signika' => 'Signika',
					'Signika Negative' => 'Signika Negative',
					'Simonetta' => 'Simonetta',
					'Sirin Stencil' => 'Sirin Stencil',
					'Six Caps' => 'Six Caps',
					'Slackey' => 'Slackey',
					'Smokum' => 'Smokum',
					'Smythe' => 'Smythe',
					'Sniglet' => 'Sniglet',
					'Snippet' => 'Snippet',
					'Sofia' => 'Sofia',
					'Sonsie One' => 'Sonsie One',
					'Sorts Mill Goudy' => 'Sorts Mill Goudy',
					'Special Elite' => 'Special Elite',
					'Spicy Rice' => 'Spicy Rice',
					'Spinnaker' => 'Spinnaker',
					'Spirax' => 'Spirax',
					'Squada One' => 'Squada One',
					'Stardos Stencil' => 'Stardos Stencil',
					'Stint Ultra Condensed' => 'Stint Ultra Condensed',
					'Stint Ultra Expanded' => 'Stint Ultra Expanded',
					'Stoke' => 'Stoke',
					'Sue Ellen Francisco' => 'Sue Ellen Francisco',
					'Sunshiney' => 'Sunshiney',
					'Supermercado One' => 'Supermercado One',
					'Suwannaphum' => 'Suwannaphum',
					'Swanky and Moo Moo' => 'Swanky and Moo Moo',
					'Syncopate' => 'Syncopate',
					'Tangerine' => 'Tangerine',
					'Taprom' => 'Taprom',
					'Telex' => 'Telex',
					'Tenor Sans' => 'Tenor Sans',
					'The Girl Next Door' => 'The Girl Next Door',
					'Tienne' => 'Tienne',
					'Tinos' => 'Tinos',
					'Titan One' => 'Titan One',
					'Trade Winds' => 'Trade Winds',
					'Trocchi' => 'Trocchi',
					'Trochut' => 'Trochut',
					'Trykker' => 'Trykker',
					'Tulpen One' => 'Tulpen One',
					'Ubuntu' => 'Ubuntu',
					'Ubuntu Condensed' => 'Ubuntu Condensed',
					'Ubuntu Mono' => 'Ubuntu Mono',
					'Ultra' => 'Ultra',
					'Uncial Antiqua' => 'Uncial Antiqua',
					'UnifrakturCook' => 'UnifrakturCook',
					'UnifrakturMaguntia' => 'UnifrakturMaguntia',
					'Unkempt' => 'Unkempt',
					'Unlock' => 'Unlock',
					'Unna' => 'Unna',
					'VT323' => 'VT323',
					'Varela' => 'Varela',
					'Varela Round' => 'Varela Round',
					'Vast Shadow' => 'Vast Shadow',
					'Vibur' => 'Vibur',
					'Vidaloka' => 'Vidaloka',
					'Viga' => 'Viga',
					'Voces' => 'Voces',
					'Volkhov' => 'Volkhov',
					'Vollkorn' => 'Vollkorn',
					'Voltaire' => 'Voltaire',
					'Waiting for the Sunrise' => 'Waiting for the Sunrise',
					'Wallpoet' => 'Wallpoet',
					'Walter Turncoat' => 'Walter Turncoat',
					'Wellfleet' => 'Wellfleet',
					'Wire One' => 'Wire One',
					'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
					'Yellowtail' => 'Yellowtail',
					'Yeseva One' => 'Yeseva One',
					'Yesteryear' => 'Yesteryear',
					'Zeyada' => 'Zeyada'
				);
				
				$fonts=array_merge($fonts, $option['options']);
				asort($fonts);
				
				$out.=self::renderOption(array(
					'id' => $option['id'],
					'type' => 'select',
					'wrap' => false,
					'default' => $value,
					'options' => $fonts,
				));
			break;
			
			//checkbox
			case 'checkbox':			
				$checked='';
				if($value=='true') {
					$checked='checked="checked"';
				}
				$out.='<input type="checkbox" id="'.$option['id'].'" name="'.$option['id'].'" value="true" '.$checked.' '.$attributes.' />';
				if(isset($option['name'])) {
					$out.='<label for="'.$option['id'].'">'.$option['name'].'</label>';
				}				
			break;
			
			//colorpicker
			case 'color':
				$out.='<div id="'.$option['id'].'_picker" class="colorSelector themex_color"><div></div></div>';
				$out.='<input name="'.$option['id'].'" id="'.$option['id'].'" type="text" value="'.$value.'" '.$attributes.' />';
			break;
			
			//uploader
			case 'uploader':
				$out.='<input name="'.$option['id'].'" id="'.$option['id'].'" type="text" value="'.$value.'" '.$attributes.' />';
				$out.='<div class="themex_button upload_button">'.__('Browse','travel2').'</div>';
			break;
			
			//image selector
			case 'select_image':
				if(is_array($option['options'])) {
					foreach($option['options'] as $key=>$image_url) {
						$out.='<image src="'.$image_url.'" alt="'.$key.'" />';
					}
				}
				$out.='<input name="'.$option['id'].'" id="'.$option['id'].'" type="hidden" value="'.$value.'" '.$attributes.' />';
			break;
			
			//post selector
			case 'select_post':				
				$query=new WP_Query( array('showposts'=>-1, 'post_type' => $option['post_type'], 'orderby' => 'title', 'order' => 'ASC') );				
				parse_str($value,$value_arr);
				$temp_post=$post;
				
				$multiple='';
				if(isset($option['attributes']['multiple'])) {
					$multiple='[]';
				}		

				$out.='<select id="'.$option['id'].'" name="'.$option['id'].$multiple.'" '.$attributes.'>';

				if(isset($option['default_option'])) {
					$out.='<option value="default">'.$option['default_option'].'</option>';
				}
				
				if($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();
						$selected='';
						if(in_array((string)$post->ID, $value_arr) || $post->ID==$value) {
							$selected='selected="selected"';
						}
						$out.='<option value="'.$post->ID.'" '.$selected.'>'.$post->post_title.'</option>';
					}
				}									
				$out.='</select>';
				$post=$temp_post;
			break;
			
			//slider
			case 'slider':
				$out.='<div class="themex_slider"></div><div class="slider_value"></div>';
				$out.='<div class="max_value hidden">'.$option['attributes']['max_value'].'</div>';
				$out.='<div class="min_value hidden">'.$option['attributes']['min_value'].'</div>';
				$out.='<div class="unit hidden">'.$option['attributes']['unit'].'</div>';
				$out.='<input name="'.$option['id'].'" id="'.$option['id'].'" type="hidden" value="'.$value.'" />';
			break;
			
			//gallery
			case 'gallery':				
				parse_str(html_entity_decode(urldecode($value)),$value_arr);
			
				$out.='<a class="repeatable-add button" style="float:left;" href="#">'.__('Add Field','travel2').'</a>';								
				if ($value) {
					$i = 0;	
					foreach($value_arr as $row) {						
						$out.='<tr class="repeatable-field '.$option['id'].'" style="border-top:1px solid #eeeeee;"><th style="width:25%"></th><td><input placeholder="'.__('URL','travel2').'" type="text" name="'.$option['id'].'['.$i.']" id="'.$option['id'].'['.$i.']" class="'.$option['class'].'" value="'.$row.'" style="width:70%; margin-right: 20px; float:left;" /><a style="float: left;" href="#" class="button image-button repeatable-upload">'.__('Browse','travel2').'</a><a style="float:left;margin-left:10px;" class="repeatable-remove button" href="#">'.__('Remove','travel2').'</a></td></tr>';
						$i++;
					}
				} else {
						$out.='<tr class="repeatable-field '.$option['id'].'" style="border-top:1px solid #eeeeee;"><th style="width:25%"></th><td><input placeholder="'.__('URL','travel2').'" type="text" name="'.$option['id'].'[0]" id="'.$option['id'].'[0]" class="'.$option['class'].'" value="" style="width:70%; margin-right: 20px; float:left;" /><a style="float: left;" href="#" class="button image-button repeatable-upload">'.__('Browse','travel2').'</a><a style="float:left;margin-left:10px;" class="repeatable-remove button" href="#">'.__('Remove','travel2').'</a></td></tr>';
				}
			break;
			
			//days
			case 'days':				
				parse_str(html_entity_decode(urldecode($value)),$value_arr);
			
				$out.='<a class="repeatable-add button" style="float:left;" href="#">'.__('Add Field','travel2').'</a>';								
				if ($value) {
					$i = 0;	
					foreach($value_arr as $row) {
						$out.='<tr class="repeatable-field '.$option['id'].'" style="border-top:1px solid #eeeeee;"><th style="width:25%"></th><td>';
						$out.=ThemexInterface::renderOption(array(
						'type'=>'select',
						'id'=>$option['id'].'['.$i.']',
						'before'=>'<div style="width:40%;float:left;margin-right:40px;">',
						'after'=>'</div>',
						'default'=>$row,
						'options'=>array(
							'date'=>__('Departure Date','travel2'),							
							'1'=>__('Monday','travel2'),
							'2'=>__('Tuesday','travel2'),
							'3'=>__('Wednesday','travel2'),
							'4'=>__('Thursday','travel2'),
							'5'=>__('Friday','travel2'),
							'6'=>__('Saturday','travel2'),
							'7'=>__('Sunday','travel2'),
						),
						'attributes'=>array(
							'name'=>$option['id'].'['.$i.']',
						),
					));
						$out.='<a style="float:left;margin-left:10px;" class="repeatable-remove button" href="#">'.__('Remove','travel2').'</a></td></tr>';
						$i++;
					}
				} else {
					$out.='<tr class="repeatable-field '.$option['id'].'" style="border-top:1px solid #eeeeee;"><th style="width:25%"></th><td>';
					$out.=ThemexInterface::renderOption(array(
						'type'=>'select',
						'id'=>$option['id'].'[0]',
						'before'=>'<div style="width:40%;float:left;margin-right:40px;">',
						'after'=>'</div>',
						'options'=>array(
							'date'=>__('Departure Date','travel2'),							
							'monday'=>__('Monday','travel2'),
							'tuesday'=>__('Tuesday','travel2'),
							'wednesday'=>__('Wednesday','travel2'),
							'thursday'=>__('Thursday','travel2'),
							'friday'=>__('Friday','travel2'),
							'saturday'=>__('Saturday','travel2'),
							'sunday'=>__('Sunday','travel2'),
						),
						'attributes'=>array(
							'name'=>$option['id'].'[0]',
						),
					));
					$out.='<a style="float:left;margin-left:10px;" class="repeatable-remove button" href="#">'.__('Remove','travel2').'</a></td></tr>';
				}
			break;
			
			//links
			case 'links':		
				parse_str(html_entity_decode(urldecode($value)),$value_arr);

				$out.='<a class="repeatable-add button" style="float:left;" href="#">'.__('Add Field','travel2').'</a>';								
				if ($value) {
					$i = 0;	
					foreach($value_arr as $row) {						
						$out.='<tr class="repeatable-field '.$option['id'].'" style="border-top:1px solid #eeeeee;"><th style="width:25%"></th><td><input placeholder="'.__('Label','travel2').'" type="text" name="'.$option['id'].'['.$i.'][label]" id="'.$option['id'].'['.$i.'][label]" class="'.$option['class'].'" value="'.$row['label'].'" style="width:35%; margin-right: 20px; float:left;" /><input placeholder="'.__('URL','travel2').'" type="text" name="'.$option['id'].'['.$i.'][url]" id="'.$option['id'].'['.$i.'][url]" class="'.$option['class'].'" value="'.$row['url'].'" size="30" style="width:40%; margin-right: 20px; float:left;" /><a style="float:left;" class="repeatable-remove button" href="#">'.__('Remove','travel2').'</a></td></tr>';
						$i++;
					}
				} else {
					$out.='<tr class="repeatable-field '.$option['id'].'" style="border-top:1px solid #eeeeee;"><th style="width:25%"></th><td><input placeholder="'.__('Label','travel2').'" type="text" name="'.$option['id'].'[0][label]" id="'.$option['id'].'[0][label]" class="'.$option['class'].'" value="" style="width:35%; margin-right: 20px; float:left;" /><input placeholder="'.__('URL','travel2').'" type="text" name="'.$option['id'].'[0][url]" id="'.$option['id'].'[0][url]" class="'.$option['class'].'" value="" size="30" style="width:40%; margin-right: 20px; float:left;" /><a style="float:left;" class="repeatable-remove button" href="#">'.__('Remove','travel2').'</a></td></tr>';
				}
			break;
			
			//Render module settings
			default:			
				if(isset(ThemexCore::$modules[$option['type']]) && method_exists(ThemexCore::$modules[$option['type']],'renderSettings')) {
					$out.=call_user_func(array(ThemexCore::$modules[$option['type']],'renderSettings'),$option['id']);	
				}
			break;
			
		}
		
		//add elements after
		if(isset($option['after'])) {
			$out=$out.$option['after'];
		}
		
		if($option['type']!='page' && (!isset($option['wrap']) || $option['wrap'])) {
			$out.='<div class="clear"></div></div>';
		}		
		
		return $out;
	}	
	
	//Render dropdown menu
	public static function renderDropdownMenu($slug='') {
		$locations = get_nav_menu_locations();		
		$menu=wp_get_nav_menu_object( $locations[ $slug ] );
		
		if(isset($menu->term_id)) {		
			$menu_items=wp_get_nav_menu_items($menu->term_id);
			
			$out= '<select>';
			foreach ( (array) $menu_items as $key => $menu_item ) {
				$out.='<option value="'.$menu_item->url.'">'.$menu_item->title.'</option>';
			}
			$out.='</select>';		
			echo $out;		
		} else {
			wp_dropdown_pages();
		}
	}

}
?>
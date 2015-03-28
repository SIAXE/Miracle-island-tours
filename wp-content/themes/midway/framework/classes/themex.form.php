<?php
//Custom form module
class ThemexForm {

	public static $data;
	public static $id=__CLASS__;
	
	//Init module
	public static function init() {
		
		//ajax actions
		add_action('wp_ajax_themex_form', array(__CLASS__,'processData'));
		add_action('wp_ajax_nopriv_themex_form', array(__CLASS__,'processData'));
	
	}

	//Refresh module stored data
	public static function refresh() {
		self::$data=ThemexCore::getOption(self::$id);
	}
	
	//Change module stored data
	public static function change() {
	
		//refresh stored data
		self::refresh();
		
		//set action type
		$type=$_POST['type'];
		
		//choose method
		if($type=='add_field') {
			self::addField($_POST['slug']);
		} else if($type=='remove_field') {
			self::removeField($_POST['slug'], $_POST['field_id']);
		}
		
	}
	
	//Save module static data
	public static function save() {
		ThemexCore::updateOption(self::$id,self::$data);
	}
	
	//Save module settings
	public static function saveSettings($data) {
	
		//refresh stored data
		self::refresh();
		
		//search for widget areas options
		foreach($data as $key=>$value) {		
			if($key==self::$id) {				
				self::$data=$value;
			}
		}	
		
		//save static data
		self::save();
	}
	
	//Render module settings
	public static function renderSettings($slug) {
	
		//get module stored data
		self::refresh();
		$out='<div class="themex_form">';
		
		//description option
		$out.=ThemexInterface::renderOption(array(
				'type' => 'textarea',
				'id' => self::$id.'['.$slug.'][description]',
				'name' => __('Form Description','travel2'),
				'default' => isset(self::$data[$slug]['description'])?self::$data[$slug]['description']:'',
			)
		);
		
		//success message option
		$out.=ThemexInterface::renderOption(array(
				'type' => 'textarea',
				'id' => self::$id.'['.$slug.'][message]',
				'name' => __('Success Message','travel2'),
				'default' => isset(self::$data[$slug]['message'])?self::$data[$slug]['message']:'',
			)
		);
		
		//captcha option
		$out.=ThemexInterface::renderOption(array(
					'type' => 'checkbox',
					'id' => self::$id.'['.$slug.'][captcha]',
					'default' => isset(self::$data[$slug]['captcha'])?self::$data[$slug]['captcha']:'false',
					'name' => __('Enable Captcha Protection','travel2')
				)
		);
		
		//settings for stored fields
		if(isset(self::$data[$slug]['fields']) && is_array(self::$data[$slug]['fields'])) {
		
			foreach(self::$data[$slug]['fields'] as $field_id=>$field) {
			
				$out.='<div class="themex_section" id="'.$field_id.'">';
				
				//field type
				$out.=ThemexInterface::renderOption(array(
						'type' => 'select',
						'name' => __('Field Type','travel2'),
						'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][type]',
						'default' => ThemexCore::getArrayValue(self::$data[$slug]['fields'][$field_id],'type',''),
						'options' => array(
							'text'=>__('Text','travel2'),
							'message'=>__('Message','travel2'),
							'checkbox'=>__('Checkbox','travel2'),
							'number'=>__('Number','travel2'),
							'date'=>__('Date','travel2'),
							'email'=>__('Email','travel2'),
							'select'=>__('Select','travel2'),							
						),
					)
				);
				
				//field label
				$out.=ThemexInterface::renderOption(array(
						'type' => 'text',
						'name' => __('Field Label','travel2'),
						'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][label]',
						'default' => ThemexCore::getArrayValue(self::$data[$slug]['fields'][$field_id],'label',''),
					)
				);	
				
				//field options
				$out.=ThemexInterface::renderOption(array(
						'type' => 'text',
						'description' => __('Enter in comma separated options.','travel2'),
						'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][options]',
						'default' => ThemexCore::getArrayValue(self::$data[$slug]['fields'][$field_id],'options',''),
						'hidden' => true,
						'name' => __('Field Options','travel2')
					)
				);	
				
				//actions
				$out.='<div class="themex_icon add_field" data-slug="'.$slug.'"></div><div class="themex_icon remove_field" data-slug="'.$slug.'" data-id="'.$field_id.'"></div>';
				
				//close section
				$out.='</div>';
			
			}
			
		//default settings
		} else {
		
			//generate field id
			$field_id=uniqid();
			
			$out.='<div class="themex_section" id="'.$field_id.'">';
		
			//field type
			$out.=ThemexInterface::renderOption(array(
						'type' => 'select',
						'name' => __('Field Type','travel2'),
						'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][type]',
						'std' => isset(self::$data[$slug]['fields'][$field_id]['type'])?self::$data[$slug]['fields'][$field_id]['type']:'text',
						'options' => array(
							'text'=>__('Text','travel2'),
							'message'=>__('Message','travel2'),
							'checkbox'=>__('Checkbox','travel2'),
							'number'=>__('Number','travel2'),
							'date'=>__('Date','travel2'),
							'email'=>__('Email','travel2'),
							'select'=>__('Select','travel2'),							
						),		
					)
				);
			
			//field label
			$out.=ThemexInterface::renderOption(array(
						'type' => 'text',
						'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][label]',
						'name' => __('Field Label','travel2'),
					)
				);
				
			//field options
			$out.=ThemexInterface::renderOption(array(
					'type' => 'text',
					'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][options]',
					'description' => __('Enter in comma separated options.','travel2'),
					'hidden' => true,
					'name' => __('Field Options','travel2')
				)
			);
				
			//actions
			$out.='<div class="themex_icon add_field" data-slug="'.$slug.'"></div><div class="themex_icon remove_field" data-slug="'.$slug.'" data-id="'.$field_id.'"></div>';
				
			//close section
			$out.='</div>';
			
			//save field
			self::$data[$slug]['fields'][$field_id]=array();
			
			self::save();
				
		}

		$out.='</div>';
		
		return $out;
		
	}
	
	public static function renderData($slug, $after='') {
	
		//refresh stored settings
		self::refresh();
		
		//enqueue script
		wp_enqueue_script( 'themex_form', THEMEX_URI.'extensions/themex-form/jquery.form.js' );
		
		$date_format=ThemexCore::getOption('date_format','m/d/Y')=='m/d/Y'?'mm/dd/yy':'dd/mm/yy';
		$out='<div class="'.$slug.' formatted-form" id="'.$slug.'"><div class="themex-form-message"></div>';		
		$out.='<form class="themex-form" name="'.$slug.'" >';
		
		//description
		if(isset(self::$data[$slug]['description'])) {
			$out.='<p>'.self::$data[$slug]['description'].'</p>';
		}
		
		//render each form field
		if(is_array(self::$data[$slug]['fields'])) {
			$index=0;
			
			foreach(self::$data[$slug]['fields'] as $field_id=>$field) {			
				$option=array();
				
				switch($field['type']) {
				
					case 'message':
						$option['type']='textarea';			
					break;
					
					case 'select':
						$option['type']='select';
						$option['options']=explode(',', $field['options']);	
						$new_options=array($field['label'] => $field['label']);
						
						foreach($option['options'] as $key=>$value) {
							$new_options[trim($value)]=trim($value);
						}
						$option['options']=$new_options;
					break;
					
					case 'date':
						$option['type']='date';	
					break;
					
					case 'checkbox':
						$option['type']='checkbox';	
						$option['name']=$field['label'];
					break;
					
					default:
						$option['type']='text';
					break;
					
				}
				
				$option['id']=$field_id;
				$option['attributes']=array( 
					'data-validation' => $field['type'],
					'placeholder' => $field['label'],
				);				
				
				if(isset($field['type']) && !in_array($field['type'], array('message', 'checkbox'))) {
					$out.='<div class="sixcol column ';
					if(($index+1) % 2==0) {
						$out.='last';
					}
					$out.='">';
				}
				
				$out.='<div class="clear"></div><div class="field-wrapper">'.ThemexInterface::renderOption($option).'</div>';
				
				if(isset($field['type']) && !in_array($field['type'], array('message', 'checkbox'))) {
					$out.='</div>';
				}
				
				$index++;
			}
		}
		
		if(isset(self::$data[$slug]['captcha']) && self::$data[$slug]['captcha']=='true') {
			$out.='<div class="captcha" id="themex_form_captcha">';			
			$out.='<img src="'.THEMEX_URI.'extensions/themex-form/captcha.php" alt="" />';
			$out.='<input name="themex_form_captcha" type="text" id="themex_form_captcha" size="6" value="" />';
			$out.='</div>';
		}
		
		$out.='<div class="clear"></div><a class="submit button" href="#" data-slug="'.$slug.'"><span>'.__('Submit','travel2').'</span></a>';
		$out.='<div class="formatted-form-loader"></div><div class="clear"></div>';		
		$out.='<input type="hidden" class="date-format" value="'.$date_format.'" />'.$after.'</form></div>';
		
		echo $out;
	
	}
	
	//Process user data
	public static function processData() {
	
		//refresh stored settings
		self::refresh();
	
		parse_str($_POST['data'], $data);
	
		//get captcha
		session_start();
		$posted_code=md5($data['themex_form_captcha']);
		$session_code = $_SESSION['captcha'];
		
		//check errors		
		if(is_array(self::$data[$data['slug']]['fields'])) {
			$errors='';
			
			//check captcha
			if($session_code != $posted_code && self::$data[$data['slug']]['captcha']=='true') {
				$errors.='<li>'.__('The verification code you entered is incorrect','travel2').'.</li>';
			}
			
			//check fields
			foreach(self::$data[$data['slug']]['fields'] as $field_id=>$field) {
				$value=$data[$field_id];
				if(trim($value)=='' && $field['type']!='checkbox') {
					$errors.='<li>"'.$field['label'].'" '.__('field is required','travel2').'</li>';
				}
				if($field['type']=='number' && !is_numeric($value) && $value!='') {
					$errors.='<li>"'.$field['label'].'" '.__('field can only contain numbers','travel2').'.</li>';
				}
				if($field['type']=='email' && !preg_match("/^([a-zA-Z0-9_\.-]+)@([a-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/",$value) && $value!='') {
					$errors.='<li>'.__('You have entered an invalid email address','travel2').'.</li>';
				}
			}
		}

		//errors response
		if($errors != '') {
			echo '<ul class="list-5 styled-list error">'.$errors.'</ul>';		
		//send email
		} else {
			//message
			$message='';			
			if(is_array(self::$data[$data['slug']]['fields'])) {
				if(isset($data[$data['slug'].'_tour_id'])) {					
					$message.=__('Tour','travel2').': '.get_the_title(intval($data[$data['slug'].'_tour_id'])).PHP_EOL;					
				}				
					
				foreach(self::$data[$data['slug']]['fields'] as $field_id=>$field) {
					if($field['type']=='checkbox') {						
						if($data[$field_id]=='true') {
							$data[$field_id]=__('Yes', 'travel2');
						} else {
							$data[$field_id]=__('No', 'travel2');
						}
					}
				
					$message.=self::$data[$data['slug']]['fields'][$field_id]['label'].': '.$data[$field_id].PHP_EOL;
				}
			}

			//save message
			if($data['slug']=='booking_form' && isset($_SESSION['payment_id'])) {
				$_SESSION['payment_message']=$message;
			}
			
			//send message
			if(self::sendEmail($message, $data['slug'])) {
				echo '<ul class="list-3 styled-list success"><li>'.self::$data[$data['slug']]['message'].'</li></ul>';
			}
		}		
		
		die();
		
	}
	
	public static function sendEmail($message, $slug='') {		
		//headers
		$headers = "MIME-Version: 1.0" . PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
		
		//subject
		$subject=__('Feedback','travel2');
		if($slug=='booking_form') {
			$subject=__('Booking','travel2');
		} else if ($slug=='question_form') {
			$subject=__('Question','travel2');
		}
		
		//address
		$address=get_option('admin_email');
		
		if(wp_mail($address, $subject, $message, $headers)) {
			return true;
		}
		return false;
	}
	
	//Add form field
	public static function addField($slug) {
		
		//generate field id
		$field_id=uniqid();
		
		self::$data[$slug]['fields'][$field_id]=array();	
		
		//save static data
		self::save();
				
		//server response
		$out='<div class="themex_section hidden" id="'.$field_id.'">';
	
		//field type
		$out.=ThemexInterface::renderOption(array(
					'type' => 'select',
					'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][type]',
					'std' => self::$data[$slug]['fields'][$field_id]['type'],
					'name' => __('Field Type','travel2'),
					'options' => array(
						'text'=>__('Text','travel2'),
						'message'=>__('Message','travel2'),
						'checkbox'=>__('Checkbox','travel2'),
						'number'=>__('Number','travel2'),
						'date'=>__('Date','travel2'),
						'email'=>__('Email','travel2'),
						'select'=>__('Select','travel2'),
					),
				)
			);
		
		//field label
		$out.=ThemexInterface::renderOption(array(
					'type' => 'text',
					'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][label]',
					'name' => __('Field Label','travel2')
				)
			);
			
		//field options
		$out.=ThemexInterface::renderOption(array(
				'type' => 'text',
				'id' => self::$id.'['.$slug.'][fields]['.$field_id.'][options]',
				'default' => self::$data[$slug]['fields'][$field_id]['options'],
				'parent' => array(self::$id.'['.$slug.']['.$field_id.'][type]','email'),
				'description' => __('Enter in comma separated options.','travel2'),
				'name' => __('Field Options','travel2')			
			)
		);
			
		//action buttons
		$out.='<div class="themex_icon add_field" data-slug="'.$slug.'"></div><div class="themex_icon remove_field" data-slug="'.$slug.'"></div>';
			
		//close section
		$out.='</div>';			

		echo $out;
		
	}
	
	//Remove form field
	public static function removeField($slug, $field_id) {
		
		if(count(self::$data[$slug]['fields'])>1) {

			//unset current field
			unset(self::$data[$slug]['fields'][$field_id]);
			
		}
		
		//save fields
		self::save();
		
	}
	
}
?>
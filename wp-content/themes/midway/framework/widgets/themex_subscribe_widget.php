<?php
//Widget Name: Subscribe Widget

class themex_subscribe_widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array( 'classname' => 'widget-subscribe', 'description' => __('Mailing list subscription form.', 'miracleisland') );

		//Controls
		$controls = array( 'width' => 300, 'height' => 300, 'id_base' => __CLASS__ );

		//Creation
		$this->WP_Widget( __CLASS__, __('Newsletter','miracleisland'), $settings, $controls );
		
		//Ajax actions
		add_action('wp_ajax_themex_subscribe', array(__CLASS__,'updateData'));
		add_action('wp_ajax_nopriv_themex_subscribe', array(__CLASS__,'updateData'));
	}

	//Widget view
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Newsletter','miracleisland' ) : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget;
		echo $before_title.$title.$after_title;
		?>
		<p><?php echo $instance['text']; ?></p>
		<form id="subscribe_form">			
			<input type="text" id="email" value="<?php _e('Email Address','miracleisland'); ?>" />
		</form>
		<?php
		echo $after_widget;
	}

	//Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
		return $instance;
	}
	
	//Update data
	function updateData() {
		$email=$_POST['email'];
		if($email=='') {
			$out='<ul class="list-5 styled-list error"><li>'.__('Email field is required.','miracleisland').'</li></ul>';
		} else if(!preg_match("/^[^@]*@[^@]*\.[^@]*$/", $email)) {
			$out='<ul class="list-5 styled-list error"><li>'.__('Email address is incorrect.','miracleisland').'</li></ul>';
		} else {
			$mail_list=get_option('themex_mailing_list');
			if($mail_list) {			
				$mail_list=explode(', ',$mail_list);
			} else {
				$mail_list=array();
			}
			//check equal emails
			if(!in_array($email,$mail_list)) {
				$mail_list[]=$email;
				update_option('themex_mailing_list',implode(', ',$mail_list));
				$out='<ul class="list-3 styled-list success"><li>'.__('Thank you for subscribing!','miracleisland').'</li></ul>';	
			} else {
				$out='<ul class="list-5 styled-list error"><li>'.__('This email is already in the list.','miracleisland').'</li></ul>';
			}
		}
		echo $out;
		die();
	}
	
	//Widget form
	function form( $instance ) {
		//Defaults
		$defaults = array();
		$instance = wp_parse_args( (array)$instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'miracleisland'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text', 'miracleisland'); ?>:</label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
		</p>
	<?php
	}
}
?>
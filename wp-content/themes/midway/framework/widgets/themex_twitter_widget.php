<?php
//Widget Name: Twitter Widget

class themex_twitter_widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array( 'classname' => 'widget-twitter', 'description' => __('A widget that displays your latest tweets.', 'miracleisland') );

		//Controls
		$controls = array( 'width' => 300, 'height' => 300, 'id_base' => __CLASS__ );

		//Creation
		$this->WP_Widget( __CLASS__, __('Latest Tweets','miracleisland'), $settings, $controls );
	}

	//Widget view
	function widget( $args, $instance ) {
		extract( $args );
		
		if($instance['username']=='') $instance['username']='themextemplates';
		if($instance['number']=='') $instance['number']='3';
		
		echo $before_widget;		
		//show title
		if($instance['title']!='') {
			echo $before_title.$instance['title'].$after_title;
		}
		?>
		<ul class="tweets"></ul>
		<input type="hidden" class="twitter-username" value="<?php echo $instance['username']; ?>" />
		<input type="hidden" class="twitter-number" value="<?php echo $instance['number']; ?>" />
		<?php
		echo $after_widget;
	}

	//Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['number'] = intval($new_instance['number']);
		return $instance;
	}
	
	//Widget form
	function form( $instance ) {
		//Defaults
		$defaults = array('number'=>'3');
		$instance = wp_parse_args( (array)$instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'miracleisland'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', 'miracleisland'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Tweets Number', 'miracleisland'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
	<?php
	}
}
?>
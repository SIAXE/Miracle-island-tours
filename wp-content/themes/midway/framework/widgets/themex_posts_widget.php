<?php
//Widget Name: Posts Widget

class themex_posts_widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array( 'classname' => 'widget-selected-posts', 'description' => __('Posts from selected category.', 'miracleisland') );

		//Controls
		$controls = array( 'width' => 300, 'height' => 300, 'id_base' => __CLASS__ );

		//Creation
		$this->WP_Widget( __CLASS__, __('Selected Posts','miracleisland'), $settings, $controls );
	}

	//Widget view
	function widget( $args, $instance ) {
		extract( $args );		
		$date_format=ThemexCore::getOption('date_format','m/d/Y');
		
		if($instance['number']=='') {
			$instance['number']='3';
		}
		
		$title = empty( $instance['title'] ) ? __( 'Latest Posts','miracleisland' ) : $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		//posts query
		$query = new WP_Query(array(
					'post_type' => 'post',
					'orderby' => $instance['order'],
					'showposts' => $instance['number'],
					'cat' => $instance['category']
				));
		
		echo $before_widget;
		echo $before_title.$title.$after_title;
		?>
		<ul>
		<?php 
		if ($query->have_posts()) : while ( $query->have_posts() ) :
			$query->the_post(); 
			$id=get_the_ID();
		?>
			<li>
				<div class="post">
					<?php if(has_post_thumbnail()) { ?>
					<div class="post-featured-image">
						<div class="featured-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('normal'); ?></a>
						</div>
					</div>
					<div class="post-content">
					<?php } else { ?>
					<div class="fullwidth-block">
					<?php } ?>
						<h6 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						<div class="post-meta">			
							<?php if(comments_open()) { ?>
							<div class="post-comment-count"><?php comments_number( '0', '1', '%' ); ?></div>
							<?php } ?>
							<div class="post-info"><?php echo get_the_time($date_format); ?></div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</li>
		<?php 
		endwhile; 
		endif;
		?>
		</ul>
		<?php
		echo $after_widget;
	}

	//Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['order'] = $new_instance['order'];
		$instance['category'] = $new_instance['category'];
		$instance['number'] = intval($new_instance['number']);
		return $instance;
	}
	
	//Widget form
	function form( $instance ) {
		//Defaults
		$defaults = array('number'=>3);
		$instance = wp_parse_args( (array)$instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'miracleisland'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Posts Number', 'miracleisland'); ?>:</label>
			<input class="widefat" type="number" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Posts Category:', 'miracleisland') ?></label>
			<?php
			$args = array(
				'show_option_all'   => __('All Categories', 'miracleisland'),
				'hide_empty'         => 0, 
				'echo'               => 0,
				'selected'           => $instance['category'],
				'hierarchical'       => 0, 
				'id'				 => $this->get_field_id( 'category' ),
				'name'               => $this->get_field_name( 'category' ),
				'class'              => 'widefat',
				'depth'              => 0,
				'tab_index'          => 0,
				'taxonomy'           => 'category',
				'hide_if_empty'      => false 	
			);	
			echo wp_dropdown_categories( $args );
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order By', 'miracleisland'); ?>:</label>
			<select class="widefat" type="order" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
				<option value="date" <?php if($instance['order']=='date') echo 'selected="selected"'; ?>><?php _e('Date', 'miracleisland') ?></option>
				<option value="rand" <?php if($instance['order']=='rand') echo 'selected="selected"'; ?>><?php _e('Random', 'miracleisland') ?></option>
				<option value="comment_count" <?php if($instance['order']=='comment_count') echo 'selected="selected"'; ?>><?php _e('Comments', 'miracleisland') ?></option>
			</select>
		</p>
	<?php
	}
}
?>
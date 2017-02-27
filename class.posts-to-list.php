<?php 

class Posts_to_List_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'posts_to_list', // base ID
			__('Posts-to-List Widget', 'text-domain'), // Name
			array('description' => __('A widget that creates the list based on post hierarchy', 'text-domain'))
			);
	}

	// frontend display
	public function widget($args, $instance) {
		include('includes/widget.php');
	}
	

	// backend display
	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('', 'text-domain');
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tytuł'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title );?>">
		</p>

		<?php
	}

	// update 
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags( $new_instance['title']) : '';

		return $instance;
	}
}
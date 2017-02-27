<?php

	function add_to_list(&$list, $new_item, $parent_id) {
		
		// no need to seek for parent, main node
		if ($parent_id == 0) {
			array_push($list, $new_item);
			return;
		} 

		// search for ancestor
		for ($i=0; $i < count($list); $i++) {
			if ($list[$i]["id"] == $parent_id) {

				// push element
				array_push($list[$i]["children"], $new_item);
				return;
			}

			// get deeper into structure to find the proper ancestor
			if ($list[$i]["children"]) {
				 add_to_list($list[$i]["children"], $new_item, $parent_id);
			}
		}
	}

	function echo_list($list) {

		if (!$list) return;

		echo "<ul>";
		for ($i=0; $i < count( $list ); $i++) {
			echo "<li>";
			echo "<a href='".$list[$i]["link"]."'>";
			echo $list[$i]["title"];
			echo "</a>";
			echo_list( $list[$i]["children"] );
			echo "</li>";
		}
		echo "</ul>";
	}

	$title = apply_filters('widget_title', $instance['title']);

	$query_args = array (
		'post_type' => 'oferta',
		'nopaging' => 'true',
		'order'	=>	'ASC'
	);

	$loop = new WP_Query ( $query_args );

	$list = array();

	if ($loop->have_posts()) :
		while ($loop->have_posts()) :
			$loop->the_post();

			$item = array(
				'id' => get_the_ID(),
				'order' => get_post_field('menu_order'),
				'title' => get_the_title(),
				'link' => esc_url( get_permalink() ),
				'children' => array()
				);

			add_to_list(
				$list, 
				$item,
				wp_get_post_parent_id()
			);

		endwhile;
	else:
		$outputStr = 'Brak elementów w ofercie.';
	endif;

	// finally display

	echo $args['before_widget'];
	if ($title) echo $args['before_title'] . $title . $args['after_title'];
	echo_list($list);
	echo $args['after_widget'];
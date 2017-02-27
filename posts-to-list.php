<?php 
/**
 * Plugin Name: Posts to list
 * Description: A widget that creates the list based on post hierarchy
 * Version: 1.0
 * Author: Roman Kowalski
 * License: GPL2
 */


 include('class.posts-to-list.php');

 function register_posts_to_list_widget() {
 	register_widget('Posts_to_List_Widget');
 }

 add_action('widgets_init', 'register_posts_to_list_widget');
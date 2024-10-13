<?php 

/**
 * Plugin Name: Related Posts
 * Description: This is a plugin class to lerning hooks and filters
 */

require_once plugin_dir_path(__FILE__) . 'includes/class-related-posts.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-enqueue-styles.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-related-posts-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/get-all-categories.php';
require_once plugin_dir_path(__FILE__) . 'includes/show-loop-html.php';
require_once plugin_dir_path(__FILE__) . 'includes/show-related-posts-html.php';

new Class_Related_Posts();
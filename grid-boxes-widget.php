<?php
/*
Plugin Name: Grid Boxes Widget for Elementor
Description: Grid Boxes Widget for Elementor.
Version: 1.0.2
Author: MagnificSoft
Text Domain: grid-boxes-widget
*/


// Make sure this file is called from within WordPress.
if (!defined('ABSPATH')) {
	exit;
}
// Define constant for plugin version
if (!defined('GRID_BOX_WIDGET_VERSION')) {
    define('GRID_BOX_WIDGET_VERSION', '1.0');
}


function register_grid_boxes_widget($widgets_manager)
{
	require_once( __DIR__ . '/widgets/grid-boxes.php' );
	$widgets_manager->register( new \Grid_Boxes_Widget() );
}

add_action('elementor/widgets/register', 'register_grid_boxes_widget');


/**
 * Register scripts and styles for Elementor test widgets.
 */
function grid_box_widget_dependencies() {

	wp_register_script( 'grid_box_script',
					   plugins_url( 'assets/js/grid-box-widget.js', __FILE__ ),
					   [ 'elementor-frontend','jquery' ], GRID_BOX_WIDGET_VERSION, true  );
	wp_register_style( 'grid_box_style', plugins_url( 'assets/css/grid-box-widget.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'grid_box_widget_dependencies' );

require 'path/to/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'magnific-soft/wp-content/plugins/grid-boxes-widget/grid-boxes-widget.php',
	__FILE__, //Full path to the main plugin file or functions.php.
	'unique-plugin-or-theme-slug'
);
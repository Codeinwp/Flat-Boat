<?php
// add any new or customised functions here
add_action( 'wp_enqueue_scripts', 'flat_boat_enqueue_styles' );
function flat_boat_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	// Loads our main stylesheet.
	wp_enqueue_style( 'flat_boat-child-style', get_stylesheet_uri(), array('flat-style') );
}	
	
if ( ! function_exists( 'flat_boat_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function flat_boat_setup() {
	
		$custom_background_support = array(
			'default-color'          => '',
			'default-image'          => get_stylesheet_directory_uri() . '/assets/img/default-background.jpg',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-background', $custom_background_support ); # @link http://codex.wordpress.org/Custom_Backgrounds
		
		load_child_theme_textdomain( 'flat-boat', get_stylesheet_directory() . '/languages' );

	}
endif;
add_action( 'after_setup_theme', 'flat_boat_setup' );
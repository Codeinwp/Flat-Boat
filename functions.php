<?php
// add any new or customised functions here
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('flatx_bootstrap_style') );
		// Loads our main stylesheet.
		wp_enqueue_style( 'flatx-child-style', get_stylesheet_uri(), array('flatx_style'), 'v1' );
	}
	function remove_style_child(){
		remove_action('wp_print_scripts','flatx_php_style');	
	}
	add_action( 'wp_enqueue_scripts', 'remove_style_child', 100 );
	
	
if ( ! function_exists( 'flat_boat_setup1' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function flat_boat_setup1() {
	
		# Enable WordPress theme features
		add_theme_support( 'automatic-feed-links' ); # @link http://codex.wordpress.org/Automatic_Feed_Links
		$custom_background_support = array(
			'default-color'          => '',
			'default-image'          => get_stylesheet_directory_uri() . '/assets/img/default-background.jpg',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-background', $custom_background_support ); # @link http://codex.wordpress.org/Custom_Backgrounds

	}
endif;
add_action( 'after_setup_theme', 'flat_boat_setup1' );
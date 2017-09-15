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

/**
 * Notice in Customize to announce the theme is not maintained anymore
 */
function flat_boat_customize_register( $wp_customize ) {

	require_once get_stylesheet_directory() . '/class-ti-notify.php';

	$wp_customize->register_section_type( 'Ti_Notify' );

	$wp_customize->add_section(
		new Ti_Notify(
			$wp_customize,
			'ti-notify',
			array( /* translators: Link to the recommended theme */
				'text'     => sprintf( __( 'This theme is not maintained anymore, consider using the parent theme %1$s or check-out our latest free one-page theme: %2$s.','Flat-Boat' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=flat' ) . '">%s</a>', 'Flat' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) ),
				'priority' => 0,
			)
		)
	);

	$wp_customize->add_setting( 'flat-boat-notify', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'flat-boat-notify', array(
		'label'    => __( 'Notification', 'Flat-Boat' ),
		'section'  => 'ti-notify',
		'priority' => 1,
	) );
}
add_action( 'customize_register', 'flat_boat_customize_register' );

/**
 * Notice in admin dashboard to announce the theme is not maintained anymore
 */
function flat_boat_admin_notice() {

	global $pagenow;

	if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
		echo '<div class="updated notice is-dismissible"><p>';
		printf( __( 'This theme is not maintained anymore, consider using the parent theme %1$s or check-out our latest free one-page theme: %2$s.','Flat-Boat' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=flat' ) . '">%s</a>', 'Flat' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) );
		echo '</p></div>';
	}
}
add_action( 'admin_notices', 'flat_boat_admin_notice', 99 );
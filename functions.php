<?php
/**
 * Twenty'em Child
 *
 * @package			WordPress
 * @subpackage		Twenty'em Child
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em Child 1.0
 */

/**
 * Twenty'em Child Setup
 *
 * @since Twenty'em Child 1.0
 */
function twizr_setup(){
	// Make Twenty'em Child available for translation.
	load_child_theme_textdomain( 'twizr', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'twizr_setup' );

/**
 * Enqueue and register all css and js
 *
 * @since Twenty'em Child 1.0
 */
function twizr_enqueue(){
	wp_register_style( 'twizr-', t_em_get_css( 'theme', T_EM_CHILD_THEME_DIR_PATH .'/css', T_EM_CHILD_THEME_DIR_URL .'/css' ), '', t_em_theme( 'Version' ), 'all' );
	wp_enqueue_style( 'twizr-' );
}
add_action( 'wp_enqueue_scripts', 'twizr_enqueue' );

/**
 * Dequeue styles form parent theme
 *
 * @since Twenty'em Child 1.2
 */
function twizr_dequeue(){
	wp_dequeue_style( 'twenty-em-style' );
	wp_deregister_style( 'twenty-em-style' );
}
add_action( 'wp_enqueue_scripts', 'twizr_dequeue', 999 );
?>

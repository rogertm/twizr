<?php
/**
 * Twizr
 *
 * @package			WordPress
 * @subpackage		Twizr
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twizr 1.0
 */

/**
 * Twizr Setup
 *
 * @since Twizr 1.0
 */
function twizr_setup(){
	// Make Twizr available for translation.
	load_child_theme_textdomain( 'twizr', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'twizr_setup' );
?>

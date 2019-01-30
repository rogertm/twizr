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

/**
 * Remove unnecessary options in CPT doc
 *
 * @since Twizr 1.0
 */
function twizr_remove_docs_setup(){
	if ( is_singular( 'doc' ) || ( is_search() && isset( $_GET['pt'] ) && $_GET['pt'] == 'doc' ) ) :
		remove_action( 't_em_action_post_after', 't_em_single_navigation', 5 );
		remove_action( 't_em_action_post_after', 't_em_single_related_posts' );
		remove_action( 't_em_action_post_inside_after', 't_em_single_author_meta' );
		remove_action( 't_em_action_entry_meta_header', 't_em_post_date' );
		remove_action( 't_em_action_entry_meta_header', 't_em_post_author' );
	endif;
}
add_action( 'wp', 'twizr_remove_docs_setup' );
?>

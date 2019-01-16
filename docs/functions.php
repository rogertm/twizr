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
 * Recover Docs meta.
 * This is a temporal function to recover the docs meta from 't_em_all_' prefix.
 * @todo Delete this function after the compliment of it's mission :\
 *
 * @since Twizr 1.0
 */
function twizr_recover_docs_meta(){
	$args = array(
		'post_type'			=> 'doc',
		'posts_per_page'	=> -1,
		'meta_key'			=> 't_em_all_doc_top_page',
		'meta_value_num'	=> '1',
	);

	$docs = get_posts( $args );
	foreach ( $docs as $topic ) :
		update_post_meta( $topic->ID, 'doc_top_page', 1 );
		delete_post_meta( $topic->ID, 't_em_all_doc_top_page' );
	endforeach;
}
add_action( 'after_setup_theme', 'twizr_recover_docs_meta' );

/**
 * Load Search in Docs template
 *
 * @since Twizr 1.0
 */
function twizr_load_search_docs_template( $search_template = '' ){
	if ( isset( $_GET['s'] ) && isset( $_GET['pt'] ) && $_GET['pt'] == 'doc' ) :
		$search_template = locate_template( 'search-docs.php' );
	endif;
	return $search_template;
}
add_filter( 'search_template', 'twizr_load_search_docs_template' );

/**
 * Redirect from doc archive to Documentation Main Page
 *
 * @since Twizr 1.0
 */
function twizr_doc_redirect(){
	if ( is_post_type_archive( 'doc' ) ) :
		$location = get_permalink( t_em( 'page_docs' ) );
		wp_safe_redirect( $location );
		exit();
	endif;
}
add_action( 'template_redirect', 'twizr_doc_redirect' );

/**
 * Template for post type doc
 *
 * @since Twizr 1.0
 */
function twizr_doc_editor_content( $content ){
	global $post;
	$screen = get_current_screen();
	if ( $screen->id == 'doc' ) :
		if ( get_post_type( $post->ID ) == 'doc' && empty( get_post_field( 'post_content', $post->ID ) ) ) :
			$content = __( '<h2>Description</h2>', 'twizr' );
			$content .= __( '<h2>Usage</h2>', 'twizr' );
			$content .= __( '<h2>Parameters</h2>', 'twizr' );
			$content .= __( '<h2>Returned Values</h2>', 'twizr' );
			$content .= __( '<h2>Examples</h2>', 'twizr' );
			$content .= __( '<h2>Notes</h2>', 'twizr' );
			$content .= __( '<h2>Resources</h2>', 'twizr' );
		else :
			$content = $content;
		endif;
	endif;
	return $content;
}
add_filter( 'the_editor_content', 'twizr_doc_editor_content' );
?>

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
 * The Docx!
 * Display the documentation index
 *
 * @since Twizr 1.0
 */
function twizr_the_doc(){
	if ( ! is_page( t_em( 'page_docs' ) ) )
		return;
?>
	<div id="docs-main-page">
	<?php
	// Get parents docs pages
	$args = array(
		'post_type'			=> 'doc',
		'posts_per_page'	=> -1,
		'post_parent'		=> 0,
		'meta_key'			=> 'doc_top_page',
		'meta_value_num'	=> '1',
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC',
	);
	$docs_parent_pages = get_posts( $args );

	$columns = 2;
	$cols = 12 / $columns;
	?>
		<div class="row">
	<?php
	$i = 0;
	foreach ( $docs_parent_pages as $docs ) :
		if ( 0 == $i % $columns ) :
			echo '</div>';
			echo '<div class="row">';
		endif;
		if ( get_children( array( 'post_parent' => $docs->ID ) ) ) :
			$alt_title = ( get_post_meta( $docs->ID, 'twizr_featured_excerpt', true ) ) ? 'title="'. get_post_meta( $docs->ID, 'twizr_featured_excerpt', true ) .'"' : null;
	?>
		<div class="<?php echo t_em_grid( $cols ) ?>">
			<div id="<?php echo get_post_field( 'post_name', $docs->ID ) ?>" class="card card-doc">
				<div class="card-header"><a href="<?php echo get_permalink( $docs->ID ) ?>" <?php echo $alt_title ?>><?php echo $docs->post_title; ?></a></div>
		<?php 	if ( $docs->post_content ) : ?>
				<div class="card-body"><?php echo t_em_wrap_paragraph( do_shortcode( get_post_field( 'post_content', $docs->ID ) ) ); ?></div>
		<?php 	endif; ?>
				<ul class="list-unstyled">
		<?php	// Get inner docs pages
				$args = array(
					'post_type'			=> 'doc',
					'post_parent'		=> $docs->ID,
					'orderby'			=> 'menu_order',
					'order'				=> 'ASC',
					'posts_per_page'	=> -1,
					'meta_key'			=> 'function_api_deprecated',
					'meta_value_num'	=> '1',
					'meta_compare'		=> 'NOT EXISTS',
				);
				$docs_inner_pages = get_posts( $args );
				foreach ( $docs_inner_pages as $doc ) : ?>
					<li class="h5"><a href="<?php echo get_permalink( $doc->ID ) ?>"><?php echo $doc->post_title; ?></a></li>
		<?php	endforeach; ?>
				</ul>
			</div><!-- .card -->
		</div><!-- .t_em_grid() -->
	<?php
		endif;
		$i++;
	endforeach;
?>
		</div><!-- .row -->
	</div><!-- #docs-## -->
<?php
}
add_action( 't_em_action_post_inside_after', 'twizr_the_doc' );

/**
 * Display the search form in documentation main page
 *
 * @since Twizr 1.0
 */
function twizr_search_docs_form(){
	if ( ! is_page( t_em( 'page_docs' ) ) )
		return;
?>
<section id="search-in-docs" class="row">
	<div class="col-lg-10 mx-auto mb-5">
		<?php get_template_part( 'searchform', 'docs' ); ?>
	</div>
</section>
<?php
}
add_action( 't_em_action_post_content_after', 'twizr_search_docs_form' );

/**
 * Check if the current doc topic is a deprecated element. If it's, intersect its content
 *
 * @since Twizr 1.0
 */
function twizr_doc_deprecated_content( $content ){
	global $post;
	$api_deprecated = ( get_post_meta( $post->ID, 'function_api_deprecated', true ) ) ? get_post_meta( $post->ID, 'function_api_deprecated', true ) : null;
	if ( $api_deprecated ) :
		$api_deprecated_since 	= get_post_meta( $post->ID, 'function_api_deprecated_since', true );
		$api_use_instead 		= get_post_meta( $post->ID, 'function_api_use_instead', true );
		$deprecated_since 		= ( $api_deprecated_since ) ? sprintf( __( ' since version <strong>%s</strong>', 'twizr' ), $api_deprecated_since ) : null;
		$use_instead 			= ( $api_use_instead ) ? sprintf( __( 'You may use <code>%s</code> instead.', 'twizr' ), '<a href="'. get_permalink( $api_use_instead ) .'">'. get_the_title( $api_use_instead ) .'</a>' ) : null;

		$clean_title = get_the_title( $post->ID );
		$content = '<div class="child-callout child-callout-danger">';
		$content .= 		'<h4 class="child-callout-heading">'. __( 'Deprecated Element', 'twizr' ) .'</h4>';
		$content .= 	'<p class="mb-1">'. sprintf( __( '<code>%s</code> is marked as deprecated%s. That means it has been replaced by a new function or is no longer supported, and may be removed from future versions. %s', 'twizr' ), $clean_title, $deprecated_since, $use_instead ) .'</p>';
		$content .= '</div">';
	else :
		$content = $content;
	endif;
	return $content;
}
add_filter( 'the_content', 'twizr_doc_deprecated_content' );
?>

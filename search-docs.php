<?php
/**
 * Twizr
 *
 * @package			WordPress
 * @subpackage		Twizr: Docs search results
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twizr 1.0
 */

get_header(); ?>

		<section id="main-content" <?php t_em_breakpoint( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_breakpoint( 'content' ); ?>>
				<?php do_action( 't_em_action_content_before' ); ?>
				<?php
				// We exclude deprecated functions from search...
				$args = array(
					'post_type'			=> 'doc',
					's'					=> get_query_var( 's' ),
					'posts_per_page'	=> ( ( get_option( 'posts_per_page' ) * 2 ) > 10 ) ? get_option( 'posts_per_page' ) * 2 : 10,
					'paged'				=> get_query_var( 'paged' ),
					'meta_query'		=> array(
						array(
							'key'		=> 'function_api_deprecated',
							'value'		=> 1,
							'compare'	=> 'NOT EXISTS',
						),
					),
				);
				$wp_query = new WP_Query( $args );
				?>
				<?php t_em_loop(); ?>
				<?php do_action( 't_em_action_content_after' ); ?>
			</section><!-- #content -->
			<?php get_sidebar( 'alt' ); ?>
		</section><!-- #main-content -->

<?php get_footer(); ?>
